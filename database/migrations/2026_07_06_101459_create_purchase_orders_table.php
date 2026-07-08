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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();

            $table->string('po_no')->unique();

            $table->enum('company', [
                'Amudha Decors',
                'Arasuvel Roofings'
            ]);

            $table
                ->foreignId('vendor_id')
                ->constrained('vendors')
                ->cascadeOnDelete();

            $table
                ->foreignId('site_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            $table->enum('po_template', [
                'Anchor',
                'Steel Plate',
                'Fabrication',
                'Panel'
            ]);

            $table->date('po_date');

            $table->decimal('subtotal', 12, 2)->default(0);

            $table->decimal('gst_percent', 5, 2)->default(18);

            $table->decimal('gst_amount', 12, 2)->default(0);

            $table->decimal('grand_total', 12, 2)->default(0);

            $table->text('remarks')->nullable();

            $table->string('created_by');

            $table->enum('status', [
                'Pending',
                'Approved',
                'Cancelled'
            ])->default('Pending');

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
        Schema::dropIfExists('purchase_orders');
    }
};
