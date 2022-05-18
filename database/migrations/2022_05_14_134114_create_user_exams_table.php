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
        Schema::create('user_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained(table: 'users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('exam_id')->constrained(table: 'exams')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['student_id', 'exam_id']);

            $table->json('result');
            $table->integer('total_correct')->default(0);
            $table->integer('total_false')->default(0);
            $table->integer('score')->default(0);

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
        Schema::dropIfExists('user_exams');
    }
};
