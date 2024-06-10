<?php

namespace App\Http\Controllers;

use App\Models\ManegerBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs.index');
    }
    public function getData()
    {
        $vendor_id = Auth::guard('admins')->id();
        $blogs = ManegerBlog::where('vendor_id', $vendor_id)->with('vendor')->get();
        foreach ($blogs as $post) {
            if ($post->blog_media) {
                $post->post_image_url = asset($post->blog_media);
            } else {
                $post->post_image_url = null;
            }
        }
        return response()->json($blogs);
    }

    public function update(Request $request)
    {
        $post = ManegerBlog::find($request->id);
        // dd($request->all());
        $post->content = $request->post_content;
        if ($request->hasFile('post_media') && $request->file('post_media')->isValid()) {
            $file = $request->file('post_media');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('blog_media'), $fileName);
            $mediaPath = 'blog_media/' . $fileName;
            $post->blog_media = $mediaPath;
        }
        $post->save();
        return response()->json(['success' => 'Blog updated successfully.']);
    }

    public function delete(Request $request)
    {
        ManegerBlog::destroy($request->id);
        return response()->json(['success' => 'Blog deleted successfully.']);
    }

    public function status(Request $request)
    {
        $post = ManegerBlog::find($request->id);
        $post->status = $request->status;
        $post->save();
        return response()->json(['success' => 'Blog status updated successfully.']);
    }

}
