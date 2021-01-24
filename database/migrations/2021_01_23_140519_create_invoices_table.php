<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('invoice_no');
            $table->longText('invoice_user')->nullable();
            $table->longText('invoice_client')->nullable();
            $table->string('invoice_logo')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('invoice_due_date')->nullable();
            $table->string('invoice_vat_value')->nullable();
            $table->boolean('is_invoice_vat_applied')->nullable();
            $table->longText('invoice_items')->nullable();
            $table->longText('invoice_notes')->nullable();
            $table->longText('invoice_terms')->nullable();
            $table->bigInteger('subtotal')->nullable();
            $table->bigInteger('total')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
}
