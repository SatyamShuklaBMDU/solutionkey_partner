<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ManegerBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'blog_media' => 'required|file',
                'blog_media.*' => 'mimetypes:image/jpeg,image/png,video/mp4',
                'content' => 'required|string',
            ]);
            if ($request->hasFile('blog_media') && $request->file('blog_media')->isValid()) {
                $file = $request->file('blog_media');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('blog_media'), $fileName);
                $mediaPath = 'blog_media/' . $fileName;
            }
            $blog = ManegerBlog::create([
                'vendor_id' => Auth::id(),
                'blog_media' => $mediaPath ?? null,
                'content' => $request->content,
                'status' => '0',
            ]);
            return response()->json(['message' => 'Blog registered successfully', 'blog' => $blog], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to register blog', 'message' => $e->getMessage()], 500);
        }
    }
}
