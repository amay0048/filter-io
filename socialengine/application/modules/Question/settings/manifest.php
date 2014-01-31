<?php return array (
  'package' => 
  array (
    'type' => 'module',
    'name' => 'question',
    'version' => '4.0.0',
    'path' => 'application/modules/Question',
    'title' => 'Question',
    'description' => 'Allows a user to submit a HooZoo Question',
    'author' => 'Anthony May',
    'callback' => 
    array (
      'class' => 'Engine_Package_Installer_Module',
    ),
    'actions' => 
    array (
      0 => 'install',
      1 => 'upgrade',
      2 => 'refresh',
      3 => 'enable',
      4 => 'disable',
    ),
    'directories' => 
    array (
      0 => 'application/modules/Question',
    ),
    'files' => 
    array (
      0 => 'application/languages/en/question.csv',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
	'question_question',
	'question'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
	  'question_extended' => array(
	    'route' => 'question/:controller/:action/*',
	    'defaults' => array(
		  'module' => 'question',
		  'controller' => 'index',
		  'action' => 'index',
	  ),
	  'reqs' => array(
		'controller' => '\D+',
		'action' => '\D+',
	  )
	),
	'question_general' => array(
	  'route' => 'questions/:action/*',
	  'defaults' => array(
		'module' => 'question',
		'controller' => 'index',
		'action' => 'browse',
	  ),
	  'reqs' => array(
		'action' => '(browse|create|list|manage|map)',
	  )
	),
	'question_map' => array(
	  'route' => 'questions/:action/:keyword/*',
	  'defaults' => array(
		'module' => 'question',
		'controller' => 'index',
		'action' => 'map',
	  ),
	  'reqs' => array(
		'action' => '(map)',
	  )
	),
	'question_specific' => array(
	  'route' => 'questions/:action/:question_id/*',
	  'defaults' => array(
		'module' => 'question',
		'controller' => 'question',
		'action' => 'index',
	  ),
	  'reqs' => array(
		'action' => '(edit|delete)',
		'question_id' => '\d+',
	  )
	),
	'question_profile' => array(
	  'route' => 'question/:id/*',
	  'defaults' => array(
		'module' => 'question',
		'controller' => 'profile',
		'action' => 'index',
	  ),
	  'reqs' => array(
		'id' => '\d+',
	  )
	),
  )
); ?>