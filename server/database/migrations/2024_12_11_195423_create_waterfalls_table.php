<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('waterfalls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('height');
            $table->string('province');
            $table->geometry('location');
            $table->timestamps();
        });

        DB::statement('CREATE INDEX waterfalls_location_index ON waterfalls USING GIST (location);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waterfalls');
    }
};
