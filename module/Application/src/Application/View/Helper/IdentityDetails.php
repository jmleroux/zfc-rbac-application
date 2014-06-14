<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class IdentityDetails extends AbstractHelper
{
    public function __invoke()
    {
        /** @var \ZfSimpleAuth\Authentication\Identity $identity */
        $identity = $this->getView()->identity();

        if (!$identity) {
            return "<p>Your are not authenticated</p>";
        }

        $templateVars = [
            'name'  => $identity->getName(),
            'roles' => $identity->getRoles(),
        ];

        return $this->getView()->render('application/widgets/identity-details', $templateVars);
    }
}
