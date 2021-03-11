<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->string('admin_id');
            $table->bigInteger('lowest_amount')->nullable();
            $table->string('product_id')->nullable();
            $table->enum('type', ['Percentage', 'Price'])->default('Percentage');
            $table->bigInteger('discount')->default(20); // by percentage or price
            $table->bigInteger('max_usage')->default(10);
            $table->bigInteger('remaining')->nullable();
            $table->boolean('will_expire')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamp('expires_in')->nullable();
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('coupon_user', function (Blueprint $table) {

            $table->string('user_id');
            $table->string('coupon_id');

            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('coupons');
    }
}
