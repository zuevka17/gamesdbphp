<?php

namespace Domain;
use Domain\ValueObjects\Games;

interface GamesInterface
{
    public function add(/*dto*/) : Games;
    public function getById(int $id) : Games;
    public function getAll() : array;
}