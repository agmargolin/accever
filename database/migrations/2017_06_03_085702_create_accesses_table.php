<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesses', function (Blueprint $table) {
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
            $table->timestamps();
        });

        Schema::create('accesses_users', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('access_id')->unsigned();
            $table->nullableTimestamps();

            $table->primary(['user_id', 'accesses_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesses');
        Schema::dropIfExists('accesses_users');
    }
}
