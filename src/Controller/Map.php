<?php

namespace RPG\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use RPG\Model\Map as MapModel;

/**
 * Class Map
 * @package RPG\Controller
 */
class Map
{
    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     * @throws \RPG\Exception\RecordNotFoundException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public static function create(Request $request, Response $response, $args)
    {
        $errors = [];
        $params = array_merge(
            [
                'type' => '',
                'position_x' => null,
                'position_y' => null,
                'store_id' => 0,
                'enemy_id' => 0,
            ],
            $request->getParsedBody() ?? []
        );

        if ($request->getMethod() === 'POST') {
            $map = new MapModel();
            if (static::save($map, $params, $errors)) {
                return $response
                    ->withHeader('Location', '/map')
                    ->withStatus(302);
            }
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, '/map/edit.twig', [
            'url' => '/map/create',
            'types' => MapModel::getTypeLabels(),
            'errors' => $errors,
            'data' => $params,
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     * @throws \RPG\Exception\RecordNotFoundException
     * @throws \ReflectionException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public static function edit(Request $request, Response $response, $args)
    {
        $map = MapModel::fromId($args['id']);

        $errors = [];
        $params = array_merge(
            $map->toArray(),
            $request->getParsedBody() ?? []
        );

        if ($request->getMethod() === 'POST') {
            if (static::save($map, $params, $errors)) {
                return $response
                    ->withHeader('Location', '/map')
                    ->withStatus(302);
            }
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, '/map/edit.twig', [
            'url' => sprintf('/map/%d/', $map->getId()),
            'types' => MapModel::getTypeLabels(),
            'errors' => $errors,
            'data' => $params,
        ]);
    }

    /**
     * @param MapModel $map
     * @param array $params
     * @param $errors
     * @return boolean
     * @throws \RPG\Exception\RecordNotFoundException
     */
    protected static function save(MapModel $map, array $params, &$errors)
    {
        $errors = static::checkData($params);
        if ($errors) {
            return false;
        }

        $map->setPosition($params['position_x'], $params['position_y']);
        $map->setType($params['type']);
        $map->setStoreId($params['store_id']);
        $map->setEnemy($params['enemy_id']);
        $map->save();

        return true;
    }

    /**
     * @param array $params
     * @return array
     */
    protected static function checkData(array $params)
    {
        $errors = [];
        if (!(int)$params['type']) {
            $errors[] = 'Il manque le type.';
        } else {
            try {
                $enum = \RPG\Model\Enum::fromId($params['type']);
                if (!$enum->childOf('MAP_TYPE')) {
                    $errors[] = 'Ce type n\'est pas un type pour une tuile';
                }
            } catch (\RPG\Exception\RecordNotFoundException $e) {
                $errors[] =  'Ce type n\'existe pas.';
            }
        }
        if ((int)$params['position_x'] < 0) {
            $errors[] = 'La position X est invalide.';
        }
        if ((int)$params['position_y'] < 0) {
            $errors[] = 'La position X est invalide.';
        }
        return $errors;
    }
}