<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentReply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|string|exists:posts,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $data = [];
        $baseURL = 'https://bmdublog.com/solutionkey/public/';
        $comments = Comment::where('post_id', $request->post_id)->latest()->get();
        $comments->each(function ($comment) use (&$baseURL, &$data) {
            $data[] = [
                'id' => $comment->id,
                'comment_user_name' => $comment->commentUser->name,
                'profile' => $baseURL . $comment->commentUser->profile_pic,
                'comment' => $comment->content,
                'created_time' => Carbon::parse($comment->created_at)->diffForHumans(),
            ];
        });
        if ($comments->isEmpty()) {
            return response()->json(['message' => 'Comment not Have.'], Response::HTTP_OK);
        }
        return response()->json(['comments' => $data], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'comment_id' => 'required|string|exists:comments,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $login = Auth::id();
        $commentUser = Comment::findOrfail($request->comment_id);
        $reply = CommentReply::create([
            'vendor_id' => $login,
            'comment_id' => $request->comment_id,
            'customer_id' => $commentUser->comment_user_id,
            'post_id' => $commentUser->post_id,
            'reply' => $request->content,
        ]);
        return response()->json(['message' => 'Comment Reply Successfully.', 'reply' => $reply], Response::HTTP_CREATED);
    }
}
