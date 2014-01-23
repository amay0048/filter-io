<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Touch
 * @copyright  Copyright Hire-Experts LLC
 * @license    http://www.hire-experts.com
 * @version    $Id: Menus.php 2011-04-26 11:18:13 mirlan $
 * @author     Mirlan
 */

/**
 * @category   Application_Extensions
 * @package    Touch
 * @copyright  Copyright Hire-Experts LLC
 * @license    http://www.hire-experts.com
 */

class Apptouch_Plugin_Menus
{

//	Core_Search
  public function onMenuInitialize_CoreDashboardHome($row)
  {
    $viewer  = Engine_Api::_()->user()->getViewer();
    $request = Zend_Controller_Front::getInstance()->getRequest();
    $route   = array(
      'route' => 'user_login',
    );

    if( $viewer->getIdentity() ) {
      $route['route']  = 'user_general';
      $route['params'] = array(
        'action' => 'home',

      );
      if( 'user'  == $request->getModuleName() &&
          'index' == $request->getControllerName() &&
          'home'  == $request->getActionName() ) {
        $route['active'] = true;
      }
    }
    return $route;
  }

  public function onMenuInitialize_CoreMainSearch($row)
  {
    return $this->getSearch($row);
  }

  public function getLink()
  {
    if (!Engine_Api::_()->user()->getViewer()->getIdentity()){
      return false;
    }

    $subject = Engine_Api::_()->core()->getSubject();
    $suggest_type = 'link_'.$subject->getType();
    $view = Zend_Registry::get('Zend_View');
    if (Engine_Api::_()->suggest()->isAllowed($suggest_type) && Engine_Api::_()->user()->getViewer()->getIdentity()) {
      $router = Zend_Controller_Front::getInstance()->getRouter();
      $path = APPLICATION_PATH . DIRECTORY_SEPARATOR . "application" . DIRECTORY_SEPARATOR ."modules" . DIRECTORY_SEPARATOR . "Mobile" . DIRECTORY_SEPARATOR .
        "modules" . DIRECTORY_SEPARATOR . "Suggest" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "scripts";

      $paramStr = '?m=suggest&c=' . $view->url(array(
          "controller" => "index",
          "action" => "suggest",
          "object_id" => $subject->getIdentity(),
          "object_type" => $subject->getType(),
          "suggest_type" => $suggest_type
        ), "suggest_general") . '&l=getSuggestItems&nli=0&params[object_type]='.$subject->getType().'&params[object_id]='.$subject->getIdentity() .
        '&action_url='.urlencode($router->assemble(array('action' => 'suggest'), 'suggest_general')) .
        '&params[suggest_type]=' . $suggest_type . '&params[scriptpath]=' . $path;

      $url = $router->assemble(array('controller' => 'index', 'action' => 'contacts', 'module' => 'hecore'), 'default', true) . $paramStr;
      return array(
        'label' => 'Suggest To Friends',
        'icon' => 'application/modules/Suggest/externals/images/suggest.png',
        'class' => 'suggest_link',
        'uri' => $url
      );
    } else {
      return false;
    }
  }

  public function onMenuInitialize_UserProfileSuggest($row)
  {
    $showLink = Engine_Api::_()->getApi('settings', 'core')->getSetting('suggest.link.user');

    if (!Engine_Api::_()->core()->hasSubject() || !$showLink) {
      return false;
    }

    $viewer = Engine_Api::_()->user()->getViewer();
    $subject = Engine_Api::_()->core()->getSubject();

    if ($subject->isSelf($viewer)) {
      return false;
    }

    return $this->getLink();
  }

  public function onMenuInitialize_EventProfileSuggest($row)
  {
    $showLink = Engine_Api::_()->getApi('settings', 'core')->getSetting('suggest.link.event');

    if (!Engine_Api::_()->core()->hasSubject() || !$showLink) {
      return false;
    }

    return $this->getLink();
  }

  public function onMenuInitialize_GroupProfileSuggest($row)
  {
    $showLink = Engine_Api::_()->getApi('settings', 'core')->getSetting('suggest.link.group');

    if (!Engine_Api::_()->core()->hasSubject() || !$showLink) {
      return false;
    }

    return $this->getLink();
  }

  public function onMenuInitialize_PageProfileSuggest($row)
  {
    $showLink = Engine_Api::_()->getApi('settings', 'core')->getSetting('suggest.link.page');

    if (!Engine_Api::_()->core()->hasSubject() || !$showLink) {
      return false;
    }

    return $this->getLink();
  }

  public function onMenuInitialize_BlogGutterSuggest($row)
  {
  	$showLink = Engine_Api::_()->getApi('settings', 'core')->getSetting('suggest.link.blog');

    if (!Engine_Api::_()->core()->hasSubject() || !$showLink) {
      return false;
    }

    return array(
      'label' => 'Suggest To Friends',
      'icon' => 'application/modules/Suggest/externals/images/suggest.png',
      'route' => 'suggest_general',
      'class' => 'suggest_link buttonlink'
    );
  }

