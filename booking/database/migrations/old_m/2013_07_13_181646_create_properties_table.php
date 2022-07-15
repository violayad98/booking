<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->string('name');
            $table->unsignedBigInteger('city')->nullable();
            $table->string('street')->nullable();
            $table->string('building', 8)->nullable();
            $table->string('apt')->nullable();
            $table->longText('description')->nullable();
            $table->string('photo')->nullable();
            $table->decimal('grade', $precision = 8, $scale = 1);


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
        Schema::dropIfExists('property');
    }
}
