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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('qualification_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('job_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onUpdate('cascade')->onDelete('set null');
            $table->string('name');
            $table->date('birth_date');
            $table->date('graduate_date');
            $table->string('address');
            $table->string('phone');
            $table->text('experiences');
            $table->string('current_job')->nullable();
            $table->text('courses')->nullable();
            $table->integer('expected_salary')->nullable();
            $table->string('university')->nullable();
            $table->string('collage')->nullable();
            $table->enum('marital', ['single', 'married', 'separated']);
            $table->integer('children')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
