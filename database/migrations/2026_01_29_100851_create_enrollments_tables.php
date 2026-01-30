<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->enum('enrollment_type', ['free', 'paid'])->default('free');
            $table->timestamp('enrolled_at')->useCurrent();
            $table->foreignId('payment_id')->nullable(); // will be linked later
            $table->decimal('progress_percentage', 5, 2)->default(0);
            $table->timestamp('last_accessed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('certificate_issued_at')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'course_id']);
        });

        Schema::create('lesson_completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->timestamp('completed_at')->useCurrent();
            $table->integer('watch_time_seconds')->default(0);
            $table->timestamps();

            $table->unique(['student_id', 'lesson_id']);
        });

        Schema::create('course_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained('course_enrollments')->onDelete('cascade');
            $table->integer('total_lessons')->default(0);
            $table->integer('completed_lessons')->default(0);
            $table->integer('total_quizzes')->default(0);
            $table->integer('passed_quizzes')->default(0);
            $table->decimal('progress_percentage', 5, 2)->default(0);
            $table->foreignId('current_lesson_id')->nullable()->constrained('lessons')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_progress');
        Schema::dropIfExists('lesson_completions');
        Schema::dropIfExists('course_enrollments');
    }
};
