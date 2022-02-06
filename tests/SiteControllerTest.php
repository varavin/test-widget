<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Varavin\TestWidget\Controllers\SiteController;

class SiteControllerTest extends TestCase
{
    public function testIndex()
    {
        $controller = new SiteController();
        $this->assertEquals(Response::HTTP_OK, $controller->index()->getStatusCode());
        $this->assertStringContainsString('<script src="/build/', $controller->index()->getContent());
    }
}
