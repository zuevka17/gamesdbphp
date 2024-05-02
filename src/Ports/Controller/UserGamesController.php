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

namespace Ports\Controller;

use Application\DTO\UserGamesDTO;
use Application\UseCase\UserGamesUseCase\UserGamesAddUseCase;
use Application\UseCase\UserGamesUseCase\UserGamesEditUseCase;
use Application\UseCase\UserGamesUseCase\UserGamesGetAllUseCase;
use Application\UseCase\UserGamesUseCase\UserGamesGetByIdUseCase;
use Application\UseCase\UserGamesUseCase\UserGamesRemoveUseCase;
use Domain\UserGamesRepositoryInterface;
use Hyperf\Context\ApplicationContext;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Container\ContainerInterface;

class UserGamesController extends AbstractController
{
    protected ContainerInterface $container;
    protected $repository;
    public function __construct()
    {
        $this->container = ApplicationContext::getContainer();
        $this->repository = $this->container->get(UserGamesRepositoryInterface::class);
    }
    public function add(RequestInterface $request)
    {
        $data = $request->all();

        $level = new UserGamesDTO((int)$data['id'], (int)$data['game_id'],(int)$data['user_id'],(int)$data['result']);

        $use_case = new UserGamesAddUseCase($this->repository);
        $use_case->execute($level);
        return "added" . "\n" . json_encode($level);
    }
    public function remove(int $id)
    {
        $use_case = new UserGamesRemoveUseCase($this->repository);
        return $use_case->execute($id);
    }
    public function edit(RequestInterface $request)
    {
        $data = $request->all();

        $level = new UserGamesDTO((int)$data['id'], (int)$data['game_id'],(int)$data['user_id'],(int)$data['result']);

        $use_case = new UserGamesEditUseCase($this->repository);
        return $use_case->execute($level);
    }
    public function getById(int $id)
    {
        $use_case = new UserGamesGetByIdUseCase($this->repository);
        return json_encode($use_case->execute($id));
    }
    public function getAll()
    {
        $use_case = new UserGamesGetAllUseCase($this->repository);
        return $use_case->execute();
    }
}