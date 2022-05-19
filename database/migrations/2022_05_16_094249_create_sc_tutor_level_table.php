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
        Schema::create('sc_tutor_level', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->integer('create_by')->nullable();
            $table->integer('update_by')->nullable();
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
        Schema::dropIfExists('sc_tutor_level');
    }
};
