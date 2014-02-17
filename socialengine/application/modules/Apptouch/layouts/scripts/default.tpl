<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Apptouch
 * @copyright  Copyright Hire-Experts LLC
 * @license    http://www.hire-experts.com
 */
?>
<?php $baseurl = Zend_Registry::get('StaticBaseUrl'); ?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN">

<?php
//  $arr = Zend_Json::decode($this->jsonInline($this->content));
//  echo($arr['html']);
$locale = $this->locale()->getLocale()->__toString(); $orientation = ($this->layout()->orientation == 'right-to-left' ? 'rtl' : 'ltr'); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $locale ?>" lang="<?php echo $locale ?>"
      dir="<?php echo $orientation ?>"
  >
<head>
  <title><?php echo @$this->page['info']['title'] ?></title>
  <meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;" name="viewport">
  <?php if($this->homeScreen()) echo $this->homeScreen()->render(); ?>
  <meta content="<?php echo APPLICATION_ENV ?>" name="app_env">
  <meta content="<?php echo $this->isMaintenanceMode(); ?>" name="is_maintenance">
  <base href="<?php echo rtrim((constant('_ENGINE_SSL') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $this->baseUrl(), '/') . '/' ?>"/>

	<!-- (amay0048) -->
	<style>
        #hz-footer{
            position: fixed;
            bottom: 0;
            left: 0;
            display: block;
            width: 100%;
            z-index: 300;
            height:51px;
            background:#fff;
        }
        #hz-footer a{
            width:24%;
            text-indent:-10000px;
            display:block;
            height:31px;
            width:31px;
            background:green;
            position:absolute;
            top:10px;
            z-index:900;
        }
        #hz-footer a.fit,
        #hz-footer a.food,
        #hz-footer a.med,
        #hz-footer a.search{
            background:url('/socialengine/hzsearch/sprite.png') no-repeat 0 0;
            background-size: 50px 850px;
        }
        
        #hz-footer a.med{
            left:23px;
            background-position: 0 -150px;
        }
        #hz-footer a.food{
            left:72px;
            background-position: 0 -188px;
        }
        #hz-footer a.fit{
            right:77px;
            width:25px;
            background-position: 0 -228px;
        }
        #hz-footer a.search{
            right:23px;
            width:35px;
            background-position: 0 -268px;
        }
        #hz-footer .profile-container{
            position:absolute;
            top:-34px;
            left:0;
            width:100%;
            text-align:center;
        }
        #hz-footer .profile{
            -webkit-box-shadow: inset 0 0 2px 1px rgba(0,0,0,0.3);
            box-shadow: inset 0 0 2px 1px rgba(0,0,0,0.3);
            background: -moz-linear-gradient(top, #2bbeca 0%, #3a54a4 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2bbeca), color-stop(100%, #3a54a4));
            background: -webkit-linear-gradient(top, #2bbeca 0%, #3a54a4 100%);
            background: -o-linear-gradient(top, #2bbeca 0%, #3a54a4 100%);
            background: -ms-linear-gradient(top, #2bbeca 0%, #3a54a4 100%);
            background: linear-gradient(to bottom, #2bbeca 0%, #3a54a4 100%);
            display:block;
            margin:0 auto;
            height:56px;
            width:56px;
            padding:6px;
            border-radius:78px;
            float:none;
            position:relative;
        }
        #hz-footer .profile img{
            height:56px;
            width:56px;
            border-radius:56px;
            display:block;
        }
        #header-logo{
            position:fixed;
            top:3px;
            left:50%;
            z-index:201;
            display:block;
            margin-left:-48px;
        }
        #header-logo img{
            height:32px;
            width:95px;
        }
		#mobile-search .ui-btn{
			width:45%;
			float:left;
			margin-right:5%;
		}
		
		.user-search-result {
			padding: 10px;
			overflow: auto;
			margin: 10px;
			background: #fff;
			position: relative;
			background: linear-gradient(to bottom, #f7f7f7 0%, #f5f5f5 1%, #ededed 100%);
			-webkit-box-shadow: 0px 1px 2px 1px rgba(0, 0, 0, 0.2);
			box-shadow: 0px 1px 2px 1px rgba(0, 0, 0, 0.2);
			border-radius: 5px;
		}
		.user-search-result .object_thumb{
			float:left;
			margin-right:8px;
		}
		.user-search-result .mutualmembers_thumb{
			float:right;
			margin-left:8px;
		}
		.user-search-result .friends-count {
			display:block;
		}
    </style>

  <?php // LINK/STYLES ?>
  <?php
  $this->headMeta()
			->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')
      ->appendHttpEquiv('Content-Language', $this->locale()->getLocale()->__toString());

  $staticBaseUrl = $this->layout()->staticBaseUrl;

  echo $this->apptouch()->css();
//  ->prependStylesheet($staticBaseUrl . 'application/modules/Apptouch/externals/styles/jquery.mobile-1.2.0.css');

//  Enable Theme {
  echo $this->theme();
//  } Enable Theme
  // Tablet css files
  if (Engine_Api::_()->apptouch()->isTabletMode()){
    echo $this->apptablet()->css();
  }
  echo $this->headMeta()->toString()."\n";
  ?>

</head>
<?php
$request = Zend_Controller_Front::getInstance()->getRequest();
?>

<body
  id="global_page_<?php echo $request->getModuleName() . '-' . $request->getControllerName() . '-' . $request->getActionName() ?>"
  class="apptouch-body <?php if (Engine_Api::_()->apptouch()->isTabletMode()){ ?>tablet<?php } else { ?> phone <?php } ?>">
<a id="header-logo" href="<?php echo $baseurl . 'members/home';?>">
<img src="<?php echo $baseurl . 'hzsearch/logo.png';?>" />
</a>
<?php echo $this->localeFormats()->render();
$baseUrl = $this->baseUrl();
?>
<style>
@font-face {
  font-family: 'FontAwesome';
  src: url('<?php echo $baseUrl ?>/application/modules/Apptouch/externals/fonts/fontawesome-webfont.eot?v=3.0.1');
  src: url('<?php echo $baseUrl ?>/application/modules/Apptouch/externals/fonts/fontawesome-webfont.eot?#iefix&v=3.0.1') format('embedded-opentype'),
    url('<?php echo $baseUrl ?>/application/modules/Apptouch/externals/fonts/fontawesome-webfont.woff?v=3.0.1') format('woff'),
    url('<?php echo $baseUrl ?>/application/modules/Apptouch/externals/fonts/fontawesome-webfont.ttf?v=3.0.1') format('truetype');
  font-weight: normal;
  font-style: normal;
}
</style>
<div id="initial_page" data-role="page" data-theme="a" data-url="initial_page">

	<img class="site-logo" src="<?php echo $this->siteLogo()->url() ?>" />
	<h1 class="site-title"><?php $title = $this->layout()->siteinfo['title']; 
echo $this->translate('' . (is_array($title) ? $title[Zend_Registry::get('Locale')->getLanguage()] : $title)) ?></h1>
  <span class="site-description"><?php $desc = $this->layout()->siteinfo['description']; echo is_array($desc) ? $desc[Zend_Registry::get('Locale')->getLanguage()] : $desc?></span>
	<h4><?php echo $this->translate('Copyright &copy;%s', date('Y')) ?></h4>
</div><!-- /page -->
<?php
$this->addScriptPath('application/modules/Apptouch/views/scripts');

?>
<!-- Like, Unlike effect Elements on the Wall { -->
<span class="icon-thumbs-up buttonAnimate" style="display: none;"></span>
<span class="icon-thumbs-down buttonAnimate" style="display: none;"></span>
<!-- } Like, Unlike effect Elements on the Wall -->

<?php
$isDev = APPLICATION_ENV == 'development' ||
  Engine_Api::_()->getDbTable('settings', 'core')->getSetting('apptouch.use.dev.scripts', false);  // HOSTISO & CLOUD-FLARE EXCEPTION$envDir =  $isDev ? 'dev/' : '';
// SCRIPTS
if(array_key_exists('HTTP_USER_AGENT', $_SERVER) && preg_match("/trident\/(4|3)/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/' . $envDir . 'ie.js');

echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/' . $envDir . 'picup.js');
if($isDev){
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/jquery.js');
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/jquery.mobile-1.2.0.js');
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/eikooc.js');
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/photoswipe/lib/klass.min.js');
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/photoswipe/code.photoswipe.jquery-3.0.4.js');
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/jqmWidgets.js');
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/core.js');
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/initializers.js');
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/components.js');
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/activity.js');
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/iscroll.js');
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/dev/chat.js');
}else
  echo $this->apptouchScript($baseUrl . '/application/modules/Apptouch/externals/scripts/js.js');

echo $this->lang()->add(array(
  'Page Not Found',
  'Go Back',
  'APPTOUCH_Upload Success',
  'APPTOUCH_Ooops! Sorry, something went wrong...',
  'APPTOUCH_Please enable pop-up windows for this site and try again.',
  '%s view',
  '%1$s of %2$s',
  'APPTOUCH_Detecting faces...',
  'APPTOUCH_Swipe to clear hashtag filter'
))->toString();
echo $this->templates()->render();

// Tablet js files
if (Engine_Api::_()->apptouch()->isTabletMode()){
  echo $this->apptablet()->scripts();
}

if (Engine_Api::_()->getDbTable('modules', 'core')->isModuleEnabled('checkin')){
  $prefix = (constant('_ENGINE_SSL') ? 'https://' : 'http://');

  echo $this->apptouchScript($prefix.'maps.google.com/maps/api/js?sensor=true');
  echo $this->apptouchScript($prefix.'maps.googleapis.com/maps/api/js?sensor=false&libraries=places');
}
?>
<!-- (amay0048) not the right spot for this. TODO: fix it later -->
<script type="text/javascript" src="/socialengine/hzsearch/search.js"></script>
<script type="text/javascript" src="/socialengine/hzsearch/providers.js"></script>
<script type="text/javascript" src="/socialengine/hzsearch/POS/lexicon.js"></script>
<script type="text/javascript" src="/socialengine/hzsearch/POS/lexer.js"></script>
<script type="text/javascript" src="/socialengine/hzsearch/POS/POSTagger.js"></script>
<script type="text/javascript" src="/socialengine/hzsearch/exclusion.js"></script>

<script data-cfasync="false" type="text/javascript">
  $(document).bind("ready", function () {
    core.construct(<?php echo @$this->jsonInline($this->getVars()); ?>);
  });
  core.setBaseUrl('<?php echo $this->url(array(), 'default', true) ?>');
</script>
<!-- (amay0048) hardcoded footer for the time being -->
<div id="hz-footer">
	<a class="med" href="<?php echo $baseurl . 'members/home';?>">Information</a>
	<a data-nocache="true" data-transition="fade" data-rel="dialog" data-ajax="true" class="food" href="<?php echo $baseurl . 'store';?>">Shop</a>
    <div class="profile-container">
        <a class="profile" href="<?php echo Engine_Api::_()->user()->getViewer()->toRemoteArray()["href"]; ?>">
            <img src="<?php echo Engine_Api::_()->user()->getViewer()->toRemoteArray()["photo"]; ?>"/>
        </a>
    </div>
	<a class="fit" href="<?php echo $baseurl . 'questions/map/gp';?>">Locations</a>
	<a class="search" href="<?php echo $baseurl . 'questions/create';?>">Search</a>
</div>
</body>
</html>