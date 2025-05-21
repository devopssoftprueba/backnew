<?php

declare(strict_types=1);

namespace BonusApi\DTOs;

/**
 * DTO para datos del juego
 */
final readonly class GameData
{
    public function __construct(
        public string $gameId,
        public float $multiplier = 1.0,
        public array $metadata = []
    ) {}
}