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
    Schema::create('souvenirs', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->decimal('prix', 8, 2);
        $table->text('description');
        $table->decimal('promotion', 5, 2)->nullable();
        $table->integer('nbr_restant');
        $table->string('image')->nullable();
        $table->foreignId('magasin_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('souvenirs');
    }
};
