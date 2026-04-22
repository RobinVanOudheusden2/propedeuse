<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_game_collections', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('game_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['wishlist', 'playing', 'completed', 'dropped'])->default('wishlist');
            $table->unsignedTinyInteger('rating')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('added_at')->useCurrent();
            $table->primary(['user_id', 'game_id']);
        });

        DB::statement("
            ALTER TABLE user_game_collections
            ADD CONSTRAINT chk_collection_rating
            CHECK (rating IS NULL OR (rating BETWEEN 1 AND 10))
        ");

        DB::statement("
            ALTER TABLE user_game_collections
            ADD CONSTRAINT chk_wishlist_no_rating
            CHECK (status <> 'wishlist' OR rating IS NULL)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_game_collections');
    }
};
