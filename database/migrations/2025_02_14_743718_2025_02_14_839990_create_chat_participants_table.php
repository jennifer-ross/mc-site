<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        Schema::create('chat_participants', function (Blueprint $table) {
            $table->id();
			$table->foreignId('chat_id')->index()->constrained('chats')->onDelete('cascade');
			$table->foreignId('user_id')->index()->constrained('users')->onDelete('cascade');
			$table->enum('role', ['admin', 'member'])->default('member');
			$table->timestamp('joined_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_participants');
    }
};
