<?php

namespace App\Enums;

enum ActionStatus: string
{
    case Unfinished = 'Belum dikerjakan';
    case InProgress = 'Dalam proses';
    case Finished = 'Selesai';

    public static function all(): array
    {
        return [
            self::Unfinished->value,
            self::InProgress->value,
            self::Finished->value,
        ];
    }
}
