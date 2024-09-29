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
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment("Họ tên");
            $table->string('email')->nullable()->comment("Email");
            $table->string('phone')->nullable()->comment("SĐT");
            $table->date('birthday')->nullable()->comment("Ngày sinh");
            $table->string('address')->nullable()->comment("Địa chỉ");
            $table->tinyInteger('sex')->nullable()->comment("Giới tính: 1 = Nam, 2 = Nữ");
            $table->string('level')->nullable()->comment("Trình độ");
            $table->string('hobby')->nullable()->comment("Sở thích");
            $table->string('image')->nullable()->comment("Ảnh chân dung");
            $table->string('note')->nullable()->comment("Ghi chú");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
