<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateArticlesCommentsTableMigration extends Migration
{
    public function up()
    {
        Schema::create('articles_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('position')->nullable()->default(0);
            $table->text('body');
            $table->softDeletes();
            $table->timestamps();

            $table->index('article_id', 'comment_article_idx');
            $table->index('article_id', 'comment_user_idx');
            $table->index('article_id', 'comment_parent_idx');

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
