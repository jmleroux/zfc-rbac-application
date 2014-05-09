<?php

namespace Application\Authentication;

use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcRbac\Identity\StandardIdentity;
use ZfSimpleAuth\Authentication\Identity;

class RbacIdentityProvider implements FactoryInterface
{
    /**
     * @var AuthenticationService $authenticationService
     */
    protected $authenticationService;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->authenticationService = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        /** @var Identity $identity */
        $identity = $this->authenticationService->getIdentity();
        $roles = array();
        if ($identity) {
            $roles = $identity->getRoles();
        }
        $rbacIdentity = new StandardIdentity($roles);
        return $rbacIdentity;
    }
}
