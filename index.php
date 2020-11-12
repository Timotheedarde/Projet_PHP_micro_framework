<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ .'/vendor/autoload.php';
require __DIR__ . '/config/common.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\TwigMiddleware;
use Slim\Views\Twig;
use RPG\Model\Map as MapModel;

$twig = Twig::create(
    TEMPLATE_PATH_WWW,
    [
        // 'cache' => TEMPLATE_CACHE_PATH
    ]
);

$app = AppFactory::create();
$app->add(TwigMiddleware::create($app, $twig));
$app->get(
    '/',
    function(Request $request, Response $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, '/index.twig', [
            'name' => 'David'
        ]);
    }
);
$app->get(
    '/map',
    function(Request $request, Response $response, $args) {

        $maps = MapModel::get();

        $view = Twig::fromRequest($request);
        return $view->render($response, '/map/index.twig', [
            'items' => array_map(
                function(MapModel $map) {
                    $item = $map->toArray();
                    $item['typeLabel'] = $map->getTypeLabel();
                    return $item;
                },
                $maps
            )
        ]);
    }
);
$app->get('/map/create', ['\RPG\Controller\Map', 'create']);
$app->post('/map/create', ['\RPG\Controller\Map', 'create']);
$app->get('/map/{id}/', ['\RPG\Controller\Map', 'edit']);
$app->post('/map/{id}/', ['\RPG\Controller\Map', 'edit']);
$app->delete(
    '/api/map/{id}/delete',
    function(Request $request, Response $response, $args) {
        $id = (int)$args['id'];
        $map = MapModel::fromId($id);
        $map->delete();

        $result = ['status' => 'ok'];
        $response->getBody()->write(json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
);
$app->run();
