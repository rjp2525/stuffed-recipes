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
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('slug', 50)->nullable()->unique()->index();
            $table->foreignUuid('parent_id')
                ->nullable()
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete();
            $table->foreignUuid('author_id')
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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('parent_id');
            $table->dropForeign('author_id');
            $table->dropIfExists();
        });
    }
};
