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
            $table->foreignId('article_id')->nullable()->constrained(); // article_id може бути пустим
            $table->foreignId('user_id')->constrained();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('position', false, true);
            $table->text('body');
            $table->softDeletes();

            $table->foreign('parent_id')
                ->references('id')
                ->on('articles_comments')
                ->onDelete('set null');

        });

        Schema::create('articles_comments_closure', function (Blueprint $table) {
            $table->increments('closure_id');

            $table->integer('ancestor', false, true);
            $table->integer('descendant', false, true);
            $table->integer('depth', false, true);

            $table->foreign('ancestor')
                ->references('id')
                ->on('articles_comments')
                ->onDelete('cascade');

            $table->foreign('descendant')
                ->references('id')
                ->on('articles_comments')
                ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('articles_comments_closure');
        Schema::dropIfExists('articles_comments');
    }
}
