<?php

declare(strict_types=1);

/**
 * Script para procesar y transformar datos de juegos en tiempo real
 *
 * Este script proporciona funciones utilitarias para el procesamiento
 * de datos de juegos y cálculos de bonificaciones
 */

$rawData = [
    ['game_id' => 'GAME001', 'amount' => 100.00],
    ['game_id' => 'GAME002', 'amount' => 200.00]
];

// La función anónima no necesita documentación
$calculateBonus = fn(float $amount): float => $amount * 1.5;

$processedData = array_map(function(array $game) use ($calculateBonus) {
    return [
        'id' => $game['game_id'],
        'original_amount' => $game['amount'],
        'bonus_amount' => $calculateBonus($game['amount']),
        'processed_at' => date('Y-m-d H:i:s')
    ];
}, $rawData);

$totalBonus = array_reduce(
    $processedData,
    fn(float $carry, array $item): float =>
        $carry + ($item['bonus_amount'] ?? 0.0),
    0.0
);

// Los datos procesados están disponibles en $processedData
// El total de bonificaciones está en $totalBonus