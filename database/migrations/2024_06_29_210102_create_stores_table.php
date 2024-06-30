<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (config('database.default') === 'pgsql') {
            DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');
        }

        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('address', 100);
            $table->string('city', 25);
            $table->string('state', 2);
            $table->string('postal', 12);
            $table->geography('location', subtype: 'point', srid: 4326);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');

        if (config('database.default') === 'pgsql') {
            DB::statement('DROP EXTENSION IF EXISTS postgis');
        }
    }
};
