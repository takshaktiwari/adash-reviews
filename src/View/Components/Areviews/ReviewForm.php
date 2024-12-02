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
        public $redirect = null,
        public $display = null,
        public $addStatus = false,
        public $header = 'Write A Review'
    ) {
        if(!$this->url){
            $this->url = route('review.store');
        }


        if($this->display == null)
        {
            $this->display = config('areviews.form.display', true);
        }
    }

    public function render()
    {
        return View::first(['components.areviews.review-form', 'areviews::components.areviews.review-form']);
    }
}
