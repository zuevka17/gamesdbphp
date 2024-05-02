<?php

namespace Application\Repositories;

use Application\DTO\BasketballLevelsDTO;
use Domain\BasketballLevelsRepositoryInterface;
use Hyperf\DbConnection\Db;


class BasketballLevelsRepository implements BasketballLevelsRepositoryInterface
{
    protected Db $db;
    public function __construct(Db $db)
    {
        $this->db = $db;
    }
    public function add(BasketballLevelsDTO $basketball_level): BasketballLevelsDTO
    {
        $basketball_level_id = $this->db::table('basketball_levels')->insertGetId([
            'id' => $basketball_level->id,
            'pass_score'=> $basketball_level->pass_score,
            'time_for_level'=> $basketball_level->time_for_level,
            'level_type'=> $basketball_level->level_type
        ]);

        $basketball_level = $this->db::table('basketball_levels')->find($basketball_level_id);

        return new BasketballLevelsDTO(
            id: (int)$basketball_level->id,
            pass_score: (int)$basketball_level->pass_score,
            time_for_level: (float)$basketball_level->time_for_level,
            level_type: $basketball_level->level_type
        );
    }

    public function remove(int $id): void
    {
        $basketball_level =  $this->db::table('basketball_levels')->where('id', '=', $id)->delete($id);
    }
    public function edit(BasketballLevelsDTO $basketball_levels): int
    {
        $count_edit = $this->db::table('basketball_levels')->where('id', '=', $basketball_levels->id)->update([
            'id'=> $basketball_levels->id,
            'pass_score'=> $basketball_levels->pass_score,
            'time_for_level'=> $basketball_levels->time_for_level,
            'level_type'=> $basketball_levels->level_type
        ]);
        return $count_edit;
    }
    public function getById(int $id): BasketballLevelsDTO   
    {
        $basketball_level_data = $this->db::table('basketball_levels')->find($id);
        return new BasketballLevelsDTO(
            id: (int)$basketball_level_data->id,
            pass_score: (int)$basketball_level_data->pass_score,
            time_for_level: (float)$basketball_level_data->time_for_level,
            level_type: $basketball_level_data->level_type
        );

    }
    public function getAll(): array
    {
        $basketball_level_data = $this->db::table('basketball_levels')->get();

        $basketball_levels = [];

        foreach ($basketball_level_data as $level_data) {
            $basketball_level = new BasketballLevelsDTO(
                id: (int)$level_data->id,
                pass_score: (int)$level_data->pass_score,
                time_for_level: (float)$level_data->time_for_level,
                level_type: $level_data->level_type
            );
            array_push($basketball_levels, $basketball_level);
        }   
        return $basketball_levels;
    }
}