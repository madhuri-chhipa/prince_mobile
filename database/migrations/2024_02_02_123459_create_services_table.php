<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->length(100)->nullable();
            $table->string('name')->length(250);
            $table->string('icon')->length(250);
            $table->string('image')->length(250);
            $table->string('brochure')->length(250);
            $table->float('price');
            $table->text('short_description');
            $table->text('description');
            $table->text('meta_title');
            $table->text('meta_keyword');
            $table->text('meta_description');
            $table->Integer('sort_order')->length(10);   
            $table->tinyInteger('status')->length(4)->default(1); 
            $table->tinyInteger('is_featured')->length(4)->default(1);
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
        Schema::dropIfExists('services');
    }
}
