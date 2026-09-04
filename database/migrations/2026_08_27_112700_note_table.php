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
        Schema::create('note',function(Blueprint $table){
            $table->id('id_note');
            $table->string('note_title');
            $table->string('content');
            $table->boolean('note_status');
            $table->timestamp('note_date');
            $table->timestamps();
            $table->boolean('rappel_create')->default(0);
            $table->foreignId('id_procedure')->nullable()
                ->constrained('procedure', 'id_procedure')
                ->nullOnDelete();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note');
    }
};
