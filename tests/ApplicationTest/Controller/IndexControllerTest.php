<?php

namespace ApplicationTest\Controller;

use ApplicationTest\Utils\AuthUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
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

    public function testIndexActionCanBeAccessed()
    {
        $url = '/';

        $this->dispatch($url);

        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertActionName('index');
        $this->assertMatchedRouteName('home');
    }

    public function testIndexActionResponse()
    {
        $this->dispatch('/');
        $response = $this->getResponse();

        $this->assertContains('ZfcRbac Application on GitHub', $response->getContent());
    }

    public function testMemberOnlyActionAccess()
    {
        $url = '/member-only';

        $this->dispatch($url);

        $this->assertResponseStatusCode(403);
        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertActionName('memberOnly');
        $this->assertMatchedRouteName('member-only');

        $this->reset();
        $this->authenticate('demo-member', 'foobar');
        $this->dispatch($url);

        $this->assertResponseStatusCode(200);

        $this->reset();
        $this->authenticate('demo-admin', 'foobar');
        $this->dispatch($url);

        $this->assertResponseStatusCode(200);

        $this->reset();
        $this->authenticate('demo-other', 'foobar');
        $this->dispatch($url);

        $this->assertResponseStatusCode(403);
    }

    public function testAdminOnlyActionAccess()
    {
        $url = '/admin-only';

        $this->dispatch($url);

        $this->assertResponseStatusCode(403);
        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertActionName('adminOnly');
        $this->assertMatchedRouteName('admin-only');

        $this->reset();
        $this->authenticate('demo-admin', 'foobar');
        $this->dispatch($url);

        $this->assertResponseStatusCode(200);

        $this->reset();
        $this->authenticate('demo-member', 'foobar');
        $this->dispatch($url);

        $this->assertResponseStatusCode(403);

        $this->reset();
        $this->authenticate('demo-other', 'foobar');
        $this->dispatch($url);

        $this->assertResponseStatusCode(403);
    }

    public function testAdminOrMemberOnlyActionAccess()
    {
        $url = '/admin-or-member';

        $this->dispatch($url);

        $this->assertResponseStatusCode(403);
        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertActionName('adminOrMember');
        $this->assertMatchedRouteName('admin-or-member');

        $this->reset();
        $this->authenticate('demo-admin', 'foobar');
        $this->dispatch($url);

        $this->assertResponseStatusCode(200);

        $this->reset();
        $this->authenticate('demo-member', 'foobar');
        $this->dispatch($url);

        $this->assertResponseStatusCode(200);

        $this->reset();
        $this->authenticate('demo-other', 'foobar');
        $this->dispatch($url);

        $this->assertResponseStatusCode(403);
    }

    public function testOtherOnlyActionAccess()
    {
        $this->dispatch('/other-only');

        $this->assertResponseStatusCode(403);
        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertActionName('otherOnly');
        $this->assertMatchedRouteName('other-only');

        $this->reset();
        $this->authenticate('demo-other', 'foobar');
        $this->dispatch('/other-only');

        $this->assertResponseStatusCode(200);

        $this->reset();
        $this->authenticate('demo-admin', 'foobar');
        $this->dispatch('/other-only');

        $this->assertResponseStatusCode(403);

        $this->reset();
        $this->authenticate('demo-member', 'foobar');
        $this->dispatch('/other-only');

        $this->assertResponseStatusCode(403);
    }

    public function authenticate($username, $password)
    {
        $result = $this->authUtils->authenticate($username, $password);

        $this->assertTrue($result->isValid());
        $this->assertTrue($this->authUtils->authenticationService->hasIdentity());
    }
}