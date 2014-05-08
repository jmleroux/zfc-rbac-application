<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function memberOnlyAction()
    {
        return new ViewModel();
    }

    public function adminOnlyAction()
    {
        return new ViewModel();
    }

    public function adminOrMemberAction()
    {
        return new ViewModel();
    }
}
