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
        Schema::create('message_attachments', function (Blueprint $table) {
			$table->id();
			$table->foreignId('image_id')->constrained('media')->onDelete('cascade');
			$table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
			$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_attachments');
    }
};
