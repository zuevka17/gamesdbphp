<?php

namespace Application\Repositories;

use Application\DTO\UserDTO;
use Domain\UserRepositoryInterface;
use Hyperf\DbConnection\Db;

class UserRepository implements UserRepositoryInterface
{
    
    protected Db $db;
    public function __construct(Db $db)
    {
        $this->db = $db;
    }
    public function add(UserDTO $user_games): UserDTO
    {
        $user_games_id = $this->db::table('users')->insertGetId([
            'id' => $user_games->id,
            'name' => $user_games->name,
        ]);

        $user_games = DB::table('users')->find($user_games_id);

        return new UserDTO(
            id: (int) $user_games->id,
            name: (int) $user_games->name
        );
    }
    public function remove(int $id): void
    {
        $user_games = $this->db::table('users')->where('id', '=', $id)->delete($id);
    }
    public function edit(UserDTO $user): int
    {
        $count_edit = $this->db::table('users')->where('id', '=', $user->id)->update([
            'id' => $user->id,
            'name' => $user->name,
        ]);
        return $count_edit;
    }
    public function getById(int $id): UserDTO
    {
        $user_games_data = $this->db::table('users')->find($id);
        $block_level = new UserDTO(
            id: (int) $user_games_data->id,
            name: (int) $user_games_data->name,
        );

        return $block_level;
    }
    public function getAll(): array
    {
        $users_data = $this->db::table('users')->get();
        $users = [];

        foreach ($users_data as $user) {
            $user_level = new UserDTO(
                id: (int) $user->id,
                name: (int) $user->name,
            );;
            array_push($users, $user_level);
        }
        return $users;
    }
}