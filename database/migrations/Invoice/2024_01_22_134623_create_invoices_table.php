<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->default(uniqid())->nullable();

            // User id
            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('client_id');
            $table->string('invoice_no')->nullable();
            $table->json('user')->nullable();
            // $table->json('client')->nullable();
            $table->json('invoice_logo')->nullable();
            $table->datetime('date')->nullable();
            $table->datetime('due_date')->nullable();
            $table->string('vat_value')->nullable();
            $table->boolean('is_invoice_vat_applied')->nullable();
            $table->json('items')->nullable();
            $table->text('invoice_notes')->nullable();
            $table->json('invoice_bank_details')->nullable();
            $table->json('invoice_terms')->nullable();
            $table->json('selected_currency')->nullable();
            $table->string('invoice_type')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('total')->nullable();

            // foreign
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            // Others
            $table->integer('sort_order_no')->default(0)->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->json('extra_attributes')->nullable(); 
            $table->softDeletes();

            $table->timestamps();

            // c 2024_01_22_134623 // i 2024_01_22_133348
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
