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
        Schema::table('ratings', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->integer('score');
            $table->text('comment')->nullable();
            $table->dateTime('rating_date')->useCurrent();
            $table->foreignId('reply_id')->nullable()->constrained('ratings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['service_id']);
            $table->dropForeign(['reply_id']);
            $table->dropColumn(['user_id', 'service_id', 'score', 'comment', 'rating_date', 'reply_id']);
        });
    }
};