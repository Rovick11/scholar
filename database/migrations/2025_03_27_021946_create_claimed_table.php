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
        Schema::create('claimed', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Assuming users table exists
            $table->double('amount');
            $table->timestamp('claimed_at');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migratdatabase/migrations/2025_03_18_063821_create_notifications_table.phpions.
     */
    public function down(): void
    {
        Schema::dropIfExists('claimed');
    }
};
