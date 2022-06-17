<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug', 50)->unique();
            $table->string('description')->nullable();
            /**
             * Examples for categories of ingredients:
             *    Condiments, fruit, meat, pasta/rice, syrup/oil, frozen,
             *    vegetable, beverage, baking, snack, deli, bakery, canned,
             *    spices, dairy, cereal, general, misc
             */
            $table->foreignUuid('category_id')
                ->nullable()
                ->references('id')
                ->on('categories');
            $table->foreignUuid('added_by')
                ->nullable()
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('ingredients');
    }
};
