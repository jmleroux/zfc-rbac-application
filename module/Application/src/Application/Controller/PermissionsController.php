<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PermissionsController extends AbstractActionController
{
    public function readAction()
    {
        $view = new ViewModel();
        $view->setTemplate('application/permissions/double-guard');
        $view->setVariables(
            [
                'route'           => 'permission-read',
                'routePermission' => 'read',
                'controller'      => __CLASS__,
                'controllerRoles' => '[member]',
            ]
        );

        return $view;
    }

    public function editAction()
    {
        $view = new ViewModel();
        $view->setTemplate('application/permissions/simple-permission-guard');
        $view->setVariables(
            [
                'permission' => 'edit',
            ]
        );

        return $view;
    }

    public function deleteAction()
    {
        $view = new ViewModel();
        $view->setTemplate('application/permissions/simple-permission-guard');
        $view->setVariables(
            [
                'permission' => 'delete',
            ]
        );

        return $view;
    }

    public function ctrlEditAction()
    {
        $view = new ViewModel();
        $view->setTemplate('application/permissions/simple-permission-guard');
        $view->setVariables(
            [
                'permission' => 'edit',
            ]
        );

        return $view;
    }
}
