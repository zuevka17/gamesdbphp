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
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Validation\ValidatorFactory;
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
    public function add(RequestInterface $request, ValidatorFactory $validatorFactory, ResponseInterface $response)
    {
        $use_case = new UserGamesAddUseCase($this->repository);
        $validator = $validatorFactory->make(
            $data = $request->all(),
            [
                'id' => 'required|integer',
                'game_id' => 'required|integer',
                'user_id' => 'required|integer',
                'result' => 'required|integer',          
            ],
            [
                'id.required'=> 'id is required',
                'id.integer'=> 'id is integer',
                'game_id.required'=> 'game_id is required',
                'game_id.integer'=> 'game_id is integer',
                'user_id.required'=> 'user_id is required',
                'user_id.integer'=> 'user_id is integer',
                'result.required'=> 'result is required',
                'result.integer'=> 'result is integer',
            ]
        );
        if ($validator->fails()) {
            $error_message = $validator->errors()->all();
            return $response->json(['error' => $error_message])->withStatus(400);  
        }

        $level = new UserGamesDTO((int)$data['id'], (int)$data['game_id'],(int)$data['user_id'],(int)$data['result']);
        return $response->json(['message' => $use_case->execute($level)])->withStatus(200);
    }
    public function remove(int $id, ResponseInterface $response)
    {
        $use_case = new UserGamesRemoveUseCase($this->repository);
        return $response->json(['message' => $use_case->execute($id)])->withStatus(200);
    }
    public function edit(RequestInterface $request, ValidatorFactory $validatorFactory, ResponseInterface $response)
    {
        $use_case = new UserGamesEditUseCase($this->repository);
        $validator = $validatorFactory->make(
            $data = $request->all(),
            [
                'id' => 'required|integer',
                'game_id' => 'required|integer',
                'user_id' => 'required|integer',
                'result' => 'required|integer',          
            ],
            [
                'id.required'=> 'id is required',
                'id.integer'=> 'id is integer',
                'game_id.required'=> 'game_id is required',
                'game_id.integer'=> 'game_id is integer',
                'user_id.required'=> 'user_id is required',
                'user_id.integer'=> 'user_id is integer',
                'result.required'=> 'result is required',
                'result.integer'=> 'result is integer',
            ]
        );
        if ($validator->fails()) {
            $error_message = $validator->errors()->all();
            return $response->json(['error' => $error_message])->withStatus(400);  
        }

        $level = new UserGamesDTO((int)$data['id'], (int)$data['game_id'],(int)$data['user_id'],(int)$data['result']);
        return $response->json(['message'=> $use_case->execute($level)])->withStatus(200);
    }
    public function getById(int $id, ResponseInterface $response)
    {
        $use_case = new UserGamesGetByIdUseCase($this->repository);
        return $response->json(['message' => $use_case->execute($id)])->withStatus(200);
    }
    public function getAll(ResponseInterface $response)
    {
        $use_case = new UserGamesGetAllUseCase($this->repository);
        return $response->json(['message' => $use_case->execute()])->withStatus(200);
    }
}