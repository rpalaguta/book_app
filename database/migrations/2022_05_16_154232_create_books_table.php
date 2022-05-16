<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('iban')->nullable();
            $table->integer('year')->nullable();
            $table->string('pages')->nullable();
            $table->string('format', 200)->nullable();
            $table->string('language', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('book_author', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained('books');
            $table->foreignId('author_id')->constrained('authors');
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
        Schema::dropIfExists('book_author');
    }
};
