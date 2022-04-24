<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    protected $seed = true;

    /**
     * 測試文章列表
     *
     * @return void
     */
    public function testArticleList()
    {
        $response = $this->get('/api/articles');

        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $response);
        $this->assertEquals(20, count($response['data']));
    }
}
