<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('source')->default('Wesbite');
            $table->string('Name');
            $table->string('Mobile');
            $table->string('email')->nullable();
            $table->string('Product');
            $table->string('Total_Area');
            $table->string('Description');
            $table->string('Site_location');
            $table->string('Status')->default('details shared');
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
        Schema::dropIfExists('leads');
    }
};
