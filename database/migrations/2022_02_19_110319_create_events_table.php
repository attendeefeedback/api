<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_title');
            $table->string('event_desc')->nullable()->default('NULL');
            $table->string('event_img')->nullable()->default('NULL');
            $table->string('event_location')->nullable()->default('NULL');
            $table->string('event_time')->nullable()->default('NULL');
            $table->string('event_code')->unique()->nullable()->default('NULL');
            $table->string('unique_id')->unique();
            $table->bigInteger('admin_id')->unsigned()->index();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->enum('event_status', array('not-started', 'started','completed'))->default('not-started');   
            $table->tinyInteger('is_published')->unsigned()->default(0);
            $table->tinyInteger('active_flag')->unsigned()->default(1);
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
        Schema::dropIfExists('events');
    }
}
