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
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('invoice_no')->nullable();
            $table->longText('user')->nullable();
            $table->longText('client')->nullable();
            $table->string('invoice_logo')->nullable();
            $table->string('date')->nullable();
            $table->string('due_date')->nullable();
            $table->string('vat_value')->nullable();
            $table->boolean('is_invoice_vat_applied')->nullable();
            $table->longText('items')->nullable();
            $table->longText('invoice_notes')->nullable();
            $table->longText('invoice_terms')->nullable();
            $table->string('selected_currency')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('total')->nullable();

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
