<?php
/**
 * (amay0048) This is the extension of the briding controller for the mobile content
 **/
class Apptouch_QuestionController
  extends Apptouch_Controller_Action_Bridge
{
  public function indexInit()
  {
    $this->addPageInfo('contentTheme', 'h');
  }

  public function profileInit()
  {
	// within the "component-navigation" is where you set the menu options
	// Between this and the footer navigation I have control over both menus.
	// init for the profile action
  }
  
  public function profileIndexAction()
  {
	/** this is required for the controller **/
    // Collect params
    $this->addPageInfo('contentTheme', 'h');
    $viewer = Engine_Api::_()->user()->getViewer();
    $question = Engine_Api::_()->getItem('question', $this->_getParam('id'));
    $owner = $question->getOwner();
	
	//$this->add($date);
	// I'm reversing out the activitiy form the question, because this is
	// currently how I understand the comments and likes functionality
	// works. 
    $attachmentTable = Engine_Api::_()->getDbtable('attachments', 'activity');
    $row = $attachmentTable->fetchRow($attachmentTable->select()->where('id = ?', $question->getIdentity()) );
	$viewer = Engine_Api::_()->user()->getViewer();
	
	// (amay0048) TODO: I think it will be easier to simply render the info than use the 
	// feed controller for now. This needs to be updated to perform properly however.
	$config = array('action_id' => (int) $row['action_id']);
    $actionTable = Engine_Api::_()->getDbtable('actions', 'activity');
	$actions = $actionTable->getActivity($viewer, $config);
	$action = $actions[0];
	$commentParams = array(
		'subject' => $action,
		'viewAllLikes' => true);
	//$this->view->activity = $actions;
	//$this->add($this->component()->feed());
	
	$h2 = $this->dom()->new_('h2');
	$h2->text = $question->getTitle();
	$this->add($this->component()->html($h2));
	
    $div = $this->dom()->new_('div',array('class'=>'snapshotResult'));
	$div->text = $question->snapshot;
	$this->add($this->component()->html($div));
	
    $div = $this->dom()->new_('div',array('class'=>'descriptionResult'));
	$div->text = $question->getDescription();
	$this->add($this->component()->html($div));
	
    $div = $this->dom()->new_('div',array('class'=>'providersResult'));
	$div->text = $question->providers;
	$this->add($this->component()->html($div));
	  // the feed is not quite right here, what we
	  // actually need is the user and the question title

	$this
	  ->add($this->component()->comments($commentParams))
	  ->renderContent();

  }
  
  public function indexCreateAction()
  {
      $this->addPageInfo('contentTheme', 'h');
	  //"$(this.form).trigger('submit')" an be called onclick
	  $searchInput = $this->dom()->new_('textarea', array('onclick' => "", 'type' => 'text', 'name' => 'searchText', 'id' => 'searchText','placeholder'=>'Enter Text'));
	  $searchSubmit = $this->dom()->new_('input', array('onclick' => "doSearch();", 'type' => 'button', 'name' => 'searchSubmit', 'id' => 'searchSubmit', 'value' => 'search'));
	  $searchLaunch = $this->dom()->new_('input', array('onclick' => "$('form.hz-search').submit();", 'type' => 'button', 'name' => 'searchLaunch', 'id' => 'searchLaunch', 'value' => 'launch'));
	  $searchForm = $this->dom()->new_('form', array(
	    //'action' => $this->view->url(array('module' => 'event', 'controller' => 'widget', 'action' => 'profile-rsvp', 'subject' => 6), 'default', true),
	    //'method' => 'post',
	    'data-role' => 'controlgroup',
	    'data-mini' => true,
		'onsubmit' => 'javascript:return false;'
	  ), '', array(
	    $searchInput,
		$searchSubmit,
		$searchLaunch
	  ));

	  $this
	    ->add($this->component()->html($searchForm));
	  // (amay0048) this is where the create question form gets rendered for mobile/touch
      $form = new Question_Form_Create();
	  $form->setAttrib('class', 'hz-search');
	  $form->setAttrib('style', 'display:none;');
	  $this
		->add($this->component()->form($form));
		
	  $snapshot = $this->dom()->new_('div',array('id' => 'snapshotResult','class' => 'snapshotResult'));
	  $results = $this->dom()->new_('div',array('id' => 'descriptionResult','class' => 'descriptionResult'));
	  $providers = $this->dom()->new_('div',array('id' => 'providersResult','class' => 'providersResult'));
	  $this
	    ->add($this->component()->html($snapshot))
	    ->add($this->component()->html($results))
	    ->add($this->component()->html($providers));
	  
	  $this
	  	->setFormat('create')
	  	->renderContent();

	  if( !$this->getRequest()->isPost() ) {
		return;  
	  }

	$viewer = Engine_Api::_()->user()->getViewer();
	
	$values = $this->getRequest()->getPost();

	$db = Engine_Db_Table::getDefaultAdapter();
	$db->beginTransaction();
	
	try {
	
	  $values['user_id'] = $viewer->getIdentity();
	  $values['owner_type'] = $viewer->getType();
	  $values['owner_id'] = $viewer->getIdentity();
	
	  $subject = $viewer;
	  $type = 'question';
	  
	  $table = Engine_Api::_()->getDbTable('questions', 'question');
	
	  $question = $table->createRow();
	  $question->setFromArray($values);
	  $question->save();
	  
	  
	  // Privacy
	  $auth = Engine_Api::_()->authorization()->context;
	  $roles = array('owner', 'owner_member', 'owner_network', 'everyone');
	
	  if( empty($values['auth_view']) ) {
		$values['auth_view'] = array('everyone');
	  }
	  if( empty($values['auth_comment']) ) {
		$values['auth_comment'] = array('everyone');
	  }
	
	  $viewMax = array_search($values['auth_view'], $roles);
	  $commentMax = array_search($values['auth_comment'], $roles);
	
	  foreach( $roles as $i => $role ) {
		$auth->setAllowed($question, $role, 'view', ($i <= $viewMax));
		$auth->setAllowed($question, $role, 'comment', ($i <= $commentMax));
	  }
	  
	  // Add on activity feed
	  $actionTable = Engine_Api::_()->getDbTable('actions', 'wall');
	  
	  // (amay 0048) this needs to be restructured to get it working correctly.
	  $action = $actionTable->addActivity($viewer, $subject, $type, null, array(
		'question' => '<a href="/socialengine/question/'.$question->getIdentity().'">'.$question->getTitle().'</a>'
	  ));
	
	  if ($action){
	
		$path = Zend_Controller_Front::getInstance()->getControllerDirectory('wall');
		$path = dirname($path) . '/views/scripts';
		$this->view->addScriptPath($path);
	
	
		Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $question);
		$this->view->body = $this->view->wallActivity($action, array(
		  'module' => $this->_script_module
		));
		$this->view->last_id = $action->getIdentity();
		$this->view->last_date = $action->date;
	  }
	  
	  $db->commit();
	
	  $this->view->result = true;
	  // (amay0048) TODO: This needs to be tidied up, it's not correct, should go to newly created question
	  return $this->redirect('/socialengine/');
	  
	} catch (Exception $e){
	  $db->rollBack();
	  throw $e;
	}
  }
  
  public function indexMapAction()
  {
	  $keyword = $this->getRequest()->getParam('keyword');
	  $searchFrame = $this->dom()->new_('iframe', array(
	  	'src'=>'/socialengine/hzsearch/index.html#'.$keyword,
		'class'=>'hz-location-search'
	  ));
	  
	  $style = $this->dom()->new_('style');
	  $style->text = '.hz-search-container{border:0;height:100%;width:100%;position:relative;}';
	  $style->text .= '.hz-location-search{border:0;height: calc(100% - 134px);width:100%;}';
  	  $style->text .= '.ui-page:after {height:0;display:none;}';
	  
	  $div = $this->dom()->new_('div',array('class'=>'hz-search-container'));
	  $div->text = $style;
	  $div->text .= $searchFrame;
	  
  	  $this
	    ->add($this->component()->html($div))
		->renderContent();
  }
} ?>