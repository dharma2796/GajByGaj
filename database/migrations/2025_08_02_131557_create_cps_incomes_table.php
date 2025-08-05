<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpsIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cps_incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userid');
            $table->bigInteger('txnid');
            $table->decimal('amount',18,6)->default(0);
            $table->decimal('remaining',18,6)->default(0);
            $table->decimal('totalamount',18,6)->default(0);
            $table->smallInteger('status')->default(0);
            $table->bigInteger('intxna')->default(0);
            $table->bigInteger('intxnb')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cps_incomes');
    }
}
