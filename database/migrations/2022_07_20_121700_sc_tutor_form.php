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
        Schema::create(
            'sc_tutor_form',
            function (Blueprint $table) {
                $table->id();
                $table->string('tutor_name')->nullable();
                $table->string('student_name')->nullable();
               $table->string('day_of_tution')->nullable();
               $table->time('tution_time')->nullable();
               $table->integer('rate')->nullable();
               $table->integer('commission')->nullable();
               $table->integer('month')->nullable();
                $table->timestamp('time')->nullable();
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->integer('deleted_by')->nullable();
                $table->timestamps();
            }
        );
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
