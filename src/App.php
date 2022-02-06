<?php
namespace Varavin\TestWidget;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Varavin\TestWidget\Controllers\ApiController;
use Varavin\TestWidget\Controllers\SiteController;
use Varavin\TestWidget\Misc\FinancialApiWrapper;
use Varavin\TestWidget\Services\ApiService;

class App
{
    private static $instance = null;

    /** @var ContainerBuilder */
    private $containerBuilder = null;

    /** @var string */
    private $projectRootDir;

    public const SERVICE_API = 'ApiService';
    public const SERVICE_TWIG = 'TwigService';

    public static function app(): self
    {
        if (static::$instance === null) {
            static::$instance = new static();
            static::$instance->init();
        }

        return static::$instance;
    }

    public function getService(string $serviceId)
    {
        return $this->containerBuilder->get($serviceId);
    }

    public function getProjectRootDir(): string
    {
        return $this->projectRootDir;
    }

    private function init()
    {
        $this->projectRootDir = realpath(__DIR__ . '/../');

        (new Dotenv())->load($this->projectRootDir . '/.env', $this->projectRootDir . '/.env.local');

        $this->containerBuilder = new ContainerBuilder();
        $this->containerBuilder->register(self::SERVICE_API, ApiService::class)
            ->addArgument(new FinancialApiWrapper());
        $this->containerBuilder->register(self::SERVICE_TWIG, Environment::class)
            ->addArgument(new FilesystemLoader($this->projectRootDir . '/templates'))
            ->addArgument(['runtime' => $this->projectRootDir . '/runtime/twig']);

        $routes = new RouteCollection();
        $routes->add('index', new Route('/', [
            '_controller' => SiteController::class . '::index'
        ], [], [], '', [], ['GET']));
        $routes->add('api/test', new Route('/api/widget_data', [
            '_controller' => ApiController::class . '::widgetData',
            'apiService' => $this->getService(self::SERVICE_API)
        ], [], [], '', [], ['GET']));

        try {
            $request = Request::createFromGlobals();
            $context = (new RequestContext())->fromRequest($request);
            $urlMatcher = new UrlMatcher($routes, $context);
            $controllerResolver = new ControllerResolver();
            $argumentResolver = new ArgumentResolver();
            $request->attributes->add($urlMatcher->match($request->getPathInfo()));
            $controller = $controllerResolver->getController($request);
            $arguments = $argumentResolver->getArguments($request, $controller);
            /** @var $response Response */
            $response = call_user_func_array($controller, $arguments);
        } catch (Routing\Exception\ResourceNotFoundException $exception) {
            $response = new Response('404 Not Found', Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            $response = new Response('Exception: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response->send();
    }


    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }
}