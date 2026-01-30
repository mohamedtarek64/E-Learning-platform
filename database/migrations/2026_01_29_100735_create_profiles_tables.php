<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instructor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('headline')->nullable();
            $table->text('biography')->nullable();
            $table->json('expertise_areas')->nullable();
            $table->string('website_url')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->integer('total_students')->default(0);
            $table->integer('total_courses')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->decimal('total_earnings', 15, 2)->default(0);
            $table->string('payout_method')->nullable();
            $table->text('payout_details')->nullable(); // Encrypted in model
            $table->timestamps();
        });

        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('learning_goals')->nullable();
            $table->json('interests')->nullable();
            $table->integer('total_courses_enrolled')->default(0);
            $table->integer('total_courses_completed')->default(0);
            $table->integer('total_certificates_earned')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
        Schema::dropIfExists('instructor_profiles');
    }
};
