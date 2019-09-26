<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyProductsTable extends Migration
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
			$table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('product_name');
            $table->string('images');
			$table->decimal('price', 8,2);	// highest number 99,999,999.99
			$table->integer('quantity');
			
			
			$table->string('brand');
			$table->foreign('brand')->references('brand')->on('brands');
            $table->string('condition');
            $table->foreign('condition')->references('condition')->on('conditions');
			
            $table->double('rating');	// may need to change this data type
            
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
