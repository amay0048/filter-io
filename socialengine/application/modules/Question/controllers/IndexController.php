<?php

class Question_IndexController extends Core_Controller_Action_Standard
{
  public function init()
  {
  }

  public function indexAction()
  {
	  $this->view->someVar = 'someVal';
  }

  public function createAction()
  {
	$this->view->form = $form = new Question_Form_Create();
	$viewer = Engine_Api::_()->user()->getViewer();
	
	if (!$this->getRequest()->isPost() || !$form->isValid($this->getRequest()->getPost())){
		return ;
	}
	
    $options = $this->getRequest()->getPost('options');
    $form_options = array();

    $values = $form->getValues();
	
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
      $action = $actionTable->addActivity($viewer, $subject, $type, null, array(
        'question' => '<a href="http://www.google.com/'.$question->getHref().'">'.$question->getTitle().'</a>'
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
	  
    } catch (Exception $e){
      $db->rollBack();
      throw $e;
    }
	
  }

  public function browseAction()
  {

    //$this->view->navigation = Engine_Api::_()->getApi('menus', 'core')->getNavigation('[menu_name]', [array of options], '[active_menu_item_name]');

  }

  public function manageAction()
  {
  }
  
  public function twitterAction()
  {
	  
  }
}
