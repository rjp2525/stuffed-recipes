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
        Schema::create('recipes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('author_id', 36)
                ->nullable()
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreignUuid('category_id')
                ->nullable()
                ->references('id')
                ->on('categories');
            $table->foreignUuid('forked_from')
                ->nullable()
                ->references('id')
                ->on('recipes');
            $table->string('title')->index();
            $table->string('slug')->unique();
            $table->enum('difficulty', ['easy', 'intermediate', 'difficult']);
            $table->string('description_short');
            $table->text('description_long')->nullable();
            $table->text('directions');
            $table->text('notes')->nullable();
            $table->integer('prep_time')->default(0);
            $table->integer('cook_time')->default(0);
            $table->integer('custom_time')->default(0);
            $table->string('custom_time_label')->nullable();
            $table->integer('total_time')->default(0);
            $table->string('yield')->nullable();
            $table->string('servings')->nullable();
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
        Schema::dropIfExists('recipes');
    }
};
