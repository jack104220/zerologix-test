<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticleFavoriteRepository;
use Exception;

class ArticleService
{
    public function __construct(
        protected ArticleRepository $articleRepo,
        protected ArticleFavoriteRepository $articleFavoriteRepo
    ) {}

    /**
     * 查詢單個文章
     *
     * @param integer $articleId
     * @return array
     */
    public function show(int $articleId)
    {
        $article = $this->articleRepo->getDetailById($articleId);
        if (empty($article)) {
            throw new Exception('文章不存在');
        }

        return $article->toArray();
    }

    /**
     * 建立文章
     *
     * @param integer $userId
     * @param string $content
     * @return array
     */
    public function create(int $userId, string $content)
    {
        $data = [
            'user_id' => $userId,
            'content' => $content
        ];

        $article = $this->articleRepo->insert($data);
        return [
            'message' => 'success',
            'article_id' => $article->id,
        ];
    }

    /**
     * 修改文章
     *
     * @param integer $userId
     * @param integer $articleId
     * @param string $content
     * @return array
     */
    public function update(int $userId, int $articleId, string $content)
    {
        $article = $this->articleRepo->getArticleByIdAndUserId($articleId, $userId);
        if (empty($article)) {
            throw new Exception('文章不存在');
        }

        $article->content = $content;
        $article->save();

        return [
            'message' => 'success',
            'article_id' => $article->id,
        ];
    }

    /**
     * 刪除文章
     *
     * @param integer $userId
     * @param integer $articleId
     * @return array
     */
    public function delete(int $userId, int $articleId)
    {
        $article = $this->articleRepo->getArticleByIdAndUserId($articleId, $userId);
        if (empty($article)) {
            throw new Exception('文章不存在');
        }

        $article->delete();

        return [
            'message' => 'success'
        ];
    }

    /**
     * 最愛
     *
     * @param int $userId
     * @param int $articleId
     * @return array
     */
    public function favorite(int $userId, int $articleId)
    {
        $article = $this->articleRepo->getArticleById($articleId);
        if (empty($article)) {
            throw new Exception('文章不存在');
        }

        $check = $this->articleFavoriteRepo->getFavorite($userId, $articleId);
        if (empty($check)) {
            $this->articleFavoriteRepo->insert(['user_id' => $userId, 'article_id' => $articleId]);
            return ['message' => 'favorited'];
        }

        $this->articleFavoriteRepo->delFavorite($userId, $articleId);
        return ['message' => 'unfavorited'];
    }

    /**
     * 分享文章
     *
     * @param int $userId
     * @param int $articleId
     * @param string $content
     * @return array
     */
    public function share(int $userId, int $articleId, string $content)
    {
        $data = [
            'user_id' => $userId,
            'from_article' => $articleId,
            'content' => $content
        ];

        $article = $this->articleRepo->insert($data);
        return [
            'message' => 'success',
            'article_id' => $article->id,
        ];
    }
}