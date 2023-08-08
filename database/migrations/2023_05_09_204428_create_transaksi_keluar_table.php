<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_keluar', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->string('from', '20');
            $table->string('to', '20');
            $table->string('company', '100')->nullable();
            $table->string('serial', '20');
            $table->string('vessel', '100')->nullable();
            $table->string('etd', '30')->nullable();
            $table->string('eta', '30')->nullable();
            $table->string('vogaye', '30')->nullable();
            $table->string('consignor_empl', '30')->nullable();
            $table->string('consignor_name', '30')->nullable();
            $table->date('consignor_date')->nullable();
            $table->string('consignee_empl', '30')->nullable();
            $table->string('consignee_name', '30')->nullable();
            $table->date('consignee_date')->nullable();
            $table->string('stock_card_empl', '30')->nullable();
            $table->string('stock_card_name', '30')->nullable();
            $table->date('stock_card_date')->nullable();
            $table->string('mmis_empl', '30')->nullable();
            $table->string('mmis_name', '30')->nullable();
            $table->date('mmis_date')->nullable();
            $table->string('consignor_signature', '100')->nullable();
            $table->string('consignee_signature', '100')->nullable();
            $table->string('stock_card_signature', '100')->nullable();
            $table->string('mmis_signature', '100')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('transaksi_keluar');
    }
}
