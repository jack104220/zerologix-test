<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommentService;
use Exception;

class CommentController extends Controller
{
    public function __construct(protected CommentService $service) {}

    /**
     * 建立回覆
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'article_id' => 'required',
                'content' => 'required',
            ]);

            $response = $this->service->create($request->input('user_id'), $data['article_id'], $data['content']);
            return response()->json($response); 
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * 查詢單個回覆
     *
     * @param Request $request
     * @param int $commentId
     * @return string
     */
    public function show(Request $request, $commentId)
    {
        try {
            $response = $this->service->show($commentId);
            return response()->json($response); 
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * 修改回覆
     *
     * @param Request $request
     * @param int $commentId
     * @return array
     */
    public function update(Request $request, $commentId)
    {
        try {
            $data = $request->validate([
                'content' => 'required',
            ]);

            $response = $this->service->update($request->input('user_id'), (int) $commentId, $data['content']);
            return response()->json($response); 
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * 刪除回覆
     *
     * @param Request $request
     * @param int $commentId
     * @return string
     */
    public function destroy(Request $request, $commentId)
    {
        try {
            $response = $this->service->delete($request->input('user_id'), (int) $commentId);
            return response()->json($response); 
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * 回覆最愛
     *
     * @param Request $request
     * @param int $commentId
     * @return string
     */
    public function favorite(Request $request, $commentId)
    {
        try {
            $response = $this->service->favorite($request->input('user_id'), $commentId);
            return response()->json($response); 
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

}
