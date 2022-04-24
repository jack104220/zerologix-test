<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Init extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 64)->unique()->comment('用戶名稱');
            $table->string('passwd', 64)->comment('密碼');
            $table->timestamps();
        });

        Schema::create('tbl_follow', function (Blueprint $table) {
            $table->bigInteger('user_id')->comment('用戶id');
            $table->bigInteger('follower_id')->comment('追蹤用戶id');
            $table->timestamps();

            $table->primary(['user_id', 'follower_id']);
            $table->index('follower_id', 'follower_id_index');
        });

        Schema::create('tbl_articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->comment('用戶id');
            $table->text('content')->comment('內容');
            $table->bigInteger('from_article')->default(0)->comment('文章來源id');
            $table->timestamps();

            $table->index('user_id', 'user_id_index');
        });

        Schema::create('tbl_article_favorite', function (Blueprint $table) {
            $table->bigInteger('user_id')->comment('用戶id');
            $table->bigInteger('article_id')->comment('文章id');
            $table->timestamps();

            $table->unique(['user_id', 'article_id']);
        });

        Schema::create('tbl_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('article_id')->comment('文章id');
            $table->bigInteger('user_id')->comment('用戶id');
            $table->text('content')->comment('內容');
            $table->timestamps();

            $table->index('user_id', 'user_id_index');
        });

        Schema::create('tbl_comment_favorite', function (Blueprint $table) {
            $table->bigInteger('user_id')->comment('用戶id');
            $table->bigInteger('comment_id')->comment('回覆id');
            $table->timestamps();

            $table->unique(['user_id', 'comment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_users');
        Schema::dropIfExists('tbl_follow');
        Schema::dropIfExists('tbl_articles');
        Schema::dropIfExists('tbl_article_favorite');
        Schema::dropIfExists('tbl_comments');
        Schema::dropIfExists('tbl_comment_favorite');
    }
}
