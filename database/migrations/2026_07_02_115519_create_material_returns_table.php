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
        Schema::create('material_returns', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId('customer_id')
                ->constrained('customers')
                ->onDelete('cascade');

            $table->string('return_no')->unique();

            $table->string('person_name')->nullable();

            $table->string('vehicle_no')->nullable();

            $table->string('transport_type');

            $table->decimal('transport_charge', 10, 2)->default(0);

            $table->date('return_date');

            $table->string('remarks')->nullable();

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
        Schema::dropIfExists('material_returns');
    }
};
