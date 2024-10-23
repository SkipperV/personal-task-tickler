<?php

namespace App\Enums\TaskRelations;

enum DefaultTaskRelationOutwardName: string
{
    case Blocks = 'blocks';
    case Clones = 'clones';
    case Duplicates = 'duplicates';
    case Relates = 'relates to';
}
