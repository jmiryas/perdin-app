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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("province_id")->nullable();
            $table->unsignedBigInteger("country_id")->nullable();
            $table->string("name");
            $table->string("alt_name")->nullable();
            $table->string("latitude");
            $table->string("longitude");
            $table->foreign("province_id")->references("id")->on("provinces")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("country_id")->references("id")->on("countries")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('cities');
    }
};
