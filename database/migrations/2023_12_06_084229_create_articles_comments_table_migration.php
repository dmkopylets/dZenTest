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
            $table->foreignId('article_id')->constrained(); // article_id може бути пустим
            $table->foreignId('user_id')->constrained();
            $table->integer('parent_id')->nullable();
            $table->integer('position')->nullable();
            $table->text('body');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_id')
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
