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
        Schema::create('demande_admin',function (Blueprint $table){
            $table->id();
            $table->foreignId('id_individu')
                ->constrained('individu','id_individu')->cascadeOnDelete();
            $table->enum('status',['en_attente','rejetee'])->default('en_attente');
            $table->timestamp('demande_at');
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_admin');
    }
};
