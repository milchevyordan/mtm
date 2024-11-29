<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Warehouse;
use App\Models\Product;
use App\Models\ProductQuantity;
use App\Models\Project;
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

        //        $productNames = [
        //            'MAXI 1500 anti skid flooring',
        //            'MAXI 5000 anti slip flooring',
        //            'SL 3000',
        //            'TOPP 4000',
        //            'STONE CARPET',
        //            'Flowcoat SF 41 - epoxy flooring',
        //            'ANTI STATIC FLOORING',
        //            'Peran SL self leveling flooring',
        //            'FAST-CLAD 7220',
        //            'Macropoxy L425',
        //            'Macropoxy K267',
        //            'Diamond cutting blades for granite stone',
        //            'POLISHING PADS',
        //            'Drilling core bits - Wet',
        //            'Resuthane™ SL',
        //            'Corrosion and chemical protective coatings and paints',
        //            'Fire protective coatings and paints',
        //            'Vespupark',
        //            'PU- coating for outdoor areas',
        //            'LITHURIN Hard',
        //            'STEEL FIBERS',
        //            'POLISHED CONCRETE FLOORINGS',
        //            'Diamond grinding wheels',
        //            'Marine engine spares',
        //        ];
        //
        //        $productInserts = [];
        //        $productQuantityInserts = [];
        //        foreach ($productNames as $key => $productName) {
        //            $productInserts[] = [
        //                'creator_id'       => 1,
        //                'internal_id'      => $faker->numerify('#####'),
        //                'name'             => $productName,
        //                'minimum_quantity' => 10,
        //                'created_at'       => now(),
        //            ];
        //
        //            $productQuantityInserts[] = [
        //                'product_id' => $key + 1,
        //                'warehouse'  => Warehouse::Varna->value,
        //                'quantity'   => 10000,
        //            ];
        //
        //            $productQuantityInserts[] = [
        //                'product_id' => $key + 1,
        //                'warehouse'  => Warehouse::France->value,
        //                'quantity'   => 10000,
        //            ];
        //
        //            $productQuantityInserts[] = [
        //                'product_id' => $key + 1,
        //                'warehouse'  => Warehouse::Netherlands->value,
        //                'quantity'   => 10000,
        //            ];
        //        }
        //
        //        Product::insert($productInserts);
        //        ProductQuantity::insert($productQuantityInserts);
        //
        //        $projectInserts = [];
        //        for ($i = 0; $i < 3; $i++) {
        //            $projectInserts[] = [
        //                'creator_id' => 1,
        //                'warehouse'  => $faker->randomElement(Warehouse::values()),
        //                'name'       => $faker->city(),
        //                'created_at' => now(),
        //            ];
        //        }
        //
        //        Project::insert($projectInserts);
    }
}
