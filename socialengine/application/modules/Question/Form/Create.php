<?php

class Question_Form_Create extends Engine_Form
{
  public function init()
  {
    $this->setTitle('Post a Question');
    $this->setDescription('Please set the details of your question post below.');
    $this->addElement('text', 'title', array(
      // The label of the element rendered as a label tag wrapped
      // in div with id <elementname>-label
      'label' => 'Title',
      // Descriptions are rendered above the form element by default.
      //'description' => '<em>Ex. "My First Question"</em>',
      'required' => true,
      'filters' => array(
        new Engine_Filter_Censor(),
        'StripTags'
      )
    ));
    $this->title->getDecorator('description')->setEscape(false);

    $this->addElement('textarea', 'snapshotHtml', array(
      'label' => 'Snapshot',
      'filters' => array(
        new Engine_Filter_Censor()
        //'StripTags'
      )
    ));
	
    $this->addElement('textarea', 'description', array(
      'label' => 'Description',
      'filters' => array(
        new Engine_Filter_Censor()
        //'StripTags'
      )
    ));

    $this->addElement('textarea', 'providersHtml', array(
      'label' => 'Providers',
      'filters' => array(
        new Engine_Filter_Censor()
        //'StripTags'
      )
    ));

    $this->addElement('text', 'tags', array(
      'label' => 'Tags',
      'autocomplete' => 'off',
      'filters' => array(
        new Engine_Filter_Censor(),
      )
    ));
	
	/*
    $this->addElement(new Question_Form_Element_Color('color', array(
      'label' => 'Color',
      'cellWidth' => 12,
      'cellHeight' => 16,
      'validators' => array(
        array('Regex', true, array('pattern' => '/^#[a-f0-9]{6}$/i',
        'messages' => 'Invalid color.'))
      )
    )));
	*/

    // Another way of doing the code above by adding a prefix path.
    // This is convinient should you be using a lot of custom form elements
    //$this->addPrefixPath('Car_Form_Element', APPLICATION_PATH .
    //'/application/modules/Car/Form/Element', 'element');
    //$this->addElement('color', 'color', array(
    //  'label' => 'Color',
    //  'validators' => array(
    //    array('Regex', true, array('pattern' => '/^#[a-f0-9]{6}$/i',
    //    'messages' => 'Invalid color.'))
    //  )
    //));

    // Using a regular
    $this->addElement('button', 'submit', array(
      'type' => 'submit',
      'decorators' => array('ViewHelper'),
      'label' => 'Create',
      'ignore' => true
    ));

    $this->addElement('cancel', 'cancel', array(
      'link' => true,
      'decorators' => array('ViewHelper'),
      'label' => 'Cancel',
      'prependText' => ' or '
    ));

    $this->addDisplayGroup(array('submit', 'cancel'), 'buttons');
  }
}