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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->default(uniqid())->nullable();

            // User id
            $table->unsignedBigInteger('user_id');

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('company')->nullable();
            $table->string('country')->nullable();
            $table->text('notes')->nullable();
            $table->string('company_registration_number')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('default_currency')->nullable();
            $table->json('bank_details')->nullable();

            // foreign
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Others
            $table->integer('sort_order_no')->default(0)->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->json('extra_attributes')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
