<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Hequestion
 * @copyright  Copyright Hire-Experts LLC
 * @license    http://www.hire-experts.com
 * @version    $Id: Controller.php 17.08.12 06:04 michael $
 * @author     Michael
 */

/**
 * @category   Application_Extensions
 * @package    Hequestion
 * @copyright  Copyright Hire-Experts LLC
 * @license    http://www.hire-experts.com
 */



class Question_Widget_SearchController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
	$this->view->searchform = $searchForm = new Question_Form_Search();
	$this->view->form = $form = new Question_Form_Create();
  }
}
