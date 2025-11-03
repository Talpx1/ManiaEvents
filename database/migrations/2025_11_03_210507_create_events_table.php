<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('featured_image_path')->unique();
            $table->timestamp('begins_at');
            $table->timestamp('ends_at')->nullable();
            $table->string('status');
            $table->foreignId('creator_id')->constrained('users')->cascadeOnUpdate();
            $table->boolean('has_leaderboard');
            $table->timestamp('open_subscriptions_at')->nullable();
            $table->timestamp('close_subscriptions_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('events');
    }
};
