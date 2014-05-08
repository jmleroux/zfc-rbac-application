<?php

namespace Application\Authentication;

use ZfcRbac\Identity\IdentityInterface;

class RbacIdentity implements IdentityInterface
{
    protected $roles = [];

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    public function getRoles()
    {
        return $this->roles;
    }
}
