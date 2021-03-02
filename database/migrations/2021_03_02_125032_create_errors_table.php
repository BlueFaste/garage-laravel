<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('errors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('published');
            $table->foreignId('vehicle_id')->constrained();
            $table->timestamps();
        });

        Schema::table('vehicles', function (Blueprint $table){
            $table->boolean('toto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('errors');
        if( Schema::hasColumn('vehicles', 'toto')){ //pas obligatoire le if
            Schema::table('vehicles', function (Blueprint $table) {
                $table->dropColumn('toto');

            });
        }
    }
}
