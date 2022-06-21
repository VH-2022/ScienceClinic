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
        Schema::create('sc_feedback', function (Blueprint $table) {
            $table->id();
            $table->longText('descriptions')->nullable();
            $table->string('subject')->nullable();
            $table->string('outcome')->nullable();
            $table->float('rating')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('inquiry_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sc_feedback');
    }
};
