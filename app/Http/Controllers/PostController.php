<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function getData()
    {
        $vendor_id = Auth::guard('admins')->id();
        $posts = Post::where('vendor_id', $vendor_id)->with('vendor')->get();
        foreach ($posts as $post) {
            if ($post->post_image) {
                $post->post_image_url = asset('images/posts/' . $post->post_image);
            } else {
                $post->post_image_url = null;
            }
        }
        return response()->json($posts);
    }

    public function update(Request $request)
    {
        $post = Post::find($request->id);
        $post->content = $request->post_content;
        if ($request->hasFile('post_media') && $request->file('post_media')->isValid()) {
            $image = $request->file('post_media');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/posts'), $imageName);
            $post->post_image = $imageName;
        }
        $post->save();
        return response()->json(['success' => 'Post updated successfully.']);
    }

    public function delete(Request $request)
    {
        Post::destroy($request->id);
        return response()->json(['success' => 'Post deleted successfully.']);
    }

    public function status(Request $request)
    {
        $post = Post::find($request->id);
        $post->status = $request->status;
        $post->save();
        return response()->json(['success' => 'Post status updated successfully.']);
    }
}
