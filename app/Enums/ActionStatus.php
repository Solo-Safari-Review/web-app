<?php

namespace App\Enums;

enum ActionStatus: string
{
    case Unfinished = 'Belum dikerjakan';
    case InProgress = 'Dalam proses';
    case Finished = 'Selesai';
}
