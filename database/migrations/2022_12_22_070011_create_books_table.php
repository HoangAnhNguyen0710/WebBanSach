<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('author_name');
            $table->integer('pages');
            $table->integer('in_stock');
            $table->integer('sold');
            $table->integer('number_of_copies');
            $table->text('type');
            $table->text('language');
            $table->text('description');
            $table->boolean('display');
            $table->bigInteger('price');
            $table->bigInteger('discount_price');
            $table->unsignedBigInteger('publisher_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
