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

use Application\DTO\BlockLevelsDTO;
use Application\UseCase\BlockLevelUseCase\BlockLevelAddUseCase;
use Application\UseCase\BlockLevelUseCase\BlockLevelEditUseCase;
use Application\UseCase\BlockLevelUseCase\BlockLevelGetAllUseCase;
use Application\UseCase\BlockLevelUseCase\BlockLevelGetByIdUseCase;
use Application\UseCase\BlockLevelUseCase\BlockLevelRemoveUseCase;
use Domain\BlockLevelsRepositoryInterface;
use Hyperf\Context\ApplicationContext;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Hyperf\Validation\ValidatorFactory;
use Psr\Container\ContainerInterface;

class BlockController extends AbstractController
{
  protected ContainerInterface $container;
  protected $repository;

  public function __construct()
  {
    $this->container = ApplicationContext::getContainer();
    $this->repository = $this->container->get(BlockLevelsRepositoryInterface::class);
  }
  public function add(RequestInterface $request, ValidatorFactory $validatorFactory, ResponseInterface $response)
  {
    $use_case = new BlockLevelAddUseCase($this->repository);
    $validator = $validatorFactory->make(
      $data = $request->all(),
        [
          'id' => 'required|integer',
          'solvable_steps'=> 'required|integer',
          'grid_tiles'=> 'required|integer',
        ],
        [
          'id.required' => 'id is required',
          'id.integer' => 'id is integer',
          'solvable_steps.required'=> 'solvable_steps is required',
          'solvable_steps.integer'=> 'solvable_steps is integer',
          'grid_tiles.required'=> 'grid_tiles is required',
          'grid_tiles.integer'=> 'grid_tiles is integer',
        ]
    );
    if ($validator->fails()) {
      $error_masage = $validator->errors()->all();
      return $response->json(['error' => $error_masage])->withStatus(400);
    }

    $level = new BlockLevelsDTO((int)$data['id'], (int)$data['solvable_steps'], (string)$data['grid_tiles']);
    return $response->json(['massage' => $use_case->execute($level)])->withStatus(200);
  }
  public function remove(int $id, ResponseInterface $response)
  {
    $use_case = new BlockLevelRemoveUseCase($this->repository);
    return $response->json(['deleted' => $use_case->execute($id)])->withStatus(200);
  }
  public function edit(RequestInterface $request, ValidatorFactoryInterface $validatorFactory, ResponseInterface $response)
  {
    $use_case = new BlockLevelEditUseCase($this->repository);
    $validator = $validatorFactory->make(
      $data = $request->all(),
        [
          'id' => 'required|integer',
          'solvable_steps'=> 'required|integer',
          'grid_tiles'=> 'required|integer',
        ],
        [
          'id.required' => 'id is required',
          'id.integer' => 'id is integer',
          'solvable_steps.required'=> 'solvable_steps is required',
          'solvable_steps.integer'=> 'solvable_steps is integer',
          'grid_tiles.required'=> 'grid_tiles is required',
          'grid_tiles.integer'=> 'grid_tiles is integer',
        ]
    );
    if ($validator->fails()) {
      $error_masage = $validator->errors()->all();
      return $response->json(['error' => $error_masage])->withStatus(400);
    }

    $level = new BlockLevelsDTO((int)$data['id'], (int)$data['solvable_steps'], (string)$data['grid_tiles']);
    return $response->json(['message'=> $use_case->execute($level)])->withStatus(200);
  }
  public function getById(int $id, ResponseInterface $response)
  {
    $use_case = new BlockLevelGetByIdUseCase($this->repository);
    return $response->json(['message' => $use_case->execute($id)])->withStatus(200);
  }
  public function getAll(ResponseInterface $response)
  {
    $use_case = new BlockLevelGetAllUseCase($this->repository);
    return $response->json(['message' => $use_case->execute()])->withStatus(200);
  }
}
