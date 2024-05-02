CREATE TABLE "games" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "game" varchar
);

CREATE TABLE "users" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "name" varchar
);

CREATE TABLE "user_games" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "game_id" integer,
  "user_id" int,
  "result" int
);

CREATE TABLE "blocks_levels" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "solvable_steps" integet,
  "grid_tiles" jsonb
);

CREATE TABLE "basketball_levels" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "pass_score" integer,
  "time_for_level" float,
  "level_type" jsonb
);

CREATE TABLE "history" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "user_id" int,
  "result" integer
);

ALTER TABLE "user_games" ADD FOREIGN KEY ("game_id") REFERENCES "games" ("id");

ALTER TABLE "user_games" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("id");

ALTER TABLE "history" ADD FOREIGN KEY ("user_id") REFERENCES "users" ("id");