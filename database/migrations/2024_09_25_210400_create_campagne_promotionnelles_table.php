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
    Schema::create('campagne_promotionnelles', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->decimal('budget', 10, 2);
        $table->date('date_debut');
        $table->date('date_fin');
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
        Schema::dropIfExists('campagne_promotionnelles');
    }
};
