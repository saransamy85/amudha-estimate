<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimateitems', function (Blueprint $table) {
            $table->id();

            // Foreign key to estimates table
            $table->unsignedBigInteger('estimate_id');

            // Item details
            $table->string('location')->nullable();
            $table->decimal('area', 10, 2)->default(0);
            $table->decimal('rate', 12, 2)->default(0);
            $table->decimal('value', 12, 2)->default(0);

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('estimate_id')
                  ->references('id')
                  ->on('estimates')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimateitems');
    }
}
