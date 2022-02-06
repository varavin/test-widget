<?php
namespace Varavin\TestWidget\Controllers;

use Symfony\Component\HttpFoundation\Response;

class SiteController extends BaseController
{
    public function index(): Response
    {
        return new Response($this->render('index.twig'));
    }
}
