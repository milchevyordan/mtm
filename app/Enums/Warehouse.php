<?php

declare(strict_types=1);

/*
 *     This file is part of Auto Trader.
 *
 *     (c) James IT Services | Louis Hage <louis@jamesitservices.com>
 *
 *     Copyright 2000-2024, James IT Services Ltd
 *     All rights reserved.
 */

namespace App\Enums;

use App\Traits\Enum;

enum Warehouse: int
{
    use Enum;

    case France = 1;
    case Netherlands = 2;
}