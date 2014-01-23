<?php return array(
    'package' =>
    array(
        'type' => 'module',
        'name' => 'apptouch',
        'version' => '4.2.4',
        'path' => 'application/modules/Apptouch',
        'title' => 'New Touch-Mobile',
        'description' => 'Touch',
        'author' => '<a href="http://www.hire-experts.com" title="Hire-Experts LLC" target="_blank">Hire-Experts LLC</a>',
        'meta' =>
        array(
            'title' => 'New Touch-Mobile',
            'description' => 'New Touch-Mobile',
            'author' => '<a href="http://www.hire-experts.com" title="Hire-Experts LLC" target="_blank">Hire-Experts LLC</a>',
        ),
        'dependencies' => array(
            array(
                'type' => 'module',
                'name' => 'core',
                'minVersion' => '4.1.8',
            ),
            array(
                'type' => 'module',
                'name' => 'hecore',
                'minVersion' => '4.2.0p5',
            ),
        ),
        'callback' =>
        array(
            'path' => 'application/modules/Apptouch/settings/install.php',
            'class' => 'Apptouch_Installer',
        ),
        'actions' =>
        array(
            0 => 'install',
            1 => 'upgrade',
            2 => 'refresh',
            3 => 'enable',
            4 => 'disable',
        ),
        'directories' =>
        array(
            0 => 'application/modules/Apptouch',
        ),
        'files' =>
        array(
            0 => 'application/languages/en/apptouch.csv',
        ),
    ),
    'items' => array(
      'apptouch_ad',
      'apptouch_adphoto'
    ),
    'routes' => array(
        'inviter_invitations_apptouch' => array(
            'route' => 'inviter/invites/',
            'defaults' => array(
                'module' => 'inviter',
                'controller' => 'invitations',
                'action' => 'index'
            )
        ),
        'inviter_referral' => array(
            'route' => 'referral-code/:code',
            'defaults' => array(
                'module' => 'inviter',
                'controller' => 'referrals',
                'action' => 'referral',
                'code' => 0
            ),
        )
    )

); ?>