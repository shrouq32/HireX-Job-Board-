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
        if (!Schema::hasTable('jobs')) {
            Schema::create('jobs', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description');
                $table->text('requirements');
                $table->string('location');
                $table->foreignId('category_id')->constrained('job_categories')->onDelete('cascade');
                $table->foreignId('job_status')->constrained('jobs_status')->onDelete('cascade');
                $table->foreignId('job_type')->constrained('job_type')->onDelete('cascade');
                $table->text('responsibilities');
                $table->foreignId('emp_id')->constrained('employers')->onDelete('cascade');
                $table->decimal('salary', 10, 2);
                $table->text('benefits');
                $table->date('deadline');
                $table->string('logo')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
