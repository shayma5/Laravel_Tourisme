<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classe', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('specialite');
            $table->string('localisation');

            $table->foreignId('programme_id')->constrained('programme')->onDelete('cascade'); // Ajoute cette ligne    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classe');
    }
};
