<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('bed_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('meal_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_types');
        Schema::dropIfExists('bed_types');
        Schema::dropIfExists('meal_types');
    }
}
