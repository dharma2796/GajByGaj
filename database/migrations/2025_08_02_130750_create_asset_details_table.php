<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userid');
            $table->string('accountname',50)->nullable();
            $table->string('bankname',50)->nullable();
            $table->string('accountno',50)->nullable();
            $table->string('ifsc',50)->nullable();
            $table->string('upiid',80)->nullable();
            $table->string('bep20addr',100)->nullable();
            $table->string('usdttrc20addr',100)->nullable();
            $table->string('usdtbep20addr',100)->nullable();
            $table->string('address',150)->nullable();
            $table->string('city',30)->nullable();
            $table->string('state',20)->nullable();
            $table->string('pin',10)->nullable();
            $table->smallInteger('asset_status')->default(1)->comment('1 active 0inactive');
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
        Schema::dropIfExists('asset_details');
    }
}
