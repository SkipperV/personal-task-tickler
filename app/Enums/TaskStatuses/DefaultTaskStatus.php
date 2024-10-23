<?php

namespace App\Enums\TaskStatuses;

enum DefaultTaskStatus: string
{
    case ToDo = 'To do';
    case InProgress = 'In progress';
    case Done = 'Done';
}
