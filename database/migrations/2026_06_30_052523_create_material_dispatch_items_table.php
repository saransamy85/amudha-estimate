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
        Schema::create('material_dispatch_items', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId('dispatch_id')
                ->constrained('material_dispatches')
                ->onDelete('cascade');

            $table->string('item');

            $table->decimal('quantity', 10, 2);

            $table->string('unit');

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
        Schema::dropIfExists('material_dispatch_items');
    }
};
