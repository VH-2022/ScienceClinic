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
        Schema::create('sc_subject_master', function (Blueprint $table) {
            $table->id();
            $table->string('main_title')->nullable();
            $table->string('sub_title_one')->nullable();
            $table->string('sub_title_two')->nullable();
            $table->string('title')->nullable();
            $table->string('image', 2048)->nullable();
            $table->string('description', 2048)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('subject_master');
    }
};
