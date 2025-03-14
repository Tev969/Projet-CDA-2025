<?php

namespace App\Entity\Enum;

enum StateEnum: string
{
    case PUBLISHED = 'published';
    case UNPUBLISHED = 'unpublished';
    case DRAFT = 'draft';
}