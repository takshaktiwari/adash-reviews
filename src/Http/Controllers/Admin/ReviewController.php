<?php

namespace Takshak\Areviews\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Takshak\Areviews\Actions\ReviewAction;
use Takshak\Areviews\Models\Areviews\Review;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::latest()->paginate(100);
        return View::first(['admin.reviews.categories.index', 'areviews::admin.reviews.index'])
            ->with([
                'reviews'   =>  $reviews
            ]);
    }

    public function show(Review $review)
    {
        return View::first(['admin.reviews.categories.show', 'areviews::admin.reviews.show'])
            ->with([
                'review'   =>  $review
            ]);
    }

    public function edit(Review $review)
    {
        return View::first(['admin.reviews.categories.edit', 'areviews::admin.reviews.edit'])
            ->with([
                'review'   =>  $review
            ]);
    }

    public function update(Review $review, Request $request, ReviewAction $action)
    {
        $validated = $action->validate($request);
        $review->update($validated + ['status' => $request->boolean('status')]);

        $route = $request->post('redirect') ? $request->post('redirect') : url()->previous();
        return redirect($route)->withSuccess('Review has been successfully updated');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->withSuccess('Review has been successfully deleted');
    }

    public function statusToggle(Review $review)
    {
        $review->status = !$review->status;
        $review->save();

        return back();
    }
}
