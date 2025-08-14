<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userid');
            $table->decimal('amount',15,2)->default(0);
            $table->decimal('amountusdt',15,2)->default(0);
            $table->string('planname',30)->nullable();
            $table->string('size',20)->nullable();
            $table->decimal('quantity',7,2)->default(1);
            $table->integer('roiid')->default(1);
            $table->smallInteger('status')->defaul(1);
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
        Schema::dropIfExists('plan_details');
    }
}
