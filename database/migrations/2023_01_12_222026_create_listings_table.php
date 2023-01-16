<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//run migrate command to change database

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //link user to listing
            //-> onDelete('cascade') -> if user is deleted all listing will be deleted
            $table->string('title');
            $table->string('logo')->nullable(); //will be the file path to the image, nullable() -> can be null
            $table->string('tags');
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->longText('description');
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
        Schema::dropIfExists('listings');
    }
};
