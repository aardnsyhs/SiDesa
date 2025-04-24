<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nik', 16);
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['pria', 'wanita']);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir', 100);
            $table->text('alamat');
            $table->string('agama', 50);
            $table->enum('status_menikah', ['belum_menikah', 'menikah', 'cerai']);
            $table->string('pekerjaan', 100);
            $table->string('telepon', 20);
            $table->enum('status', ['aktif', 'pindah', 'meninggal'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
