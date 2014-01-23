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
  }

  public function browseAction()
  {

    //$this->view->navigation = Engine_Api::_()->getApi('menus', 'core')->getNavigation('[menu_name]', [array of options], '[active_menu_item_name]');

  }

  public function manageAction()
  {
  }
}
