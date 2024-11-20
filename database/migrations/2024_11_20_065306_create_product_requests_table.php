<?php

declare(strict_types=1);

use App\Enums\ProductRequestStatus;
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
        Schema::create('product_requests', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId('creator_id')
                ->constrained('users');

            $table->enum('status', ProductRequestStatus::values());
            $table->enum('warehouse', Warehouse::values());

            $table->timestamp('accepted_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_requests');
    }
};
