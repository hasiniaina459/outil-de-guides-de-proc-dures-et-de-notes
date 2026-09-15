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
        Schema::create('lecture',function(Blueprint $table){
            $table->id();
            $table->foreignId('id_note')->constrained('note','id_note')->cascadeOnDelete();
            $table->foreignId('id_individu')->constrained('individu','id_individu')->cascadeOnDelete();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            $table->unique(['id_note','id_individu']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecture');
    }
};
