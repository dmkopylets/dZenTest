<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTableMigration extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->unsignedBigInteger('article_id', false);
            #$table->foreignId('article_id')->constrained();
            $table->unsignedBigInteger('user_id', false);
            #$table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('parent_id', false)->nullable();
            $table->integer('position')->nullable()->default(0);
            $table->longText('body');
            $table->softDeletes();
            $table->timestamps();

            $table->index('id', 'comment_idx');

            $table->foreign('article_id', 'comment_fk')
                ->references('id')
                ->on('articles')
                ->onDelete('set null');

            $table->foreign('user_id', 'comment_user_fk')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('parent_id', 'comment_parent_fk')
                ->references('id')
                ->on('comments')
                ->onDelete('set null');

        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
