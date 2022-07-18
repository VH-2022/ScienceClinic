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
        Schema::table('sc_parent_inquiry_details', function (Blueprint $table) {
            $table->enum('inquiry_type',['1','2'])->default('1')->comment("1 = Online, 2 = Offline");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sc_parent_inquiry_details', function (Blueprint $table) {
            //
        });
    }
};
