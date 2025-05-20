<?php

namespace App\Enums;

enum ReviewStatus: string
{
    case Unsended = 'Belum diteruskan';
    case Sended = 'Sudah diteruskan';

    public static function all(): array
    {
        return [
            self::Unsended->value,
            self::Sended->value,
        ];
    }
}
