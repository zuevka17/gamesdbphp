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
use Application\DTO\UserDTO;
use Application\UseCase\BlockLevelUseCase\BlockLevelAddUseCase;
use Application\UseCase\BlockLevelUseCase\BlockLevelEditUseCase;
use Application\UseCase\BlockLevelUseCase\BlockLevelGetAllUseCase;
use Application\UseCase\BlockLevelUseCase\BlockLevelGetByIdUseCase;
use Application\UseCase\BlockLevelUseCase\BlockLevelRemoveUseCase;
use Application\UseCase\UserUseCase\UserAddUseCase;
use Application\UseCase\UserUseCase\UserEditUseCase;
use Application\UseCase\UserUseCase\UserGetAllUseCase;
use Application\UseCase\UserUseCase\UserGetByAllUsecase;
use Application\UseCase\UserUseCase\UserGetByIdUsecase;
use Application\UseCase\UserUseCase\UserRemoveUseCase;
use Domain\BlockLevelsRepositoryInterface;
use Domain\UserRepositoryInterface;
use Hyperf\Context\ApplicationContext;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Validation\ValidatorFactory;
use Psr\Container\ContainerInterface;

class UserController extends AbstractController
{
  protected ContainerInterface $container;
  protected $repository;

  public function __construct()
  {
    $this->container = ApplicationContext::getContainer();
    $this->repository = $this->container->get(UserRepositoryInterface::class);
  }
  public function add(RequestInterface $request, ValidatorFactory $validatorFactory, ResponseInterface $response)
  {
    $use_case = new UserAddUseCase($this->repository);
    $validator = $validatorFactory->make(
      $data = $request->all(),
      [
        'name' => 'required|max:255',
      ],
      [
        'name.required'=> 'name is required',
      ]
    );
    if ($validator->fails()) {
      $error_message = $validator->errors()->all();
      return $response->json(['error' => $error_message])->withStatus(400);  
    }

    $user = new UserDTO(null, (string)$data['name']);
    return $response->json(['message' => $use_case->execute($user)])->withStatus(200); 
  }
  public function remove(int $id, ResponseInterface $response)
  {
    $use_case = new UserRemoveUseCase($this->repository);
    return $response->json(['deleted' => $use_case->execute($id)])->withStatus(200);
  }
  public function edit(RequestInterface $request, ValidatorFactory $validatorFactory, ResponseInterface $response)
  {
    $use_case = new UserEditUseCase($this->repository);
    $validator = $validatorFactory->make(
      $data = $request->all(),
      [
        'id' => 'required|integer',
        'name' => 'required|max:255',
      ],
      [
        'id.required'=> 'id is required',
        'id.integer'=> 'id is integer',
        'name.required'=> 'name is required',
      ]
    );
    if ($validator->fails()) {
      $error_message = $validator->errors()->all();
      return $response->json(['error' => $error_message])->withStatus(400);  
    }
    $user = new UserDTO((int)$data['id'], (string)$data['name']);
    return $response->json(['message' => $use_case->execute($user)])->withStatus(200);
  }
  public function getById(int $id, ResponseInterface $response)
  {
    $use_case = new UserGetByIdUseCase($this->repository);
    return $response->json(['message' => $use_case->execute($id)])->withStatus(200);
  }
  public function getAll(ResponseInterface $response)
  {
    $use_case = new UserGetAllUseCase($this->repository);
    return $response->json(['message' => $use_case->execute()])->withStatus(200);
  }
}
