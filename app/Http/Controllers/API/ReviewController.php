<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewReply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $login = Auth::id();
        $baseURL = 'https://bmdublog.com/solutionkey/public';
        $reviews = Review::where('vendor_id', $login)->with('customer')->latest()->get();
        $data = [];
        $reviews->each(function ($review) use (&$baseURL, &$data) {
            $data[] = [
                'review_id' => $review->id,
                'customer_name' => $review->customer->name,
                'customer_profile' => $baseURL . '/' . $review->customer->profile_pic,
                'review_content' => $review->content,
                'review_rating' => $review->rating,
                'review_created_time' => Carbon::parse($review->created_at)->diffForHumans(),
            ];
        });
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'content' => 'required|string',
            'review_id' => 'required|string|exists:reviews,id',
        ]);
        if ($validated->fails()) {
            return response()->json(['error' => $validated->messages()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $data = [];
        $login = Auth::id();
        $review = Review::find($request->review_id);
        if ($review->vendor_id != $login) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }
        $reviews = ReviewReply::create([
            'review_id' => $request->review_id,
            'reply' => $request->content,
            'vendor_id' => $login,
            'customer_id' => $review->customer_id,
        ]);
        $data[] = [
            'review_id' => $reviews->id,
            'vendor_name' => $reviews->vendor->name,
            'reply' => $reviews->reply,
            'reply_created_time' => Carbon::parse($reviews->created_at)->diffForHumans(),
        ];
        return response()->json($data);
    }
}
