<?php

declare(strict_types=1);

namespace BonusApi\Interfaces;

use BonusApi\Types\Amount;
use BonusApi\DTOs\GameData;

/**
 * Interfaz base para procesadores
 */
interface ProcessorInterface
{
    /**
     * Procesa un jackpot
     *
     * @throws \RuntimeException Si hay un error en el procesamiento
     */
    public function processJackpot(Amount $amount, GameData $gameData): array;
}