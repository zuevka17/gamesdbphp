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

use Application\UseCase\Status\GetAllStatusesUseCase;
use Hyperf\DbConnection\Db;

class StatusController extends AbstractController
{
    /**
     * @GetMapping(path="/as/{id}")
     * @param $
     */
    public function index(GetAllStatusesUseCase $useCase)
    {
//        $product = $useCase->execute($id);

        $users = Db::table('instructions')->get();
        return $users;
//        return json_encode($product->getName());
        return json_encode($this->test());
        return json_encode($product);
    }

//    public function test()
//    {
//        $pgsql = new PostgreSQL();
//        $connected = $pgsql->connect('host=hyperf-postgresql-1 port=5432 dbname=postgres user=postgres password=postgres');
//        if (!$connected) {
//            return ('Failed to connect to PostgreSQL server.');
//        } else {
//            return 'ok';
//
//        }
//
//    }
}
