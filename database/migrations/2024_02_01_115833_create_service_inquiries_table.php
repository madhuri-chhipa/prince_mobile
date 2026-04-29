<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_inquiries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("service_id");
            $table->string('name')->length(250);
            $table->string('email')->length(250)->unique();
            $table->string('mobile')->length(10)->unique();
            $table->text('message');
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
        Schema::dropIfExists('service_inquiries');
    }
}
