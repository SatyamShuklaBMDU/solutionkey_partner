<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function store(Request $request)
    {
        try {
            $login = Auth::user();
            $validator = Validator::make($request->all(), [
                'content' => 'required|string',
                'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);
            if ($validator->fails()) {
                $response = ['status' => false];
                foreach ($validator->errors()->toArray() as $field => $messages) {
                    $response[$field] = $messages[0];
                }
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $post = new Post();
            $post->content = $request->input('content');
            $post->vendor_id = $login->id;
            if ($request->hasFile('post_image') && $request->file('post_image')->isValid()) {
                $image = $request->file('post_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/posts'), $imageName);
                $post->post_image = $imageName;
            }
            $post->save();
            return response()->json(['message' => 'Post created successfully', 'post' => $post], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request)
    {
        try {
            $post = Post::find($request->id);
            if (!$post) {
                return response()->json(['error' => 'Post not found'], Response::HTTP_NOT_FOUND);
            }
            $validator = Validator::make($request->all(), [
                'content' => 'required|string',
                'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($validator->fails()) {
                $response = ['status' => false];
                foreach ($validator->errors()->toArray() as $field => $messages) {
                    $response[$field] = $messages[0];
                }
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $post->content = $request->input('content');
            $post->vendor_id = Auth::id();
            if ($request->hasFile('post_image') && $request->file('post_image')->isValid()) {
                $image = $request->file('post_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/posts'), $imageName);
                $post->post_image = $imageName;
            }
            $post->save();
            return response()->json(['message' => 'Post updated successfully', 'post' => $post], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function allposts(Request $request)
    {
        try {
            $posts = Post::with('vendor')->get();
            $posturl = "https://bmdublog.com/SolutionkeyPartner/public/images/posts/";
            $postinarray = $posts->map(function ($post) use ($posturl) {
                return [
                    'id' => $post->id,
                    'vendor_name' => $post->vendor->name,
                    'post_image' => $posturl . $post->post_image,
                    'content' => $post->content,
                    'created_at' => $post->created_at,
                    'updated_at' => $post->updated_at,
                ];
            })->toArray();
            return response()->json(['message' => "All Posts", 'posts' => $postinarray], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
