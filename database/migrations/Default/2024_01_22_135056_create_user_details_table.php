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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('unique_Id')->default(uniqid())->nullable();

            // User id
            $table->unsignedBigInteger('user_id');

            // foreign
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('user_intro')->nullable();
            $table->text('user_description')->nullable();
            $table->string('user_average_response_time')->nullable();
            $table->json('user_languages')->nullable();
            $table->json('user_skills')->nullable();
            $table->json('user_education')->nullable();
            $table->string('cnic')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('cnic_front')->nullable();
            $table->string('cnic_back')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('github_link')->nullable();

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
        Schema::dropIfExists('user_details');
    }
};
