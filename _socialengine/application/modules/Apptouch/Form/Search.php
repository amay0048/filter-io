<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Admin
 * Date: 20.07.12
 * Time: 18:39
 * To change this template use File | Settings | File Templates.
 */
class Apptouch_Form_Search
  extends Engine_Form
{
  public function init()
  {
    $this
      ->setAttribs(array(
      'class' => 'global_form_box filter_form ui-body ui-body-a',
      'data-theme' => 'a'
    ))
    ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ->setMethod('GET');

    parent::init();
    $this->addElement('Text', 'search', array(
      'attribs' => array(
        'data-theme' => 'a',
        'placeholder' => Zend_Registry::get('Zend_Translate')->_('Search'),
      )
    ));
    //		$this->addElement('Button', 'submit', array(
    //			'label' => 'Search',
    //			'type' => 'submit',
    //			'decorators' => array(
    //				'ViewHelper',
    //			),
    //		));

    $request = Zend_Controller_Front::getInstance()->getRequest();

    $this->getElement('search')->setValue($request->getParam('search', ''));
  }

}
