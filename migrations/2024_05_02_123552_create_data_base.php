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
        CREATE SEQUENCE period_id_seq;

        CREATE TABLE "games" (
            "id" integer DEFAULT nextval(\'period_id_seq\') PRIMARY KEY,
            "game" varchar
          );
          
          CREATE TABLE "users" (
            "id" integer DEFAULT nextval(\'period_id_seq\') PRIMARY KEY,
            "name" varchar
          );
          
          CREATE TABLE "user_games" (
            "id" integer DEFAULT nextval(\'period_id_seq\') PRIMARY KEY,
            "game_id" integer,
            "user_id" int,
            "result" int
          );
          
          CREATE TABLE "blocks_levels" (
            "id" integer DEFAULT nextval(\'period_id_seq\') PRIMARY KEY,
            "solvable_steps" integer,
            "grid_tiles" jsonb
          );
          
          CREATE TABLE "basketball_levels" (
            "id" integer DEFAULT nextval(\'period_id_seq\') PRIMARY KEY,
            "pass_score" integer,
            "time_for_level" float,
            "level_type" jsonb
          );
          
          CREATE TABLE "history" (
            "id" integer DEFAULT nextval(\'period_id_seq\') PRIMARY KEY,
            "user_id" int,
            "game_id" int,
            "result" integer
          );
          
          ALTER TABLE "user_games" ADD FOREIGN KEY ("game_id") REFERENCES "games" ("id");
          
          ALTER TABLE "user_games" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("id");
          
          ALTER TABLE "history" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("id");
          
          ALTER TABLE "history" ADD FOREIGN KEY ("game_id") REFERENCES "games" ("id");
          
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Db::unprepared('
        DROP TABLE IF EXISTS "users" CASCADE;
        DROP TABLE IF EXISTS "games" CASCADE;
        DROP TABLE IF EXISTS "user_games";
        DROP TABLE IF EXISTS "basketball_levels";
        DROP TABLE IF EXISTS "blocks_levels";
        DROP TABLE IF EXISTS "user_games";
        ');
    }
}
