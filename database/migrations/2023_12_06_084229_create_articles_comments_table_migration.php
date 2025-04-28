<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateArticlesCommentsTableMigration extends Migration
{
    public function up()
    {
        Schema::create('articles_comments', function (Blueprint $table) {
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

            $table->index('id', 'comment_article_idx');
            #$table->index('comment_user_id', 'comment_user_idx');
            #$table->index('comment_parent_id', 'comment_parent_idx');

            $table->foreign('article_id', 'comment_article_fk')
                ->references('id')
                ->on('articles')
                ->onDelete('set null');

            $table->foreign('user_id', 'comment_user_fk')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('parent_id', 'comment_parent_fk')
                ->references('id')
                ->on('articles_comments')
                ->onDelete('set null');

        });
    }

    public function down()
    {
        Schema::dropIfExists('articles_comments');
    }
}
