<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->length(100)->nullable();
            $table->string('title')->length(250);
            $table->string('short_description')->length(250);
            $table->text('description');
            $table->string('image')->length(250);
            $table->Integer('sort_order')->length(10);   
            $table->tinyInteger('status')->length(2)->default(1)->comment('0=Active, 1=InActive'); 
            $table->softDeletes();         
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
        Schema::dropIfExists('news');
    }
}
