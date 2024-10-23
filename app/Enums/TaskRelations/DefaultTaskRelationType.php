<?php

namespace App\Enums\TaskRelations;

enum DefaultTaskRelationType: string
{
    case Blocks = 'Blocks';
    case Clones = 'Clones';
    case Duplicates = 'Duplicates';
    case Relates = 'Relates';
}
