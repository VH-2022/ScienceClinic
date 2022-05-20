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
        Schema::create('sc_tutor_details', function (Blueprint $table) {
            $table->id();
            $table->integer('tutor_id');
         
            $table->string('dbs_disclosure')->nullable();
            $table->string('experience_in_uk')->nullable();
            $table->integer('total_experience_in_uk')->nullable();
            $table->string('pay_tex')->nullable();
            $table->text('document')->nullable();
            
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
        Schema::dropIfExists('sc_tutor_details');
    }
};
