<?php

namespace Application\Authentication;

use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcRbac\Identity\IdentityInterface;
use ZfcRbac\Identity\IdentityProviderInterface;

class RbacIdentityProvider implements FactoryInterface, IdentityProviderInterface
{
    /**
     * @var AuthenticationService $authenticationService
     */
    protected $authenticationService;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var AuthenticationService $authenticationService */
        $this->authenticationService = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        return $this;
    }

    /**
     * Get the identity
     *
     * @return IdentityInterface|null
     */
    public function getIdentity()
    {
        $identity = $this->authenticationService->getIdentity();
        $rbacIdentity = new RbacIdentity();
        if ($identity) {
            $rbacIdentity->setRoles($identity->getRoles());
        }
        return $rbacIdentity;
    }
}
