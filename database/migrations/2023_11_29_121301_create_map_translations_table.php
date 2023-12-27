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
        Schema::create('map_translations', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('address');
            $table->foreignId('map_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->unique(['map_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_translations');
    }
};
