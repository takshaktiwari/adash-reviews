<?php

namespace Takshak\Areviews\View\Components\Areviews;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class ReviewForm extends Component
{
    public function __construct(
        public $model,
        public $review = null,
        public $url = null,
        public $method = 'POST',
        public $redirect = null
    ) {
        if(!$this->url){
            $this->url = route('review.store');
        }
    }

    public function render()
    {
        return View::first(['components.areviews.review-form', 'areviews::components.areviews.review-form']);
    }
}
