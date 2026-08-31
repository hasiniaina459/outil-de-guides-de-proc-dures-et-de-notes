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
        Schema::create('procedure',function(Blueprint $table){
            $table->id('id_procedure');
            $table->string('procedure_title');
            $table->string('description')->nullable();
            $table->boolean('procedure_status')->default(false);
            $table->timestamp('add_date');
            $table->timestamp('remove_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedure');
    }
};
