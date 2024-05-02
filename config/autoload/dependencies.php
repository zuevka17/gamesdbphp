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

use Application\Repositories\BasketballLevelsRepository;
use Application\Repositories\BlockLevelsRepository;
use Application\Repositories\UserGamesRepository;
use Domain\BasketballLevelsRepositoryInterface;
use Domain\BlockLevelsRepositoryInterface;
use Domain\UserGamesRepositoryInterface;
use Psr\Container\ContainerInterface;
use Ports\Controller\IndexController;

return [
    ContainerInterface::class => IndexController::class,
    BlockLevelsRepositoryInterface::class => BlockLevelsRepository::class,
    BasketballLevelsRepositoryInterface::class => BasketballLevelsRepository::class,
    UserGamesRepositoryInterface::class => UserGamesRepository::class
];
