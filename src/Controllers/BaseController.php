<?php
namespace Varavin\TestWidget\Controllers;

use Twig\Environment;
use Varavin\TestWidget\App;

class BaseController
{
    /** @var Environment */
    private $twig;

    public function __construct()
    {
        $this->twig = App::app()->getService(App::SERVICE_TWIG);
    }

    public function render(string $template, array $context = [])
    {
        return $this->twig->render($template, array_merge($context, [
            'vueJsTagsHtml' => $this->vueJsTagsHtml()
        ]));
    }

    private function vueJsTagsHtml(): string
    {
        $entryPointsFilePath = App::app()->getProjectRootDir() . '/public/build/entrypoints.json';
        $entryPointsArr = json_decode(file_get_contents($entryPointsFilePath), true);
        if (!isset($entryPointsArr['entrypoints'])) {
            return '';
        }

        $tagsHtml = '';
        foreach ($entryPointsArr['entrypoints']['app']['js'] as $js) {
            $tagsHtml .= '<script src="' . $js . '"></script>';
        }
        if (isset($entryPointsArr['entrypoints']['app']['css'])) {
            foreach ($entryPointsArr['entrypoints']['app']['css'] as $css) {
                $tagsHtml .= '<link rel="stylesheet" href="' . $css . '">';
            }
        }
        return $tagsHtml;
    }

}