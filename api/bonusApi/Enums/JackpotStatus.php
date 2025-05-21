<?php

declare(strict_types=1);

namespace BonusApi\Enums;

enum JackpotStatus: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}