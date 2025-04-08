<?php

namespace App\Enums;

enum ReviewStatus: string
{
    case Unsended = 'Belum diteruskan';
    case Sended = 'Sudah diteruskan';
}
