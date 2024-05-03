<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;
use Hyperf\DbConnection\Db;

class CreateDataBase extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Db::unprepared('
        ALTER TABLE history ADD COLUMN game_id INTEGER;
        ALTER TABLE "history" ADD FOREIGN KEY ("game_id") REFERENCES "games" ("id");
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Db::unprepared('
        DROP TABLE IF EXISTS "history";
        ');
    }
}
