<?php

declare(strict_types=1);

namespace BonusApi\Cases;

use DateTimeImmutable;
use BonusApi\Types\Amount;
use BonusApi\DTOs\GameData;
use BonusApi\Enums\JackpotStatus;
use BonusApi\Interfaces\ProcessorInterface;
use BonusApi\Exceptions\ProcessingException;
use BonusApi\Utils\NumberFormatter;

/**
 * Procesador de jackpots con validación avanzada
 */
final class JackpotProcessor implements ProcessorInterface
{
    private array $processingQueue = [];
    private ?DateTimeImmutable $lastProcessedDate = null;

    /**
     * Constructor del procesador
     */
    public function __construct(
        private readonly Amount $minAmount,
        private readonly Amount $maxAmount
    ) {}

    /**
     * Procesa un nuevo jackpot
     *
     *
     */
    public function processJackpot(Amount $amount, GameData $gameData): array
    {
        if ($amount->value <= 0) {
            throw ProcessingException::invalidAmount();
        }

        try {
            $processedData = $this->calculateBonus($amount, $gameData);
            $this->addToQueue($amount);
            $this->lastProcessedDate = new DateTimeImmutable();

            return [
                'success' => true,
                'status' => JackpotStatus::COMPLETED,
                'amount' => NumberFormatter::formatAmount($processedData['finalAmount']),
                'timestamp' => $this->lastProcessedDate->format('Y-m-d H:i:s')
            ];
        } catch (\Throwable $e) {
            throw new ProcessingException(
                "Error procesando jackpot: {$e->getMessage()}"
            );
        }
    }

    private function addToQueue(Amount $amount): void
    {
        $this->processingQueue[] = [
            'amount' => $amount,
            'date' => new DateTimeImmutable()
        ];
    }

    /**
     * Calcula el bonus final
     */
    private function calculateBonus(Amount $amount, GameData $gameData): array
    {
        return [
            'finalAmount' => $amount->value * $gameData->multiplier,
            'multiplier' => $gameData->multiplier
        ];
    }
}