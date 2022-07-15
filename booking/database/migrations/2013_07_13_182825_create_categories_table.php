<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('name');
            $table->Integer('room_count')->nullable();
            $table->Integer('count')->nullable();
            $table->Integer('person_max')->nullable();
            $table->Integer('size')->nullable();
            $table->decimal('price_per_night', $precision = 8, $scale = 2);
            $table->Integer('property_type')->nullable();
            $table->Integer('bed_type')->nullable();
            $table->Integer('meal_type')->nullable();
            $table->integer('stars');
            $table->decimal('grade', $precision = 8, $scale = 1);
            $table->longText('description')->nullable();

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
        Schema::dropIfExists('category');
    }
}
