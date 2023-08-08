<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->increments('id_stok');
            $table->string('stock_code', '15');
            $table->text('description');
            $table->integer('qoh');
            $table->string('unit_value', '20');
            $table->string('total_value', '20');
            $table->string('location', '100');
            $table->string('commodity', '100');
            $table->string('bin_loc', '100');
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
        Schema::dropIfExists('stok');
    }
}
