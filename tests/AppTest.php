<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Varavin\TestWidget\App;

class AppTest extends TestCase
{
    public function testInit()
    {
        ob_start();
        $app = App::app();
        ob_end_clean();

        $this->assertStringStartsWith($app->getProjectRootDir(), __DIR__);
    }
}
