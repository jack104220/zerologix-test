<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;
use Exception;

class ArticleController extends Controller
{
    public function __construct(protected ArticleService $service) {}

    public function index(Request $request)
    {

    }

    /**
     * 建立文章
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'content' => 'required',
            ]);

            $response = $this->service->create($request->input('user_id'), $data['content']);
            return response()->json($response); 
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show(Request $request)
    {

    }

    /**
     * 修改文章
     *
     * @param Request $request
     * @param int $articleId
     * @return array
     */
    public function update(Request $request, $articleId)
    {
        try {
            $data = $request->validate([
                'content' => 'required',
            ]);

            $response = $this->service->update($request->input('user_id'), (int) $articleId, $data['content']);
            return response()->json($response); 
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * 刪除文章
     *
     * @param Request $request
     * @param int $articleId
     * @return string
     */
    public function destroy(Request $request, $articleId)
    {
        try {
            $response = $this->service->delete($request->input('user_id'), (int) $articleId);
            return response()->json($response); 
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * 文章最愛
     *
     * @param Request $request
     * @param int $articleId
     * @return string
     */
    public function favorite(Request $request, $articleId)
    {
        try {
            $response = $this->service->favorite($request->input('user_id'), $articleId);
            return response()->json($response); 
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * 分享文章
     *
     * @param Request $request
     * @param int $articleId
     * @return string
     */
    public function share(Request $request, $articleId)
    {
        try {
            $data = $request->validate([
                'content' => 'required',
            ]);

            $response = $this->service->share($request->input('user_id'), $articleId, $data['content']);
            return response()->json($response); 
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}