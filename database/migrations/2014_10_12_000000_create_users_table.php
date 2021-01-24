<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_uniqid')->default(uniqid());
            $table->string('username')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('country_code')->nullable();
            $table->string('country_code_text')->nullable();
            $table->string('location')->nullable();
            $table->text('role')->nullable(); // buyer | seller | buyer_seller | admin (just for frontend to show elements)
            $table->string('profile_publicly_visible')->default('visible')->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->text('profile_photo_path')->nullable();

            $table->string('address')->nullable();
            $table->longText('country')->nullable();
            $table->string('state')->nullable();
            $table->string('company')->nullable();
            $table->string('logo')->nullable();
            $table->longText('notes')->nullable();

            $table->longText('extra_attributes')->nullable();

            $table->foreignId('current_team_id')->nullable();

            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
