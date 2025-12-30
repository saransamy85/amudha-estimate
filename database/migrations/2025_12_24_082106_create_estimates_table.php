<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();

            // Estimate info
            $table->string('estimate_no')->unique();
            $table->date('estimate_date')->nullable();

            // Customer info
            $table->string('customer_name');
            $table->text('customer_address')->nullable();
            $table->string('mobile', 15)->nullable();
            $table->text('description')->nullable();

            // Amount fields
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->integer('gst_percent')->default(18);
            $table->decimal('gst_amount', 12, 2)->default(0);
            $table->decimal('net_total', 12, 2)->default(0);

            $table->text('estimatedby');

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
        Schema::dropIfExists('estimates');
    }
}
