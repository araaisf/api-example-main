<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('catatan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // ← ini tempatnya
        $table->string('judul');
        $table->text('isi')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    public function down(): void
    {
        Schema::dropIfExists('catatan'); // ➜ HARUS SAMA DENGAN CREATE!
    }
};
