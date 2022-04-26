<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleOrdersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'sale_orders';

    /**
     * Run the migrations.
     * @table tasks
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 45);
            $table->bigInteger('created_by_user_id');
            $table->bigInteger('word_count')->nullable()->default(null);
            $table->bigInteger('currency_id')->nullable()->default(null);
            $table->decimal('currency', 8, 2)->nullable()->default(null);
            $table->string('customer_name')->nullable()->default(null);
            $table->string('customer_email')->nullable()->default(null);
            $table->enum('customer_type', ['EXISTING', 'NEW', 'REFFERAL']);
            $table->bigInteger('amount')->nullable()->default(null);
            $table->bigInteger('amount_received')->nullable()->default(null);
            $table->timestamp('deadline')->nullable()->default(null);
            $table->longText('notes')->nullable()->default(null);
            $table->longText('additional_notes')->nullable()->default(null);
            $table->bigInteger('invoice_file_id')->nullable();
            $table->timestamp('start_date_time')->nullable()->default(null);
            $table->timestamp('end_date_time')->nullable()->default(null);
            $table->enum('payment_status', ['PAID', 'UNPAID', 'PARTIALLY PAID']);
            $table->enum('status', ['ACTIVE', 'DISABLED', 'PENDING']);
            $table->tinyInteger('is_urgent')->default(0);
            $table->string('website')->nullable();
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
