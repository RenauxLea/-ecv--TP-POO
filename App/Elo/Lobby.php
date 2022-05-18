<?php

declare(strict_types=1);

namespace App\Elo;

class Lobby
{
    private array $waitingPlayers = [];

    public function addPlayer(Player $player): void
    {
        $this->waitingPlayers[] = WaitingPlayerFactory::createFromPlayer($player);
    }
}
