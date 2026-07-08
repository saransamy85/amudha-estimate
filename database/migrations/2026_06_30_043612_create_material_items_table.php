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
        Schema::create('material_items', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId('customer_id')
                ->constrained('customers')
                ->onDelete('cascade');

            $table->string('item');

            $table->decimal('quantity', 10, 2);

            $table->string('unit')->default('Nos');

            $table->text('description')->nullable();

            $table->string('person_name')->nullable();

            $table->string('from_location');

            $table->string('to_location');

            $table->string('transport_type');

            $table->string('vehicle_no')->nullable();

            $table
                ->decimal('transport_charge', 10, 2)
                ->default(0);

            $table->date('dispatch_date');

            $table->string('user_name');
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
        Schema::dropIfExists('material_items');
    }
};
