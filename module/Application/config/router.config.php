<?php
return array(
    'routes' => array(
        'home' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'Application\Controller\Index',
                    'action' => 'index',
                ),
            ),
        ),
        'member-only' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/member-only',
                'defaults' => array(
                    'controller' => 'Application\Controller\Index',
                    'action' => 'memberOnly',
                ),
            ),
        ),
        'admin-only' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/admin-only',
                'defaults' => array(
                    'controller' => 'Application\Controller\Index',
                    'action' => 'adminOnly',
                ),
            ),
        ),
        'admin-or-member' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/admin-or-member',
                'defaults' => array(
                    'controller' => 'Application\Controller\Index',
                    'action' => 'adminOrMember',
                ),
            ),
        ),
        'other-only' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/other-only',
                'defaults' => array(
                    'controller' => 'Application\Controller\Index',
                    'action' => 'otherOnly',
                ),
            ),
        ),
        'read-permission' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/read-permission',
                'defaults' => array(
                    'controller' => 'Application\Controller\Permissions',
                    'action' => 'read',
                ),
            ),
        ),
        'update-permission' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/update-permission',
                'defaults' => array(
                    'controller' => 'Application\Controller\Permissions',
                    'action' => 'update',
                ),
            ),
        ),
        'delete-permission' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/delete-permission',
                'defaults' => array(
                    'controller' => 'Application\Controller\Permissions',
                    'action' => 'delete',
                ),
            ),
        ),
    ),
);
