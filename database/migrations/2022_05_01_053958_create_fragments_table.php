<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fragments', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250);
            $table->string('slug',250);
            $table->text('text');
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->boolean('is_main')->default(false);
            $table->foreign('category_id')->references('id')->on('fragment_categories')->onDelete('set null');
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
        Schema::dropIfExists('fragments');
    }
}
