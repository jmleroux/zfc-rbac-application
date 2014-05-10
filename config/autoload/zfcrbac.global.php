<?php
/**
 * ZfcRbac Configuration
 *
 * If you have a ./config/autoload/ directory set up for your project, you can
 * drop this config file in it and change the values as you wish.
 */
$settings = array(
    /**
     * The default role that is used if no role is found from the
     * role provider.
     */
    'anonymousRole' => 'anonymous',

    /**
     * Flag: enable or disable the routing firewall.
     */
    'firewallRoute' => true,

    /**
     * Flag: enable or disable the controller firewall.
     */
    'firewallController' => false,

    /**
     * Set the view template to use on a 403 error.
     */
    'template' => 'error/403',

    /**
     * flag: enable or disable the use of lazy-loading providers.
     */
    'enableLazyProviders' => false,

    'firewalls' => array(
        'ZfcRbac\Firewall\Route' => array(
            array('route' => 'admin-only', 'roles' => 'admin'),
            array('route' => 'member-only', 'roles' => 'member'),
            array('route' => 'other-only', 'roles' => 'other'),
            array('route' => 'admin-or-member', 'roles' => array('member', 'admin')),
            array('route' => 'read-permission', 'permissions' => 'read'),
            array('route' => 'update-permission', 'permissions' => 'edit'),
            array('route' => 'delete-permission', 'permissions' => 'delete'),
        ),
    ),

    'providers' => array(
        'ZfcRbac\Provider\Generic\Role\InMemory' => array(
            'roles' => array(
                'admin',
                'member' => array('admin'),
                'other',
            ),
        ),
        'ZfcRbac\Provider\Generic\Permission\InMemory' => array(
            'permissions' => array(
                'admin' => array('delete'),
                'member' => array('read'),
                'other' => array('edit'),
            )
        ),
    ),

    /**
     * Set the identity provider to use. The identity provider must be retrievable from the
     * service locator and must implement \ZfcRbac\Identity\IdentityInterface.
     */
    'identity_provider' => 'standard_identity'
);

$serviceManager = array(
    'factories' => array(
        'standard_identity' => 'Application\Authentication\RbacIdentityProvider',
    )
);

/**
 * You do not need to edit below this line
 */
return array(
    'zfcrbac' => $settings,
    'service_manager' => $serviceManager,
);
