<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountPricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_pricings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_group_id');
            $table->foreign('customer_group_id')->references('id')->on('group_customers');

            $table->string('brand')->nullable();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->bigInteger('ctn_qty')->default('0');
            $table->enum('or_more', ['0', '1'])->default('0');
            $table->bigInteger('discount_rate')->default('0');
            $table->enum('is_active', ['0', '1'])->default('0');
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_pricings');
    }
}