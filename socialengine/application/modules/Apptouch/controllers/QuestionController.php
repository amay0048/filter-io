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
	
	$date = array('title' => $this->view->translate('Posted by') . ' ' . $owner->getTitle() . ' ' /*. $this->view->timestamp($question->creation_date)*/, 'count' => null);
	
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
	
	$commentParams = array(
		'subject' => $action,
		'viewAllLikes' => true);
	
	$h2 = $this->dom()->new_('h2');
	$h2->text = $question->getTitle();
	$this->add($this->component()->html($h2));
	
    $p = $this->dom()->new_('p');
	$p->text = $question->getDescription();
	$this->add($this->component()->html($p));
	  // the feed is not quite right here, what we
	  // actually need is the user and the question title
	  //->add($this->component()->feed())

	$this
	  ->add($this->component()->comments($commentParams))
	  ->renderContent();

  }
  
  public function indexCreateAction()
  {
	  // (amay0048) this is where the create question form gets rendered for mobile/touch
      $form = new Question_Form_Create();
	  $this
		->add($this->component()->form($form))
	  	->setFormat('create')
	  	->renderContent();
  }
} ?>