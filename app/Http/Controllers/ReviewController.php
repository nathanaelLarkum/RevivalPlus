<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Church;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review for a specific church.
     */
    public function store(StoreReviewRequest $request, Church $church)
    {
        // The validated data comes from our FormRequest
        $validated = $request->validated();

        // Create the review and associate it with the church and authenticated user
        $church->reviews()->create([
            'user_id' => Auth::id(),
            'rating' => $validated['rating'],
            'title' => $validated['title'],
            'body' => $validated['body'],
            // Status will default to 'pending' as defined in the migration
        ]);

        return back()->with('success', 'Thank you! Your review has been submitted for approval.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        // Authorization: Ensure the user deleting the review is the one who wrote it, or an admin.
        // This is a perfect place for a Policy.
        $this->authorize('delete', $review);

        $review->delete();

        return back()->with('success', 'Your review has been deleted.');
    }
}
