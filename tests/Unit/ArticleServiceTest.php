<?php

namespace Tests\Unit;

use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

use App\Repositories\ArticleRepository;
use App\Repositories\ArticleFavoriteRepository;
use App\Services\ArticleService;

class ArticleServiceTest extends TestCase
{
    public function setUp() :void
    {
        parent::setUp();
        $this->articleRepo = $this->initMock(ArticleRepository::class);
        $this->articleFavoriteRepo = $this->initMock(ArticleFavoriteRepository::class);
    }

    /**
     * 測試文章
     *
     * @return void
     */
    public function testArticleList()
    {
        $object = collect(['empty']);
        $this->articleRepo->shouldReceive('getList')->once()->withAnyArgs()->andReturn((object) $object);

        $service = app(ArticleService::class);
        $this->assertEquals($service->list(), $object->toArray());
    }

    /**
     * 測試文章取消最愛
     *
     * @return void
     */
    public function testArticleFavorite()
    {
        $userId = 1;
        $articleId = 2;
        $this->articleRepo->shouldReceive('getArticleById')->once()->with($articleId)->andReturn(['ok']);
        $this->articleFavoriteRepo->shouldReceive('getFavorite')->once()->with($userId, $articleId)->andReturn(['ok']);
        $this->articleFavoriteRepo->shouldReceive('delFavorite')->once()->with($userId, $articleId)->andReturn(['ok']);

        $service = app(ArticleService::class);
        $this->assertEquals($service->favorite($userId, $articleId), ['message' => 'unfavorited']);
    }

    /**
     * 測試文章最愛
     *
     * @return void
     */
    public function testArticleUnfavorite()
    {
        $userId = 1;
        $articleId = 2;
        $this->articleRepo->shouldReceive('getArticleById')->once()->with($articleId)->andReturn(['ok']);
        $this->articleFavoriteRepo->shouldReceive('getFavorite')->once()->with($userId, $articleId)->andReturn(null);
        $this->articleFavoriteRepo->shouldReceive('insert')->once()->withAnyArgs()->andReturn(['ok']);

        $service = app(ArticleService::class);
        $this->assertEquals($service->favorite($userId, $articleId), ['message' => 'favorited']);
    }

    public function initMock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);
        return $mock;
    }
}
