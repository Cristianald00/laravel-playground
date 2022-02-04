<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('identifier');
            $table->integer('batch_number')->unsigned();
            $table->unsignedBigInteger('batch_number');
            $table->foreign('batch_number')->references('batch_number')->on('inventories')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity')->default(0);;
            $table->decimal('price');
            $table->decimal('cost');
            $table->integer('reorder_point');
            $table->boolean('active');
            $table->string('product_image', 100);
            $table->string('description')->nullable();
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
        Schema::dropIfExists('products');
    }
}
