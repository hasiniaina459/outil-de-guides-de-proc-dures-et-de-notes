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
        Schema::create('recevoir',function(Blueprint $table){
            $table->id();
            $table->foreignId('id_rappel')->constrained('rappel','id_rappel')->cascadeOnDelete();
            $table->foreignId('id_individu')->constrained('individu','id_individu')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recevoir');
    }
};
