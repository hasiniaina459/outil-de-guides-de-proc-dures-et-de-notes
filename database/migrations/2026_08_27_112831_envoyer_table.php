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
        Schema::create('envoyer',function(Blueprint $table){
            $table->id();
            $table->foreignId('id_service')->constrained('service','id_service')->cascadeOnDelete();
            $table->foreignId('id_note')->constrained('note','id_note')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envoyer');
    }
};
