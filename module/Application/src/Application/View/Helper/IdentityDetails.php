<?php

namespace Application\View\Helper;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Helper\AbstractHelper;
use ZfcRbac\Service\AuthorizationService;
use ZfcRbac\Service\RoleService;

class IdentityDetails extends AbstractHelper implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function __invoke()
    {
        /** @var \ZfSimpleAuth\Authentication\Identity $identity */
        $identity = $this->getView()->identity();

        if (!$identity) {
            return "<p>Your are not authenticated</p>";
        }

        /** @var RoleService $roleService */
        $roleService = $this->getServiceManager()->get('ZfcRbac\Service\RoleService');
        $roles = $roleService->getIdentityRoles();

        $templateVars = [
            'name'  => $identity->getName(),
            'roles' => $roles,
        ];

        return $this->getView()->render('application/widgets/identity-details', $templateVars);
    }

    /**
     * @return ServiceManager
     */
    private function getServiceManager()
    {
        /** @var AbstractPluginManager $pluginManager */
        $pluginManager = $this->getServiceLocator();
        return $pluginManager->getServiceLocator();
    }
}
