<?php
namespace Tests\Controllers;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Varavin\TestWidget\Controllers\SiteController;

class SiteControllerTest extends TestCase
{
    public function testIndex()
    {
        $controller = new SiteController();
        $response = $controller->index();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertStringContainsString('<script src="/build/', $response->getContent());
    }
}
