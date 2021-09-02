<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
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
            $table->bigInteger('creator_id')->unsigned();
            $table->string('title')->unique();
            $table->string('foto');
            $table->char('publication_year', '4');
            $table->char('status', '1');
            $table->timestamps();
        });



        Schema::table('books', function ($table) {
            $table->foreign('creator_id')->references('id')->on('book_creator')->onUpdate('cascade')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign(['id_creator']);
        Schema::dropIfExists('books');
    }
}
