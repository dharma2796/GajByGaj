<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userid');
            $table->bigInteger('txnid');
            $table->string('fromWallet',30)->nullable();
            $table->string('toWallet',30)->nullable();
            $table->string('price',50)->nullable();
            $table->decimal('amount',36,18)->default(0)->comment('coin amount');
            $table->string('type',20)->nullable();
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
        Schema::dropIfExists('wallet_transfers');
    }
}
