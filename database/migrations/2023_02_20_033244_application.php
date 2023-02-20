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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('template');
            $table->timestamps();
        });

        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->string('template_id');
            $table->string('code');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('upload_files', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('data');
            $table->timestamps();
        });

        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('status');
            $table->string('role');
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
        //
    }
};
