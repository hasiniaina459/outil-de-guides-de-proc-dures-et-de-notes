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
        schema::create('rattacher',function(Blueprint $table){
            $table->id();
            $table->foreignId('id_procedure')->constrained('procedure','id_procedure')->cascadeOnDelete();
            $table->foreignId('id_service')->constrained('service','id_service')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rattacher');
    }
};
