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
        Schema::table('events', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->nullable();  // Champ pour le prix
            $table->integer('nbParticipant')->default(0);  // Champ pour le nombre de participants
        });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn('price');
        $table->dropColumn('nbParticipant');
    });
}
};
