<?php

namespace App\Enums\TaskStatuses;

enum TaskStatusType: string
{
    case Pending = 'Pending';
    case Open = 'Open';
    case Closed = 'Closed';
}
