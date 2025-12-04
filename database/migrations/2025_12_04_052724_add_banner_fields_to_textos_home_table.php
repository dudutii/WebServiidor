<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
    {
        Schema::table('textos_home', function (Blueprint $table) {
            $table->string('banner_legenda')->nullable();
            $table->string('banner_titulo')->nullable();
            $table->string('banner_imagem')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('textos_home', function (Blueprint $table) {
            $table->dropColumn(['banner_legenda', 'banner_titulo', 'banner_imagem']);
        });
    }
};
