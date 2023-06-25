<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('travel_id');
            $table->string('name');
            $table->dateTime('starting_date');
            $table->dateTime('ending_date');
            $table->decimal('price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tours');
    }
};
