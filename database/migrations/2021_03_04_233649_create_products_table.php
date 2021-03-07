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
            $table->uuid('id')->primary();
            $table->string('admin_id');
            $table->string('category_id');
            $table->string('sub_category_id');
            $table->string('code');
            $table->string('name');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->enum('class', ['Male', 'Female', 'Unisex', 'Children', 'Not Applicable'])->default('Not Applicable');
            $table->double('weight')->nullable();
            $table->double('price');
            $table->integer('quantity');
            $table->string('available_sizes')->nullable();
            $table->string('available_colors')->nullable();
            $table->string('front_view')->nullable();
            $table->boolean('available')->default(true);
            $table->boolean('verified')->default(false);
            $table->boolean('featured')->default(false);
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
