<?php

namespace App\Enums;

enum AnswerStatus: string
{
    case Unanswered = 'Belum dijawab';
    case Answered = 'Sudah dijawab';

    public static function all(): array
    {
        return [
            self::Unanswered->value,
            self::Answered->value,
        ];
    }
}
