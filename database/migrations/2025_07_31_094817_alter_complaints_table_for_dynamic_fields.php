<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterComplaintsTableForDynamicFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn(['name', 'email', 'department', 'message']);

            // Tambah kolom baru
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('department')->nullable();
            $table->text('message')->nullable();
            $table->dropColumn('data');
        });
    }
}