  public function onMenuInitialize_ClassifiedGutterSuggest($row)
  {
  	$showLink = Engine_Api::_()->getApi('settings', 'core')->getSetting('suggest.link.classified');

    if (!Engine_Api::_()->core()->hasSubject() || !$showLink) {
      return false;
    }

    return array(
      'label' => 'Suggest To Friends',
      'icon' => 'application/modules/Suggest/externals/images/suggest.png',
      'route' => 'suggest_general',
      'class' => 'suggest_link buttonlink'
    );
  }

  //Dashboard Menus
  public function onMenuInitialize_CoreDashboardProfile($row)
  {
    $viewer = Engine_Api::_()->user()->getViewer();
    /**
     * @var $viewer User_Model_User
     */
    if ($viewer->getIdentity()) {
      $t = $viewer->getTitle();
      $class = '';
//      if(Engine_A::_()->getDbTable('settings', 'core')->getSetting('apptouch.username.dashboard'))
      if(strlen($t) > 25)
        $class .= ' long-title17';
      elseif(strlen($t) > 20)
        $class .= ' long-title18';
      elseif(strlen($t) > 16)
        $class .= ' long-title19';
      if($viewer->getPhotoUrl('thumb.icon')){
        $class .= ' user-photo-thumb';
      }
      return array(
        'label' => $viewer->getTitle(),
        'uri' => $viewer->getHref(),
        'class' => $class
      );
    }
    return false;
  }

  public function onMenuInitialize_CoreDashboardMessages($row)
  {
    $viewer = Engine_Api::_()->user()->getViewer();
    if (!$viewer->getIdentity()) {
      return false;
    }

    $message_count = Engine_Api::_()->messages()->getUnreadMessageCount($viewer);
    $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl() . '/';

    return array(
      'label' => Zend_Registry::get('Zend_Translate')->_($row->label) . ($message_count ? ' (' . $message_count . ')' : ''),
      'route' => 'messages_general',
      'params' => array(
        'action' => 'inbox'
      )
    );
  }

  public function onMenuInitialize_CoreDashboardUpdates($row)
  {
    $viewer = Engine_Api::_()->user()->getViewer();
    if (!$viewer->getIdentity()) {
      return false;
    }

    return array(
      'label' => Zend_Registry::get('Zend_Translate')->_($row->label),
      'route' => 'default',
      'params' => array(
        'module' => 'activity',
        'controller' => 'notifications',
        'action' => 'index'
      )
    );
  }

  public function onMenuInitialize_CoreDashboardSearch($row)
  {
    if(Engine_Api::_()->apptouch()->isTabletMode()){
      $params = $this->getSearch($row);
      if($params){
        $params['order'] = 0;
      }
      return $params;
    }
    return $this->getSearch($row);
  }

  public function onMenuInitialize_CoreDashboardAlbum($row)
  {
    $modules = Engine_Api::_()->getDbTable('modules', 'core');
    if (
      $modules->isModuleEnabled('album') ||
      $modules->isModuleEnabled('sitealbum')
    )
      return true;
    else
      return false;
  }

  public function onMenuInitialize_CoreDashboardFullsite($row)
  {
    $view = Zend_Registry::get('Zend_View');
    if(Engine_Api::_()->apptouch()->isApp() || Engine_Api::_()->getDbTable('settings', 'core')->getSetting('apptouch.default', false)){
      return false;
    }
    return array(
      'label' => $row->label,
      'uri' => $view->url(array(), 'default', true) . '?apptouch-site-mode=standard',
    );
  }

  public function onMenuInitialize_CoreDashboardAuth($row)
  {
    $viewer = Engine_Api::_()->user()->getViewer();
    if( $viewer->getIdentity() ) {
      return array(
        'label' => 'Sign Out',
        'route' => 'user_logout',
        'class' => 'no-dloader',
      );
    } else {
      return array(
        'label' => 'Sign In',
        'route' => 'user_login',
      );
    }
  }

  public function onMenuInitialize_CoreDashboardSignup($row)
  {
    $viewer = Engine_Api::_()->user()->getViewer();
    if( !$viewer->getIdentity() ) {
      return array(
        'label' => 'Sign Up',
        'route' => 'user_signup'
      );
    }

    return false;
  }

  public function onMenuInitialize_CoreDashboardStore($row)
  {
    if(Engine_Api::_()->apptouch()->isApp()){
      return false;
    }

    return $row;
  }

