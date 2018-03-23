<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->index();
            $table->string('scope');
            $table->string('type');
            $table->string('url');
            $table->string('login');
            $table->string('password');
            $table->string('port');
            $table->string('service_name');
            $table->string('description');
            $table->string('author_id');
            $table->string('user_changeme_id');
            $table->string('log_comment');
            $table->timestamp('access_created')->nullable();
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
        Schema::dropIfExists('logs');
    }
}
