<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;
use Ports\Controller\BasketballController;
use Ports\Controller\BlockController;
use Ports\Controller\UserGamesController;


Router::get('/favicon.ico', function () {
    return '';
});

Router::addGroup('/block', function () {
    Router::post('/add', [BlockController::class, 'add']);
    Router::delete('/remove/{id}', [BlockController::class, 'remove']);
    Router::post('/edit', [BlockController::class, 'edit']);
    Router::get('/{id}', [BlockController::class, 'getById']);
    Router::get('/', [BlockController::class, 'getAll']);
});
Router::addGroup('/basketball', function () {
    Router::post('/add', [BasketballController::class, 'add']);
    Router::delete('/remove/{id}', [BasketballController::class, 'remove']);
    Router::post('/edit', [BasketballController::class, 'edit']);           
    Router::get('/{id}', [BasketballController::class, 'getById']);
    Router::get('/', [BasketballController::class, 'getAll']);
});
Router::addGroup('/usergames', function () {
    Router::post('/add', [UserGamesController::class, 'add']);
    Router::delete('/remove/{id}', [UserGamesController::class, 'remove']);
    Router::post('/edit', [UserGamesController::class, 'edit']);           
    Router::get('/{id}', [UserGamesController::class, 'getById']);
    Router::get('/', [UserGamesController::class, 'getAll']);
});