<?php

namespace ApplicationTest\Controller;

use ApplicationTest\Utils\AuthUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class PermissionsControllerTest extends AbstractHttpControllerTestCase
{
    /**
     * @var AuthUtils $authUtils
     */
    private $authUtils;

    public function setUp()
    {
        /** @noinspection PhpIncludeInspection */
        $this->setApplicationConfig(
            include 'config/application.config.php'
        );
        parent::setUp();

        // logout
        $serviceManager = $this->getApplicationServiceLocator();

        $this->authUtils = new AuthUtils($serviceManager);
        $this->authUtils->authenticationService->clearIdentity();

        $this->assertFalse($this->authUtils->authenticationService->hasIdentity());
    }

    public function testReadActionAccess()
    {
        $url = '/read-permission';

        $this->dispatch($url);

        $this->assertResponseStatusCode(403);

        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Permissions');
        $this->assertControllerClass('PermissionsController');
        $this->assertActionName('read');
        $this->assertMatchedRouteName('read-permission');

        $this->reset();
        $this->authenticate('demo-member', 'foobar');
        $this->assertTrue($this->authUtils->authorizationService->isGranted('read'));
        $this->assertTrue($this->authUtils->roleService->matchIdentityRoles(['member']));

        $this->dispatch($url);

        $this->assertResponseStatusCode(200);

        $this->reset();
        $this->authenticate('demo-admin', 'foobar');
        $this->assertTrue($this->authUtils->authorizationService->isGranted('read'));
        $this->assertTrue($this->authUtils->roleService->matchIdentityRoles(['member']));

        $this->dispatch($url);

        $this->assertResponseStatusCode(200);

        $this->reset();
        $this->authenticate('demo-other', 'foobar');
        $this->assertTrue($this->authUtils->authorizationService->isGranted('read'));
        $this->assertFalse($this->authUtils->roleService->matchIdentityRoles(['member']));

        $this->dispatch($url);

        $this->assertResponseStatusCode(403);
    }

    public function testEditActionCannotBeAccessedAnonymously()
    {
        $url = '/update-permission';

        $this->dispatch($url);

        $this->assertResponseStatusCode(403);

        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Permissions');
        $this->assertControllerClass('PermissionsController');
        $this->assertActionName('edit');
        $this->assertMatchedRouteName('update-permission');

        $this->reset();
        $this->authenticate('demo-member', 'foobar');
        $this->assertFalse($this->authUtils->authorizationService->isGranted('edit'));

        $this->dispatch($url);

        $this->assertResponseStatusCode(403);

        $this->reset();
        $this->authenticate('demo-admin', 'foobar');
        $this->assertTrue($this->authUtils->authorizationService->isGranted('edit'));

        $this->dispatch($url);

        $this->assertResponseStatusCode(200);

        $this->reset();
        $this->authenticate('demo-other', 'foobar');
        $this->assertTrue($this->authUtils->authorizationService->isGranted('edit'));

        $this->dispatch($url);

        $this->assertResponseStatusCode(200);
    }


    public function authenticate($username, $password)
    {
        $result = $this->authUtils->authenticate($username, $password);

        $this->assertTrue($result->isValid());
        $this->assertTrue($this->authUtils->authenticationService->hasIdentity());
    }
}
