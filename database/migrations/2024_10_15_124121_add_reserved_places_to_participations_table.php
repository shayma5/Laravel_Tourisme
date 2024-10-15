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
    Schema::table('participations', function (Blueprint $table) {
        $table->integer('reserved_places')->default(1); // Par défaut, 1 place réservée
    });
}




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('participations', function (Blueprint $table) {
        $table->dropColumn('reserved_places');
    });
}
};
