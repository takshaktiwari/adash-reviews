<?php

namespace Takshak\Areviews\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Takshak\Areviews\Actions\ReviewAction;
use Takshak\Areviews\Models\Areviews\Review;

class ReviewController extends Controller
{
    public function store(Request $request, ReviewAction $action)
    {
        $validated = $action->validate($request);
        Review::create($validated + ['status' => config('areviews.status.default', true)]);

        $route = $request->post('redirect') ? $request->post('redirect') : url()->previous();
        return redirect($route)->withSuccess('Thank You, Your review has been posted.');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $review->delete();
        return back()->withSuccess('Your review has been deleted.');
    }
}
