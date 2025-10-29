<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('status', ['Hadir','Izin','Sakit','Alpha'])->default('Hadir');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('attendances');
    }
};
