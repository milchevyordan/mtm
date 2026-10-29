<?php

use App\Enums\Warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedTinyInteger('warehouse')->change();
        });

        Schema::table('product_quantities', function (Blueprint $table) {
            $table->unsignedTinyInteger('warehouse')->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedTinyInteger('warehouse')->change();
        });

        Schema::table('product_requests', function (Blueprint $table) {
            $table->unsignedTinyInteger('warehouse')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('warehouse', Warehouse::values())->default(Warehouse::Varna->value);
        });

        Schema::table('product_quantities', function (Blueprint $table) {
            $table->enum('warehouse', Warehouse::values())->default(Warehouse::Varna->value);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->enum('warehouse', Warehouse::values())->default(Warehouse::Varna->value);
        });

        Schema::table('product_requests', function (Blueprint $table) {
            $table->enum('warehouse', Warehouse::values())->default(Warehouse::Varna->value);
        });
    }
};
