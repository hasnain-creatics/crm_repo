<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWriterWorkTimelinesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'writer_work_timelines';

    /**
     * Run the migrations.
     * @table employee_task_timeline
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('sale_order_id');
            $table->bigInteger('sale_order_status_id');
            $table->timestamp('start_date_time')->nullable()->default(null);
            $table->timestamp('end_date_time')->nullable()->default(null);
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
