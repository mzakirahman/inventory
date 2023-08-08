<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemMasukTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_masuk', function (Blueprint $table) {
            $table->increments('id_item');
            $table->string('id_transaksi', '5');
            $table->string('po_number', '30')->nullable();
            $table->string('id_stok', '5');
            $table->string('uoi', '30')->nullable();
            $table->string('on_hand', '10')->nullable();
            $table->string('received', '10')->nullable();
            $table->string('balance', '10')->nullable();
            $table->string('min_max', '30')->nullable();
            $table->string('bin_loc', '30')->nullable();
            $table->string('doc_loc', '30')->nullable();
            $table->string('remarks', '30')->nullable();
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
        Schema::dropIfExists('item_masuk');
    }
}
