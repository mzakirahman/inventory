<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiMasukTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_masuk', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->string('no', '20');
            $table->date('date_transaksi');
            $table->string('receiving_from', '30')->nullable();
            $table->string('carried_by', '30')->nullable();
            $table->string('checked_by', '30')->nullable();
            $table->string('position', '30')->nullable();
            $table->date('date')->nullable();
            $table->string('receiving_signature', '100')->nullable();
            $table->string('receiving_name', '30')->nullable();
            $table->string('receiving_position', '30')->nullable();
            $table->string('receiving_empl', '30')->nullable();
            $table->string('receiving_date', '30')->nullable();
            $table->string('inventory_signature', '100')->nullable();
            $table->string('inventory_name', '30')->nullable();
            $table->string('inventory_position', '30')->nullable();
            $table->string('inventory_empl', '30')->nullable();
            $table->string('inventory_date', '30')->nullable();
            $table->string('record_signature', '100')->nullable();
            $table->string('record_name', '30')->nullable();
            $table->string('record_position', '30')->nullable();
            $table->string('record_empl', '30')->nullable();
            $table->string('record_date', '30')->nullable();
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
        Schema::dropIfExists('transaksi_masuk');
    }
}
