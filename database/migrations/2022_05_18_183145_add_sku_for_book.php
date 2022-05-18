<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Book;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //1 veiksmas pridedam neunikalu
        //2 veiksmas prigeneruojam duomenu
        //3 uzdedam fieldui unikaluma
        Schema::table('books', function (Blueprint $table) {
            $table->string('sku');
        });

        foreach (Book::all() as $book) {
            $book->sku = uniqid('sku');
            $book->save();
        }

        Schema::table('books', function (Blueprint $table) {
            $table->unique('sku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
