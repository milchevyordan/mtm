<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\Enum;

enum ProductRequestStatus: int
{
    use Enum;

    case Not_delivered_yet = 1;
    case Canceled = 2;
    case Accepted = 3;
}
