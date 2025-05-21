<?php

declare(strict_types=1);

namespace BonusApi\Types;

/**
 * Value Object para manejo de cantidades monetarias
 */
final readonly class Amount
{
    public function __construct(
        public float $value,
        public string $currency
    ) {}
}