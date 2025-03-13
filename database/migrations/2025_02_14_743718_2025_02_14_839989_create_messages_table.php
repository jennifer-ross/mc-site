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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
			$table->foreignId('chat_id')->constrained('chats')->onDelete('cascade');
			$table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
			$table->enum('type', ['voice_call', 'text'])->default('text');
			$table->json('content')->nullable();
			$table->foreignId('attachment_id')->nullable()->constrained('message_attachments')->onDelete('set null');
            $table->boolean('is_hidden')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_edited')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
