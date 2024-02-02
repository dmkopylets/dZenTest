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
        Schema::create('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            #$table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('user_id', false);
            $table->string('title');
            $table->longText('body');
            $table->timestamps();

            $table->index('id', 'article_idx');

            $table->foreign('user_id', 'article_user_fk')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
