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
        Review::create($validated);

        $route = $request->post('redirect') ? $request->post('redirect') : url()->previous();
        return redirect($route)->withSuccess('Thank You, Your review has been posted.');
    }
}
