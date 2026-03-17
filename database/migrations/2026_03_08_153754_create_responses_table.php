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
            $table->boolean('is_accepted')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->boolean('is_edited')->default(false);
            $table->string('image')->nullable();

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
