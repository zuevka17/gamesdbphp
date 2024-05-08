<?php

namespace Application\Repositories;

use Application\DTO\UserGamesDTO;
use Domain\Entities\UserGames;
use Domain\UserGamesRepositoryInterface;
use Hyperf\DbConnection\Db;

class UserGamesRepository implements UserGamesRepositoryInterface
{
    
    protected Db $db;
    public function __construct(Db $db)
    {
        $this->db = $db;
    }
    public function add(UserGamesDTO $user_games): UserGamesDTO
    {
        $user_games_id = $this->db::table('user_games')->insertGetId([
            'game_id' => $user_games->game_id,
            'user_id' => $user_games->user_id,
            'result' => $user_games->result
        ]);

        $user_games = DB::table('user_games')->find($user_games_id);

        return new UserGamesDTO(
            id: (int) $user_games->id,
            game_id: (int) $user_games->game_id,
            user_id: (int)$user_games->user_id,
            result: (int) $user_games->result
        );
    }
    public function remove(int $id): void
    {
        $user_games = $this->db::table('user_games')->where('id', '=', $id)->delete($id);
    }
    public function edit(UserGamesDTO $user_games): int
    {
        $count_edit = $this->db::table('user_games')->where('id', '=', $user_games->id)->update([
            'id' => $user_games->id,
            'game_id' => $user_games->game_id,
            'user_id' => $user_games->user_id,
            'result' => $user_games->result
        ]);
        return $count_edit;
    }
    public function getById(int $id): UserGamesDTO
    {
        $user_games_data = $this->db::table('user_games')->find($id);
        $block_level = new UserGamesDTO(
            id: (int) $user_games_data->id,
            game_id: (int) $user_games_data->game_id,
            user_id: (int)$user_games_data->user_id,
            result: (int) $user_games_data->result
        );

        return $block_level;
    }
    public function getAll(): array
    {
        $user_games_data = $this->db::table('user_games')->get();
        $user_games = [];

        foreach ($user_games_data as $level_data) {
            $user_level = new UserGamesDTO(
                id: (int) $level_data->id,
                game_id: (int) $level_data->game_id,
                user_id: (int)$level_data->user_id,
                result: (int) $level_data->result
            );
            array_push($user_games, $user_level);
        }
        return $user_games;
    }
}