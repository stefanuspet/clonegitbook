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
        Schema::create('list_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_block_id')->constrained()->onDelete('cascade');
            $table->enum('list_type', ['unordered', 'ordered', 'task']); // Jenis daftar: unordered, ordered, task
            $table->text('content');
            $table->boolean('completed')->default(false); // Hanya untuk tasklist
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_items');
    }
};
