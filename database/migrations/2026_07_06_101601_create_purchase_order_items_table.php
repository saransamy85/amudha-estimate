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
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId('purchase_order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('material');

            $table->string('size')->nullable();

            $table->string('dia')->nullable();

            $table->string('length')->nullable();

            $table->string('thickness')->nullable();

            $table->decimal('nos', 10, 2)->nullable();

            $table->decimal('qty', 10, 2)->nullable();

            $table->string('unit')->nullable();

            $table->decimal('approx_weight', 10, 2)->nullable();

            $table->decimal('rate', 10, 2)->default(0);

            $table->decimal('amount', 12, 2)->default(0);

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
        Schema::dropIfExists('purchase_order_items');
    }
};
