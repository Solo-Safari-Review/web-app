<?php

namespace App\Enums;

enum AnswerStatus: string
{
    case Unanswered = 'Belum dijawab';
    case Answered = 'Sudah dijawab';
}
