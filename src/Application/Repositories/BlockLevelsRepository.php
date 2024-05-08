<?php

namespace Application\Repositories;

use Application\DTO\BlockLevelsDTO;
use Domain\BlockLevelsRepositoryInterface;
use Hyperf\DbConnection\Db; 


class BlockLevelsRepository implements BlockLevelsRepositoryInterface
{
    protected Db $db;
    public function __construct(Db $db)
    {
        $this->db = $db;
    }
    public function add(BlockLevelsDTO $block_level): BlockLevelsDTO
    {
        $block_level_id = Db::table('blocks_levels')->insertGetId([
            'solvable_steps'=> $block_level->solvable_steps,
            'grid_tiles'=> $block_level->grid_tiles
        ]);

        $block_level = Db::table('blocks_levels')->find($block_level_id);

        return new BlockLevelsDTO(
            id: (int)$block_level->id,
            solvable_steps: (int)$block_level->solvable_steps,
            grid_tiles: $block_level->grid_tiles
        );
    }
    public function remove(int $id): void
    {
        $block_level = $this->db::table('blocks_levels')->where('id','=', $id)->delete();
    }
    public function edit(BlockLevelsDTO $block_level): int
    {
        $count_edit = $this->db::table('blocks_levels')->where('id', '=', $block_level->id)->update([
            'id'=> $block_level->id,
            'solvable_steps'=> $block_level->solvable_steps,
            'grid_tiles'=> $block_level->grid_tiles
        ]);
        return $count_edit;
    }
    public function getById(int $id): BlockLevelsDTO
    {    
        $block_level_data = $this->db::table('blocks_levels')->find($id);
        return new BlockLevelsDTO(
            id: (int)$block_level_data->id,
            solvable_steps: (int)$block_level_data->solvable_steps,
            grid_tiles: $block_level_data->grid_tiles
        );
    }
    public function getAll(): array
    {    
        $block_level_data = $this->db::table('blocks_levels')->get();
        $block_levels = [];

        foreach ($block_level_data as $level_data) {
            $block_level = new BlockLevelsDTO(
                id: (int)$level_data->id,
                solvable_steps: (int)$level_data->solvable_steps,
                grid_tiles: $level_data->grid_tiles
            );
            array_push($block_levels, $block_level);
        }   
        return $block_levels;
    }
}