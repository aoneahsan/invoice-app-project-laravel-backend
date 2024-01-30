<?php

namespace App\Zaions\Enums;

enum OnboardingEnum: string
{
    case register = 'register';
    case profile = 'profile';
    case currency = 'currency';
    case bank_details = 'bank_details';
}