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

use Application\DTO\BasketballLevelsDTO;
use Application\UseCase\BasketballLevelUseCase\BasketBallAddUseCase;
use Application\UseCase\BasketballLevelUseCase\BasketBallEditUseCase;
use Application\UseCase\BasketballLevelUseCase\BasketBallGetAllUseCase;
use Application\UseCase\BasketballLevelUseCase\BasketBalllGetByIdUseCase;
use Application\UseCase\BasketballLevelUseCase\BasketballRemoveUseCase;
use Domain\BasketballLevelsRepositoryInterface;
use GuzzleHttp\Psr7\Response;
use Hyperf\Context\ApplicationContext;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Psr\Container\ContainerInterface;

class BasketballController extends AbstractController
{
    protected ContainerInterface $container;
    protected $repository;
    public function __construct()
    {
        $this->container = ApplicationContext::getContainer();
        $this->repository = $this->container->get(BasketballLevelsRepositoryInterface::class);
    }
    public function add(RequestInterface $request, ValidatorFactoryInterface $validatorFactory, ResponseInterface $response)
    {
        $use_case = new BasketBallAddUseCase($this->repository);

        $validator = $validatorFactory->make(
            $data = $request->all(),
            [
                'id' => 'required|integer',
                'pass_score'=> 'required|integer',
                'time_for_level'=> 'required|integer',
                'level_type'=> 'required|max:255',
            ],
            [
                'id.required' => 'id is required',
                'id.integer'=> 'id is integer',
                'pass_score.required' => 'pass_score is required',
                'pass_score.integer'=> 'pass_score is integer',
                'time_for_level.required' => 'time_for_level is required',
                'time_for_level.integer'=> 'time_for_level is integer',
                'level_type.required' => 'level_type is required',
            ]
        );
        if($validator->fails()) {
            $error_massage = $validator->errors()->all();
            return $response->json(['error' => $error_massage])->withStatus(400);
        }

        $level = new BasketballLevelsDTO((int)$data['id'], (int)$data['pass_score'],(int)$data['time_for_level'],(string)$data['level_type']);
        return $response->json(['message'=> $use_case->execute($level)])->withStatus(200);
    }       
    public function remove(int $id, ResponseInterface $response)
    {
        $use_case = new BasketballRemoveUseCase($this->repository);
        return $response->json(['deleted' => $use_case->execute($id)])->withStatus(200);
    }
    public function edit(RequestInterface $request, ValidatorFactoryInterface $validatorFactory, ResponseInterface $response)
    {
        $use_case = new BasketBallEditUseCase($this->repository);

        $validator = $validatorFactory->make(
        $data = $request->all(),
        [
            'id' => 'required|integer',
            'pass_score'=> 'required|integer',
            'time_for_level'=> 'required|integer',
            'level_type'=> 'required|max:255',
        ],
        [
            'id.required' => 'id is required',
            'id.integer'=> 'id is integer',
            'pass_score.required' => 'pass_score is required',
            'pass_score.integer'=> 'pass_score is integer',
            'time_for_level.required' => 'time_for_level is required',
            'time_for_level.integer'=> 'time_for_level is integer',
            'level_type.required' => 'level_type is required',
        ]
        );
        if($validator->fails()){
            $error_massage = $validator->errors()->all();

            return $response->json(['error' => $error_massage])->withStatus(400);
        };

        $level = new BasketballLevelsDTO((int)$data['id'], (int)$data['pass_score'],(int)$data['time_for_level'],(string)$data['level_type']);
        return $response->json(['message' => $use_case->execute($level)])->withStatus(200);
    }
    public function getById(int $id, ResponseInterface $response)
    {
        $use_case = new BasketBalllGetByIdUseCase($this->repository);
        return $response->json(['message' => $use_case->execute($id)])->withStatus(200);
    }
    public function getAll(ResponseInterface $response)
    {
        $use_case = new BasketBallGetAllUseCase($this->repository);
        return $response->json(['message' => $use_case->execute()])->withStatus(200);
    }
}