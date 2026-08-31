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
        Schema::create('individu',function(Blueprint $table){
            $table->id('id_individu');
            $table->string('name');
            $table->string('firstname');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address');
            $table->string('password');
            $table->foreignId('id_service')->nullable()
                ->constrained('service', 'id_service')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('individu');
    }
};
