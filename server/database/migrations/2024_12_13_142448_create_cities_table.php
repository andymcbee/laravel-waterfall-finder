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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->integer('id_csc')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('state_name')->nullable();
            $table->string('state_code')->nullable();
            $table->string('country_name');
            $table->string('country_code');
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->point('geom');
            $table->timestamps();
        });

        DB::statement('CREATE INDEX cities_geom_idx ON cities USING GIST (geom)');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
        DB::statement('DROP INDEX IF EXISTS cities_geom_idx');
    }
};
