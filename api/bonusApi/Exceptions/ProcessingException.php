<?php

declare(strict_types=1);

namespace BonusApi\Exceptions;

use RuntimeException;

/**
 * Excepción específica para errores de procesamiento
 */
final class ProcessingException extends RuntimeException
{
    public static function invalidAmount(): self
    {
        return new self('El monto del jackpot es inválido');
    }
}