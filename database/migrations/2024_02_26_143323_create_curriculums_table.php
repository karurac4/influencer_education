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
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('thumbnail');
            $table->text('description');
            $table->string('video_url');
            $table->boolean('alway_delivery_flg')->default(false);
            $table->unsignedBigInteger('grade_id');
            $table->timestamps();

            $table->foreign('grade_id')->references('id')->on('grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->dropForeign(['grade_id']);
        });

        Schema::dropIfExists('curriculums');
    }
};
