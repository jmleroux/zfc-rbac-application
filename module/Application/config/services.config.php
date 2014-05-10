<?php
return array(
    'factories' => array(
        'Application\Authentication\RbacIdentityProvider' => 'Application\Authentication\RbacIdentityProvider',
        'Application\Factory\DbAdapter' => 'Application\Factory\DbAdapter',
    ),
    'abstract_factories' => array(
        'Zend\Log\LoggerAbstractServiceFactory',
    ),
    'aliases' => array(
        'translator' => 'MvcTranslator',
    ),
);
