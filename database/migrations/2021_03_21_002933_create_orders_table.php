<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tracking_number');
            $table->integer('number_of_items');
            $table->boolean('shipped')->default(false);
            $table->enum('status', ['Initiated', 'Processing', 'Prepared', 'Shipped', 'Delivered', 'Cancelled'])->default('Initiated');
            $table->bigInteger('total_amount');
            $table->bigInteger('sub_total_amount');
            $table->bigInteger('delivery_fee')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('user_id')->nullable();
            $table->string('coupon_id')->nullable();
            $table->string('ref')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('state');
            $table->string('country');
            $table->string('lga');
            $table->string('address');
            $table->boolean('settled')->default(false);
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
