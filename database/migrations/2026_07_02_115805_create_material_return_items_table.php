<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_return_items', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId('return_id')
                ->constrained('material_returns')
                ->onDelete('cascade');

            // Link back to the original dispatch item
            $table
                ->foreignId('dispatch_item_id')
                ->constrained('material_dispatch_items')
                ->onDelete('cascade');

            $table->decimal('return_quantity', 10, 2);

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_return_items');
    }
};
