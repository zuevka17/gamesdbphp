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
  public function add(RequestInterface $request)
  {
    $data = $request->all();

    $use_case = new BlockLevelAddUseCase($this->repository);

    $level = new BlockLevelsDTO((int)$data['id'], (int)$data['solvable_steps'], (string)$data['grid_tiles']);
    var_dump($level);

    return json_encode($use_case->execute($level));
  }
  public function remove(int $id)
  {
    $use_case = new BlockLevelRemoveUseCase($this->repository);

    $use_case->execute($id);

    return "removed";
  }
  public function edit(RequestInterface $request)
  {
    $data = $request->all();

    $use_case = new BlockLevelEditUseCase($this->repository);

    $level = new BlockLevelsDTO((int)$data['id'], (int)$data['solvable_steps'], (string)$data['grid_tiles']);
    return $use_case->execute($level);
  }
  public function getById(int $id)
  {
    $use_case = new BlockLevelGetByIdUseCase($this->repository);
    return json_encode($use_case->execute($id));
  }
  public function getAll()
  {
    $use_case = new BlockLevelGetAllUseCase($this->repository);
    return $use_case->execute();
  }
}
