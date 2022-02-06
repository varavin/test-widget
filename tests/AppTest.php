<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Varavin\TestWidget\App;

class AppTest extends TestCase
{
    public function testInit()
    {
        $app = App::app();
        $this->assertNotEmpty($app->getProjectRootDir());
    }
}
