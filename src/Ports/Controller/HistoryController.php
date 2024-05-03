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

use Application\DTO\HistoryDTO;
use Application\UseCase\HistoryUseCase\HistoryAddUseCase;
use Application\UseCase\HistoryUseCase\HistoryGetAllUseCase;
use Application\UseCase\HistoryUseCase\HistoryGetByUserIdUseCase;
use Domain\HistoryRepositoryInterface;
use Hyperf\Context\ApplicationContext;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Psr\Container\ContainerInterface;

class HistoryController extends AbstractController
{
    protected ContainerInterface $container;
    protected $repository;
  
    public function __construct()
    {
      $this->container = ApplicationContext::getContainer();
      $this->repository = $this->container->get(HistoryRepositoryInterface::class);
    }
    public function add(RequestInterface $request, ValidatorFactoryInterface $validatorFactory, ResponseInterface $response)
    {
        $use_case = new HistoryAddUseCase($this->repository);
        $validator = $validatorFactory->make(
            $data = $request->all(),
            [
                'id' => 'required|integer',
                'user_id'=> 'required|integer',
                'game_id'=> 'required|integer',
                'result'=> 'required|integer',
            ],
            [
                'id.required'=> 'id is required',
                'id.integer'=> 'id is integer',
                'user_id.required'=> 'user_id is required',
                'user_id.integer'=> 'user_id is required',
                'game_id.required'=> 'game_id is required',
                'game_id.integer'=> 'game_id is required',
                'result.required'=> 'result is required',
                'result.integer'=> 'result is required',
            ]
        );
        if ($validator->fails()) {
            $error_message = $validator->errors()->all();
            return $response->json(['error' => $error_message])->withStatus(400);
        }

        $history_entry = new HistoryDTO((int)$data['id'], (int)$data['user_id'], (int)$data['game_id'], (int)$data['result']);
        return $response->json(['message' => $use_case->execute($history_entry)])->withStatus(200);
    }
    public function getByUserId(int $user_id, ResponseInterface $response)
    {
        $use_case = new HistoryGetByUserIdUseCase($this->repository);
        return $response->json(['message' => $use_case->execute($user_id)])->withStatus(200);
    }
    public function getAll(ResponseInterface $response)
    {
        $use_case = new HistoryGetAllUseCase($this->repository);
        return $response->json(['message' => $use_case->execute()])->withStatus(200);
    }
}