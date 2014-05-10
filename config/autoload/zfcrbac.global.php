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
        ),
    ),

    'providers' => array(
        'JmlRbacZdb\Provider\AdjacencyList\Role\ZendDb' => array(
            'connection' => 'Application\Factory\DbAdapter',
            'options' => array(
                'table' => 'role',
                'idColumn' => 'id',
                'nameColumn' => 'name',
                'joinColumn' => 'parent_id',
            ),
        ),
        'ZfcRbac\Provider\Generic\Permission\InMemory' => array(
            'permissions' => array(
                'admin' => array('admin'),
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
