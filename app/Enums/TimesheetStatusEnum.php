<?php

namespace App\Enums;

enum TimesheetStatusEnum: string
{
    case Open = 'open';
    case Pending_Approval = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Posted = 'posted';

    public static function open(): string
    {
        return self::Open->value;
    }

    public static function pending(): string
    {
        return self::Pending_Approval->value;
    }

    public static function approved(): string
    {
        return self::Approved->value;
    }

    public static function rejected(): string
    {
        return self::Rejected->value;
    }

    public static function posted(): string
    {
        return self::Posted->value;
    }

    public static function statuses(): array
    {
        return collect(self::cases())->keyBy('value')->map(fn ($item) => str_replace(search: '_', replace: ' ', subject: $item->name))->toArray();
    }
}
