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
        Schema::create('classe_formateur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->constrained('formateur')->onDelete('cascade');
            $table->foreignId('classe_id')->constrained('classe')->onDelete('cascade');
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
        Schema::dropIfExists('classe_formateur');
    }
};
