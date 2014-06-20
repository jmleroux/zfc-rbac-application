<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        /** @noinspection PhpIncludeInspection */
        $this->setApplicationConfig(
            include 'config/application.config.php'
        );
        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/');
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

    public function testMemberOnlyActionCannotBeAccessedAnonymously()
    {
        $this->dispatch('/member-only');
        $this->assertResponseStatusCode(403);

        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertActionName('memberOnly');
        $this->assertMatchedRouteName('member-only');
    }

    public function testAdminOnlyActionCannotBeAccessedAnonymously()
    {
        $this->dispatch('/admin-only');
        $this->assertResponseStatusCode(403);

        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertActionName('adminOnly');
        $this->assertMatchedRouteName('admin-only');
    }

    public function testAdminOrMemberOnlyActionCannotBeAccessedAnonymously()
    {
        $this->dispatch('/admin-or-member');
        $this->assertResponseStatusCode(403);

        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertActionName('adminOrMember');
        $this->assertMatchedRouteName('admin-or-member');
    }

    public function testOtherOnlyActionCannotBeAccessedAnonymously()
    {
        $this->dispatch('/other-only');
        $this->assertResponseStatusCode(403);

        $this->assertModuleName('Application');
        $this->assertControllerName('Application\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertActionName('otherOnly');
        $this->assertMatchedRouteName('other-only');
    }
}