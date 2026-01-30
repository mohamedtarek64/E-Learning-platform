<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_discussions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('question_text');
            $table->boolean('is_resolved')->default(false);
            $table->integer('upvotes_count')->default(0);
            $table->timestamps();
        });

        Schema::create('discussion_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discussion_id')->constrained('course_discussions')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('reply_text');
            $table->boolean('is_instructor_reply')->default(false);
            $table->boolean('is_solution')->default(false);
            $table->integer('upvotes_count')->default(0);
            $table->timestamps();
        });

        Schema::create('discussion_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('voteable');
            $table->enum('vote_type', ['upvote', 'downvote']);
            $table->timestamps();

            $table->unique(['user_id', 'voteable_id', 'voteable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discussion_votes');
        Schema::dropIfExists('discussion_replies');
        Schema::dropIfExists('course_discussions');
    }
};
