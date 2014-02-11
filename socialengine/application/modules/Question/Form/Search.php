<?php

class Question_Form_Search extends Engine_Form
{
  public function init()
  {
    $this->setTitle('Search Form');
    $this->setDescription('Enter your search term below');
    $this->addElement('text', 'searchText', array(
      // The label of the element rendered as a label tag wrapped
      // in div with id <elementname>-label
      'label' => 'Keywords',
      // Descriptions are rendered above the form element by default.
      //'description' => '<em>Ex. "My First Question"</em>',
      'required' => true,
      'filters' => array(
        new Engine_Filter_Censor(),
        'StripTags'
      )
    ));


    // Using a regular
    $this->addElement('button', 'submit', array(
	  'onclick' => 'doSearch();',
      'decorators' => array('ViewHelper'),
      'label' => 'Search',
      'ignore' => true
    ));

    $this->addElement('cancel', 'cancel', array(
      'onclick' => 'launch();',
      'decorators' => array('ViewHelper'),
      'label' => 'Launch',
      'prependText' => ' or '
    ));

    $this->addDisplayGroup(array('submit', 'cancel'), 'buttons');
  }
}