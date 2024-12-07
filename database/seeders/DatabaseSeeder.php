<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Warehouse;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create();

        User::factory()->create([
            'name'      => 'Valentin Makarov',
            'email'     => 'valentin.makarov64@gmail.com',
            'password'  => Hash::make('valentin.makarov64@gmail.com'),
            'warehouse' => Warehouse::Varna->value,
        ]);

        User::factory()->create([
            'name'      => 'Yordan Milchev',
            'email'     => 'biker4etu@abv.bg',
            'password'  => Hash::make('biker4etu@abv.bg'),
            'warehouse' => Warehouse::Varna->value,
        ]);
    }
}
