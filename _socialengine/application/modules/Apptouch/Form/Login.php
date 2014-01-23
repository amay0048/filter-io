<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Apptouch
 * @copyright  Copyright Hire-Experts LLC
 * @license    http://www.hire-experts.com
 * @version    $Id: Login.php 2011-04-26 11:18:13 mirlan $
 * @author     Mirlan
 */

/**
 * @category   Application_Extensions
 * @package    Apptouch
 * @copyright  Copyright Hire-Experts LLC
 * @license    http://www.hire-experts.com
 */

class Apptouch_Form_Login extends Apptouch_Form_Standard
{
  public function init()
  {
    $isApp = Engine_Api::_()->apptouch()->isApp();
    $signupUrl = Zend_Controller_Front::getInstance()->getRouter()->assemble(array(), 'user_signup', true);
    $description = Zend_Registry::get('Zend_Translate')->_("If you already have an account, please enter your details below. If you don't have one yet, please <a href='%s'>sign up</a> first.");
    $description= sprintf($description, Zend_Controller_Front::getInstance()->getRouter()->assemble(array(), 'user_signup', true));

    // Init form
    if(!$isApp){
      $this->setTitle('Member Sign In');
      $this->setDescription($description);
    }
    $this->setAttrib('id', 'user_form_login');
    $this->setAttrib('class', 'global_form');
    $this->loadDefaultDecorators();
    $this->getDecorator('Description')->setOption('escape', false);

    $email = Zend_Registry::get('Zend_Translate')->_('Email Address');
    // Init email
    $this->addElement('Text', 'email', array(
      'label' => $email,
      'required' => true,
      'allowEmpty' => false,
      'filters' => array(
        'StringTrim',
      ),
      'validators' => array(
        'EmailAddress'
      ),
      'tabindex' => 1,
    ));

    $password = Zend_Registry::get('Zend_Translate')->_('Password');
    // Init password
    $this->addElement('Password', 'password', array(
      'label' => $password,
      'required' => true,
      'allowEmpty' => false,
      'tabindex' => 2,
      'filters' => array(
        'StringTrim',
      ),
    ));

    $this->addElement('Hidden', 'return_url', array(
    ));

    $settings = Engine_Api::_()->getApi('settings', 'core');
    if ($settings->core_spam_login) {
      $this->addElement('captcha', 'captcha', array(
        'label' => 'Human Verification',
        'description' => 'Please validate that you are not a robot by typing in the letters and numbers in this image:',
        'captcha' => 'image',
        'required' => true,
        'tabindex' => 3,
        'captchaOptions' => array(
          'wordLen' => 6,
          'fontSize' => '30',
          'timeout' => 300,
          'imgDir' => APPLICATION_PATH . '/public/temporary/',
          'imgUrl' => $this->getView()->baseUrl() . '/public/temporary',
          'font' => APPLICATION_PATH . '/application/modules/Core/externals/fonts/arial.ttf'
        )));
    }

    // Init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Sign In',
      'type' => 'submit',
      'ignore' => true,
      'tabindex' => 5,
    ));

    // Init remember me
    if($isApp){
      $this->addElement('Hidden', 'remember', array(
        'tabindex' => 6,
        'value' => 1
      ));
    } else{
      $this->addElement('Checkbox', 'remember', array(
        'label' => 'Remember Me',
        'tabindex' => 6,
      ));
    }
    $this->addDisplayGroup(array(
      'submit',
      'remember'
    ), 'buttons');

    if($isApp){
      $this->addElement('Dummy', 'signup', array(
        'content' => '<a data-role="button" href="'.$signupUrl.'">' . Zend_Registry::get('Zend_Translate')->_("Join Network") . '</a>'
      ));
    }
    $content = Zend_Registry::get('Zend_Translate')->_("<span><a href='%s'>Forgot Password?</a></span>");

    $content = sprintf($content, Zend_Controller_Front::getInstance()->getRouter()->assemble(array('module' => 'user', 'controller' => 'auth', 'action' => 'forgot'), 'default', true));

    // Init forgot password link
    $this->addElement('Dummy', 'forgot', array(
      'content' => $content,
    ));

    // Init facebook login link todo
    if ('none' != $settings->__get('core_facebook_enable', 'none') && $settings->core_facebook_secret) {
      $this->addElement('Dummy', 'facebook', array(
        'content' => Engine_Api::_()->apptouch()->getFacebookLoginButton(),
      ));
    }

    // Init twitter login link todo
    if ('none' != $settings->getSetting('core_twitter_enable', 'none')
      && $settings->core_twitter_secret
    ) {
      $this->addElement('Dummy', 'twitter', array(
        'content' => Engine_Api::_()->apptouch()->getTwitterLoginButton(),
      ));
    }

    // Set default action
    $this->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array(), 'user_login'));
  }
}