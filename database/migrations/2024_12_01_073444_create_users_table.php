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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique()->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('gender')->nullable();;
            $table->string('rank')->nullable(); // Pangkat
            $table->string('grade')->nullable(); // Golongan
            $table->string('job_tier')->nullable();; // Jenjang Jabatan
            $table->string('main_position')->nullable();; // Jabatan Utama
            $table->string('additional_position')->nullable(); // Jabatan Tambahan
            $table->string('role'); // Role
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
