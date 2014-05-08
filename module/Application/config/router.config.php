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
    ),
);
