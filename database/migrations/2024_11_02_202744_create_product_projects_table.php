<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_projects', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId('creator_id')
                ->constrained('users');

            $table->foreignId('project_id')->constrained();
            $table->foreignId('product_id')->constrained();

            $table->integer('quantity');

            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_projects');
    }
};