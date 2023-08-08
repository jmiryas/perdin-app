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
        Schema::create('travel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("div_sdm_id");
            $table->unsignedBigInteger("pegawai_id");
            $table->unsignedBigInteger("current_city_id")->nullable();
            $table->unsignedBigInteger("destination_city_id")->nullable();
            $table->unsignedBigInteger("travel_status_id");
            $table->text("description")->nullable();
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->double("allowance")->default(0);
            $table->boolean("is_domestic")->default(true);
            $table->foreign("div_sdm_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("pegawai_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("current_city_id")->references("id")->on("cities")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("destination_city_id")->references("id")->on("cities")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("travel_status_id")->references("id")->on("travel_statuses")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('travel');
    }
};
