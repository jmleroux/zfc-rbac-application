<?php
namespace ApplicationTest\Utils;

use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\ServiceManager;
use ZfcRbac\Service\AuthorizationService;
use ZfcRbac\Service\RoleService;

class AuthUtils
{
    /**
     * @var AuthenticationService $authenticationService
     */
    public $authenticationService;

    /**
     * @var \ZfSimpleAuth\Authentication\Adapter
     */
    public $authenticationAdapter;

    /**
     * @var AuthorizationService
     */
    public $authorizationService;

    /**
     * @var RoleService
     */
    public $roleService;

    public function __construct(ServiceManager $serviceManager)
    {
        $this->authenticationAdapter = $serviceManager->get('ZfSimpleAuth\Authentication\Adapter');
        $this->authenticationService = $serviceManager->get('Zend\Authentication\AuthenticationService');
        $this->authorizationService  = $serviceManager->get('ZfcRbac\Service\AuthorizationService');
        $this->roleService           = $serviceManager->get('ZfcRbac\Service\RoleService');
    }

    public function authenticate($username, $password)
    {
        $this->authenticationAdapter->setIdentity($username);
        $this->authenticationAdapter->setCredential($password);

        $result = $this->authenticationService->authenticate($this->authenticationAdapter);

        return $result;
    }
}
