<?php
namespace Varavin\TestWidget\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Varavin\TestWidget\Misc\SerializerWrapper;
use Varavin\TestWidget\Services\ApiService;

class ApiController
{
    public function widgetData(ApiService $apiService): Response
    {
        $widgetDataDto = $apiService->getWidgetData();

        return new JsonResponse(SerializerWrapper::objectToJson($widgetDataDto), Response::HTTP_OK, [], true);
    }
}
