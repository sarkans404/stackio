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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('body')->nullable();
            $table->date('date')->default(now());
            $table->integer('views')->default(0);
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->integer('answers')->default(0);
            $table->integer('reports')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
