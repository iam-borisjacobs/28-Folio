<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject')->nullable();
            $table->longText('message');
            $table->string('status')->default('new'); // new, contacted
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });

        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            $table->string('notification_email');
            $table->string('success_message');
            $table->boolean('auto_reply_enabled')->default(false);
            $table->text('auto_reply_message')->nullable();
            $table->timestamps();
        });

        // Seed default settings
        DB::table('contact_settings')->insert([
            'notification_email' => 'admin@example.com',
            'success_message' => 'Thank you for your message. We will get back to you shortly.',
            'auto_reply_enabled' => false,
            'auto_reply_message' => "Hi,\n\nThanks for reaching out! We've received your message and will be in touch soon.\n\nBest regards,\nThe Team",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_settings');
        Schema::dropIfExists('leads');
    }
};
