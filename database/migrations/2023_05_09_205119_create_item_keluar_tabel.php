<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemKeluarTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_keluar', function (Blueprint $table) {
            $table->increments('id_item');
            $table->string('id_transaksi', '5');
            $table->string('vocab_number', '20');
            $table->string('uom', '20');
            $table->integer('qty');
            $table->string('order_no', '20')->nullable();
            $table->string('remasrk', '20')->nullable();
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
        Schema::dropIfExists('item_keluar');
    }
}
