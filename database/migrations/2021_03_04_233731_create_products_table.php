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
            $table->string('name')->unique();
            $table->string('slug');
            $table->enum('type', ['Footwear'])->default('Footwear')->nullable();
            $table->bigInteger('views_count')->default(0)->nullable();
            $table->longText('description')->nullable();
            $table->enum('class', ['Male', 'Female', 'Unisex', 'Children', 'Not Applicable'])->default('Not Applicable');
            $table->double('weight')->nullable();
            $table->double('price');
            $table->integer('quantity')->nullable();
            $table->string('available_sizes');
            $table->string('available_colors');
            $table->string('front_image');
            $table->boolean('available')->default(true)->nullable();
            $table->boolean('verified')->default(false)->nullable();
            $table->boolean('featured')->default(false)->nullable();
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');

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
