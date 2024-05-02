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
use Hyperf\Context\ApplicationContext;
use Hyperf\HttpServer\Contract\RequestInterface;
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
    public function add(RequestInterface $request)
    {
        $data = $request->all();

        $level = new BasketballLevelsDTO((int)$data['id'], (int)$data['pass_score'],(int)$data['time_for_level'],(string)$data['level_type']);

        $use_case = new BasketBallAddUseCase($this->repository);
        $use_case->execute($level);
        return "added" . "\n" . json_encode($level);
    }       
    public function remove(int $id)
    {
        $use_case = new BasketballRemoveUseCase($this->repository);
        return $use_case->execute($id);
    }
    public function edit(RequestInterface $request)
    {
        $data = $request->all();

        $level = new BasketballLevelsDTO((int)$data['id'], (int)$data['pass_score'],(int)$data['time_for_level'],(string)$data['level_type']);

        $use_case = new BasketBallEditUseCase($this->repository);
        return $use_case->execute($level);
    }
    public function getById(int $id)
    {
        $use_case = new BasketBalllGetByIdUseCase($this->repository);
        return json_encode($use_case->execute($id));
    }
    public function getAll()
    {
        $use_case = new BasketBallGetAllUseCase($this->repository);
        return $use_case->execute();
    }
}