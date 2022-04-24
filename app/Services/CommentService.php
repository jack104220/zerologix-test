<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use App\Repositories\ArticleRepository;
use App\Repositories\CommentRepository;
use App\Repositories\CommentFavoriteRepository;
use Exception;

class CommentService
{
    public function __construct(
        protected ArticleRepository $articleRepo,
        protected CommentRepository $commentRepo,
        protected CommentFavoriteRepository $commentFavoriteRepo
    ) {}

    public function show($commentId)
    {
        $comment = $this->commentRepo->getDetailById($commentId);
        if (empty($comment)) {
            throw new Exception('回覆不存在');
        }

        return $comment->toArray();
    }

    /**
     * 建立回覆
     *
     * @param integer $userId
     * @param integer $articleId
     * @param string $content
     * @return array
     */
    public function create(int $userId, int $articleId, string $content)
    {
        $article = $this->articleRepo->getArticleById($articleId);
        if (empty($article)) {
            throw new Exception('文章不存在');
        }

        $data = [
            'user_id' => $userId,
            'article_id' => $articleId,
            'content' => $content
        ];

        $comment = $this->commentRepo->insert($data);
        return [
            'message' => 'success',
            'comment_id' => $comment->id,
        ];
    }

    /**
     * 修改回覆
     *
     * @param integer $userId
     * @param integer $commentId
     * @param string $content
     * @return array
     */
    public function update(int $userId, int $commentId, string $content)
    {
        $comment = $this->commentRepo->getCommentByIdAndUserId($commentId, $userId);
        if (empty($comment)) {
            throw new Exception('回覆不存在');
        }

        $comment->content = $content;
        $comment->save();

        return [
            'message' => 'success',
            'comment_id' => $comment->id,
        ];
    }

    /**
     * 刪除回覆
     *
     * @param integer $userId
     * @param integer $commentId
     * @return array
     */
    public function delete(int $userId, int $commentId)
    {
        $comment = $this->commentRepo->getCommentByIdAndUserId($commentId, $userId);
        if (empty($comment)) {
            throw new Exception('回覆不存在');
        }

        $comment->delete();

        return [
            'message' => 'success'
        ];
    }

    /**
     * 最愛
     *
     * @param int $userId
     * @param int $commentId
     * @return array
     */
    public function favorite(int $userId, int $commentId)
    {
        $comment = $this->commentRepo->getCommentById($commentId);
        if (empty($comment)) {
            throw new Exception('回覆不存在');
        }

        $check = $this->commentFavoriteRepo->getFavorite($userId, $commentId);
        if (empty($check)) {
            $this->commentFavoriteRepo->insert(['user_id' => $userId, 'comment_id' => $commentId]);
            return ['message' => 'favorited'];
        }

        $this->commentFavoriteRepo->delFavorite($userId, $commentId);
        return ['message' => 'unfavorited'];
    }

}