  public function canInvite($row){
    if(Engine_Api::_()->apptouch()->isApp()){
      return false;
    };
    try {
      $plugin = Engine_Api::_()->loadClass('Invite_Plugin_Menus');
      return $plugin->canInvite() && $row->enabled;
    } catch (Exception $e) {
      // Silence exceptions
      return false;
    }

  }
//  public function onMenuInitialize_CoreDashboardMusic($row)
//  {
//    $modules = Engine_Api::_()->getDbTable('modules', 'core');
//    if (
//      $modules->isModuleEnabled('music') ||
//      $modules->isModuleEnabled('ynmusic')
//    )
//      return true;
//    else
//      return false;
//  }

//  public function onMenuInitialize_CoreDashboardVideo($row)
//  {
//    $modules = Engine_Api::_()->getDbTable('modules', 'core');
//    if (
//      $modules->isModuleEnabled('video') ||
//      $modules->isModuleEnabled('ynvideo')
//    )
//      return true;
//    else
//      return false;
//  }

//  public function onMenuInitialize_CoreDashboardBlog($row)
//  {
//    $modules = Engine_Api::_()->getDbTable('modules', 'core');
//    if (
//      $modules->isModuleEnabled('blog') ||
//      $modules->isModuleEnabled('ynblog')
//    )
//      return true;
//    else
//      return false;
//  }

//  public function onMenuInitialize_CoreDashboardHequestion($row)
//  {
//    $modules = Engine_Api::_()->getDbTable('modules', 'core');
//    if (
//      $modules->isModuleEnabled('hequestion')
//    )
//      return true;
//    else
//      return false;
//  }

//  public function onMenuInitialize_CoreDashboardEvent($row)
//  {
//    $modules = Engine_Api::_()->getDbTable('modules', 'core');
//    if (
//      $modules->isModuleEnabled('event') ||
//      $modules->isModuleEnabled('ynevent')
//    )
//      return true;
//    else
//      return false;
//  }

//  public function onMenuInitialize_CoreDashboardGroup($row)
//  {
//    $modules = Engine_Api::_()->getDbTable('modules', 'core');
//    if (
//      $modules->isModuleEnabled('group') ||
//      $modules->isModuleEnabled('advgroup')
//    )
//      return true;
//    else
//      return false;
//  }

  public function getSearch($row)
  {
    $viewer = Engine_Api::_()->user()->getViewer();
    $request = Zend_Controller_Front::getInstance()->getRequest();

    if (!Engine_Api::_()->getApi('settings', 'core')->core_general_search && !$viewer->getIdentity()) {
      return false;
    }

    $route = false;

    if ($viewer->getIdentity()) {
      $route['route'] = 'default';
      $route['params'] = array(
        'controller' => 'search',
      );
      if ('core' == $request->getModuleName()
        && 'controller' == $request->getControllerName()
        && 'index' == $request->getActionName()
      ) {
        $route['active'] = true;
      }
    }

    return $route;
  }

  public function onMenuInitialize_CoreFooterApptouch($row)
  {
    $view = Zend_Registry::get('Zend_View');
    $route = array(
      'label' => Zend_Registry::get('Zend_Translate')->_($row->label),
      'enabled' => 1,
      'uri' => $view->url(array(), 'default', true) . '?apptouch-site-mode=apptouch',
    );
    return $route;
  }

  public function onMenuInitialize_CoreFooterApptablet($row)
  {
    $view = Zend_Registry::get('Zend_View');
    $route = array(
      'label' => Zend_Registry::get('Zend_Translate')->_($row->label),
      'enabled' => 1,
      'uri' => $view->url(array(), 'default', true) . '?apptouch-site-mode=apptablet',
    );
    return $route;
  }

  public function onMenuInitialize_PageMainCreate($row)
  {
    if(Engine_Api::_()->apptouch()->isApp() || !Engine_Api::_()->authorization()->isAllowed('page', null, 'create') ) {
      return false;
    }
    return true;
  }

  public function onMenuInitialize_PageQuickCreate($row)
  {
    return $this->onMenuInitialize_PageMainCreate($row);
  }

  public function onMenuInitialize_CoreDashboardCometchat($row)
  {
    $viewer = Engine_Api::_()->user()->getViewer();
    if( !$viewer || !$viewer->getIdentity() ) {
      return false;
    }

    $db = Engine_Db_Table::getDefaultAdapter();

    $tables = $db->query("SHOW TABLES LIKE 'cometchat%'")->fetchAll();

    if(!$tables || empty($tables) || count($tables) < 1)
      return false;

    return array(
      'uri' => Engine_Api::_()->getDbTable('settings', 'core')->getSetting('apptouch.cometchat.uri', 'cometchat')
    );
  }

  public function onMenuInitialize_UserProfileSendCredits($row)
  {
    if( Engine_Api::_()->apptouch()->isApp() ) {
      return false;
    }

    $viewer = Engine_Api::_()->user()->getViewer();
    $subject = Engine_Api::_()->core()->getSubject();

    if ($viewer->user_id == $subject->user_id) {
      return false;
    }
    $label = "CREDIT_Send Credits";

    return array(
      'label' => $label,
      'icon' => 'application/modules/Credit/externals/images/current.png',
      'route' => 'credit_general',
      'class' => 'smoothbox',
      'params' => array(
        'controller' => 'index',
        'action' => 'send',
        'user_id' => ( $viewer->getGuid(false) == $subject->getGuid(false) ? null : $subject->getIdentity()),
      )
    );
  }
}