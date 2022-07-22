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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50)->nullable();
            $table->string('first_name',50)->nullable();
            $table->string('last_name',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('designation',20)->nullable();
            $table->string('phone_number',20)->nullable();
            $table->string('alternate_phone_number',20)->nullable();
            $table->string('salary',20)->nullable();
            $table->string('city_id',5)->nullable();
            $table->integer('is_lead')->nullable();
            $table->integer('lead_id')->nullable();
            $table->string('city_id',5)->nullable();
            $table->string('nickname',50)->nullable();
            $table->timestamp('dob')->nullable();
            $table->bigInteger('assigned_to')->nullable();
            $table->bigInteger('profile_image_id')->nullable();
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->string('password');
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'DISABLED', 'PENDING'])->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
};
