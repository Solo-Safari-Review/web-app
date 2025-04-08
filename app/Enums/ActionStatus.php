<?php

namespace App\Enums;

enum ActionStatus: string
{
    case Unfinished = 'Belum diteruskan';
    case InProgress = 'Dalam proses';
    case Finished = 'Selesai';
}
