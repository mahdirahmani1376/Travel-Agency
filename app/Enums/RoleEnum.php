<?php

namespace App\Enums;

enum RoleEnum: string
{
    use BaseEnum;

    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case EDITOR = 'editor';
}
