<?php

namespace App\Enums;

enum TimesheetPeriodStatusEnum: string
{
    case Open = 'open';
    case Closed = 'closed';

    public static function open(): string
    {
        return self::Open->value;
    }

    public static function closed(): string
    {
        return self::Closed->value;
    }

    public static function statuses(): array
    {
        return collect(self::cases())->pluck('name', 'value')->toArray();
    }
}
