<?php

namespace Takshak\Areviews\View\Components\Areviews;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;
use Takshak\Areviews\Models\Areviews\Review;

class ReviewCard extends Component
{
    public function __construct(public $review)
    {
    }

    public function render()
    {
        return View::first(['components.areviews.review-card', 'areviews::components.areviews.review-card']);
    }
}
