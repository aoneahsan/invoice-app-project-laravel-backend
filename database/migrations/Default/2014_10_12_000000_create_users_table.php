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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->default(uniqid())->nullable();

            $table->string('username')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('country_code')->nullable();
            $table->string('country_code_text')->nullable();
            $table->string('location')->nullable();
            //$table->text('role')->nullable(); // buyer | seller | buyer_seller | admin (just for frontend to show elements)
            $table->string('profile_publicly_visible')->default('visible')->nullable();
            $table->text('profile_photo_path')->nullable();

            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('company')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('vat_number')->nullable();
            $table->json('default_currency')->nullable();
            $table->json('logo')->nullable();
            $table->string('notes')->nullable();
            // $table->json('bank_details')->nullable();
            $table->string('bank_details')->nullable();
            $table->json('onboarding_details')->nullable();

            $table->string('otp_code')->nullable();
            $table->string('otp_code_valid_till')->nullable();
            $table->boolean('can_reset_password')->default(false)->nullable();

            // $table->foreignId('current_team_id')->nullable();

            // Others
            $table->boolean('is_active')->default(true)->nullable();
            $table->json('extra_attributes')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
