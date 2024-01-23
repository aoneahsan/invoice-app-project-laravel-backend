<?php

namespace App\Zaions\Enums;

enum RolesEnum: string
{
    case superAdmin = 'superAdmin';
    case admin = 'admin';
    case user = 'user';
    case buyer = 'buyer';
    case seller = 'seller';
    case buyerSeller = 'buyerSeller';
}
