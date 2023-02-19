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
            $table->json('schema');            
            $table->timestamps();
        });

        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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
