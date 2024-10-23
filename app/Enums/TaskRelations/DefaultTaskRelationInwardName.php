<?php

namespace App\Enums\TaskRelations;

enum DefaultTaskRelationInwardName: string
{
    case Blocks = 'is blocked by';
    case Clones = 'is cloned by';
    case Duplicates = 'is duplicated by';
    case Relates = 'relates to';
}
