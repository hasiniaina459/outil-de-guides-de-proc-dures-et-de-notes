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
        schema::create('rappel',function(Blueprint $table){
            $table->id('id_rappel');
            $table->timestamp('remind_date');
            $table->string('remind_title');
            $table->unsignedSmallInteger('remind_number');
            $table->timestamps();
            $table->foreignId('id_note')
                ->nullable()
                ->constrained('note', 'id_note')
                ->nullOnDelete();
            $table->enum('source', ['manuel', 'auto'])
                ->default('manuel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('rappel');
    }
};
