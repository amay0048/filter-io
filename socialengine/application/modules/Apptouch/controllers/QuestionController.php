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
    $this->addPageInfo('contentTheme', 'd');
    $viewer = Engine_Api::_()->user()->getViewer();
    $question = Engine_Api::_()->getItem('question', $this->_getParam('id'));
    $owner = $question->getOwner();

	$date = array('title' => $this->view->translate('Posted by') . ' ' . $owner->getTitle() . ' ' /*. $this->view->timestamp($question->creation_date)*/, 'count' => null);

    $div = $this->dom()->new_('div');
	
	$div->text = $question->getDescription();
	$this
      ->add($this->component()->html($div))
	  ->renderContent();
	// (amay0048) within the "component-navigation" is where you set the menu options
	// Between this and the footer navigation I have control over both menus.
  }
  
  public function profileIndexAction()
  {
	  /** (amay0048) this is required for the controller **/
  }
  
} ?>