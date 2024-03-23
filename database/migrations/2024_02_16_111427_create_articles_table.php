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
        Schema::create('articles', function (Blueprint $table) {
<<<<<<< HEAD
            $table->id();
            $table->string('title');
            $table->dateTime('posted_date');
            $table->longText('article_contents');
            $table->timestamps();
=======
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->timestamp('posted_date')->nullable();
                $table->text('article_contents');
                $table->timestamps();
            });
>>>>>>> e92bf129e0059e143dd8c02174830eb1f7ecc1d4
        });
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
