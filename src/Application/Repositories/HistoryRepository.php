<?php

namespace Application\Repositories;

use Application\DTO\HistoryDTO;
use Domain\HistoryRepositoryInterface;
use Hyperf\DbConnection\Db; 

class HistoryRepository implements HistoryRepositoryInterface
{
    protected Db $db;
    public function __construct(Db $db)
    {
        $this->db = $db;
    }
    public function add(HistoryDTO $history_entry): HistoryDTO
    {
        $history_id = Db::table('history')->insertGetId([
            'id' => $history_entry->id,
            'user_id'=> $history_entry->user_id,
            'game_id'=> $history_entry->game_id,
            'result'=> $history_entry->result
        ]);

        $history_entry = Db::table('blocks_levels')->find($history_id);

        return new HistoryDTO(
            id: (int)$history_entry->id,
            user_id: (int)$history_entry->user_id,
            game_id: $history_entry->game_id,
            result: $history_entry->result
        );
    }
    public function getByUserId(int $id): array
    {
        $history_data = $this->db->table('history')->where('user_id', $id)->get();

        $user_history_array = [];

        foreach ($history_data as $history_entry) {
            $user_entry = new HistoryDTO(
                id: (int)$history_entry->id,
                user_id: (int)$history_entry->user_id,
                game_id: (int)$history_entry->game_id,
                result: (int)$history_entry->result
            );
            array_push($user_history_array, $user_entry);
        }

        return $user_history_array;
    }
    
    public function getAll(): array
    {
        $history_data = $this->db->table('history')->get();

        $user_history_array = [];

        foreach ($history_data as $history_entry) {
            $user_entry = new HistoryDTO(
                id: (int)$history_entry->id,
                user_id: (int)$history_entry->user_id,
                game_id: (int)$history_entry->game_id,
                result: (int)$history_entry->result
            );
            array_push($user_history_array, $user_entry);
        }

        return $user_history_array;
    }
}