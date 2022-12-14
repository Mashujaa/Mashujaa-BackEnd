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
        Schema::create('all_units_models', function (Blueprint $table) {
            $table->id();
            $table->string("unit_name");
            $table->string("unit_code");
            $table->string("year");
            $table->string("semester");
            $table->string("course_id");
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
        Schema::dropIfExists('all_units_models');
    }
};
