<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrimestreActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trimestre_actividads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ct_id')->unsigned();
            $table->integer('area');
            $table->double('a1', 8, 2);
            $table->double('a2', 8, 2);
            $table->double('a3', 8, 2);
            $table->double('a4', 8, 2);
            $table->double('a5', 8, 2);
            $table->double('a6', 8, 2);
            $table->double('promedio', 8, 2);
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
        Schema::dropIfExists('trimestre_actividads');
    }
}
