<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('designation')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('alternate_phone_number')->nullable();
            $table->string('salary')->nullable();
            $table->string('city_id')->nullable();
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
       Schema::dropIfExists($this->tableName);
     }
}
