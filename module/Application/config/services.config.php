<?php
return array(
    'factories' => array(
        'Application\Authentication\RbacIdentityProvider' => 'Application\Authentication\RbacIdentityProvider',
    ),
    'abstract_factories' => array(
        'Zend\Log\LoggerAbstractServiceFactory',
    ),
    'aliases' => array(
        'translator' => 'MvcTranslator',
    ),
);
