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

        Schema::create('product_categories', function (Blueprint $table) {
        $table->id();
        $table->string('category_name', 30)->nullable();
    });


        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('prod_name', 120);
            $table->string('seo_title', 120);
            $table->text('prod_description', 5000)->nullable();
            $table->text('meta_title', 500)->nullable();
            $table->text('meta_description', 5000)->nullable();
            $table->string('available_at');
            $table->integer('prod_price')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('no action');
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
        Schema::dropIfExists('product_categories');
    }
}
