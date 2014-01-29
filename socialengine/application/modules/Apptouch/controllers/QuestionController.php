<?php
/**
 * (amay0048) This is the extension of the briding controller for the mobile content
 **/
class Apptouch_QuestionController
  extends Apptouch_Controller_Action_Bridge
{
  public function indexInit()
  {
    $this->addPageInfo('contentTheme', 'd');
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
    $this->addPageInfo('contentTheme', 'd');
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
	$config = array('action_id' => (int) $row['action_id']);
    $actionTable = Engine_Api::_()->getDbtable('actions', 'activity');
	$actions = $actionTable->getActivity($viewer, $config);
	$action = $actions[0];
	$this->view->activity = $actions;
	
	$commentParams = array(
		'subject' => $action,
		'viewAllLikes' => true);
	
	$this->add($this->component()->feed());
	
	$h2 = $this->dom()->new_('h2');
	$h2->text = $question->getTitle();
	$this->add($this->component()->html($h2));
	
    $p = $this->dom()->new_('p');
	$p->text = $question->getDescription();
	$this->add($this->component()->html($p));
	  // the feed is not quite right here, what we
	  // actually need is the user and the question title

	$this
	  ->add($this->component()->comments($commentParams))
	  ->renderContent();

  }
  
  public function indexCreateAction()
  {
	  if( $this->getRequest()->isPost() ) {
		return;  
	  }
	  //"$(this.form).trigger('submit')" an be called onclick
	  $searchInput = $this->dom()->new_('textarea', array('onclick' => "", 'type' => 'text', 'name' => 'searchText', 'id' => 'searchText'));
	  $searchSubmit = $this->dom()->new_('input', array('onclick' => "doSearch();", 'type' => 'button', 'name' => 'searchSubmit', 'id' => 'searchSubmit', 'value' => 'search'));
	  $searchLaunch = $this->dom()->new_('input', array('onclick' => "", 'type' => 'button', 'name' => 'searchLaunch', 'id' => 'searchLaunch', 'value' => 'launch'));
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
	  
	  $results = $this->dom()->new_('div',array('id' => 'results'));
	  $this
	    ->add($this->component()->html($results));
	  
	  $this
	  	->setFormat('create')
	  	->renderContent();
  }
} ?>