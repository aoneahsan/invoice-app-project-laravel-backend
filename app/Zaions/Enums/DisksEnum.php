<?php

namespace App\Zaions\Enums;

enum DisksEnum: string
{
    case local = 'local';
    case public = 'public';

        // AWS S3
    case s3 = 's3';
    case invoices = 'invoices';
}
