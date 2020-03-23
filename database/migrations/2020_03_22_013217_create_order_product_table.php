<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    private function buildForeignKey(Blueprint $table,string $columnName)
    {
        $table->foreign($columnName."_id")
            ->references('id')
            ->on($columnName."s")
            ->onDelete('cascade');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->tinyInteger('quantity');
            $this->buildForeignKey($table,'order');
            $this->buildForeignKey($table,'product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}
