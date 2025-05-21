<?php

declare(strict_types=1);

namespace BonusApi\Utils;

final class NumberFormatter
{
    public static function formatAmount(float $amount): string
    {
        return number_format($amount, 2, '.', ',');
    }

    public static function formatPercentage(float $value): string
    {
        return number_format($value * 100, 2) . '%';
    }
}