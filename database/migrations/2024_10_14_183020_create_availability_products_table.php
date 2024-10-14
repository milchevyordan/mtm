<?php

declare(strict_types=1);

use App\Enums\Warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('availability_products', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained();
            $table->enum('warehouse', Warehouse::values());
            $table->integer('quantity')->default(0);
            $table->timestamps();

            $table->primary(['product_id', 'warehouse']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availability_products');
    }
};
