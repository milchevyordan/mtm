<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\Enum;

enum ProductType: int
{
    use Enum;

    case PPE = 1;
    case Blasting_equipment_and_spare_part = 2;
    case Spray_pumps_equipment_and_spare_part = 3;
    case Materials_and_consumable = 4;
    case Vacuum_machine = 5;
    case Other = 6;
}
