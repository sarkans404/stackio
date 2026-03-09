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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('question_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('responses')
                ->cascadeOnDelete();

            $table->text('body');
            $table->boolean('is_accepted')->default(true);
            $table->boolean('is_correct')->default(false);
            $table->string('image')->nullable();
            $table->date('date')->default(now());

            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->integer('reports')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
