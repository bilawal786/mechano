<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->longText('h1');
            $table->longText('h2');
            $table->longText('h3');
            $table->longText('h4');
            $table->longText('h5');
            $table->longText('h6');
            $table->longText('h7');
            $table->longText('h8');
            $table->longText('h9');
            $table->longText('h10');
            $table->longText('h11');
            $table->longText('h12');
            $table->longText('h13');
            $table->longText('h14');
            $table->longText('h15');
            $table->longText('h16');
            $table->longText('h17');
            $table->longText('h18');
            $table->longText('h19');
            $table->longText('h20');
            $table->longText('h21');
            $table->longText('h22');
            $table->longText('h23');
            $table->longText('h24');
            $table->longText('h25');
            $table->longText('h26');
            $table->longText('h27');
            $table->longText('h28');
            $table->longText('h29');
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
        Schema::dropIfExists('contents');
    }
}
