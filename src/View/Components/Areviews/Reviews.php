<?php

namespace Takshak\Areviews\View\Components\Areviews;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;
use Takshak\Areviews\Models\Areviews\Review;

class Reviews extends Component
{
    public function __construct(
        public $reviews = null,
        public $model = null,
        public $limit = 10,
        public $column = null,
        public $paginate = false,
        public $addReview = true,
        public $reviewStats = true,
        public $avgRating = null,
        public $countReviews = null,
    ) {
        if (!$this->reviews) {
            $query = Review::query()
                ->active()
                ->when($this->model, function ($query) {
                    $query->where('reviewable_type', get_class($this->model));
                    $query->where('reviewable_id', $this->model->id);
                })
                ->when(config('areviews.status.show_only', 'active') == 'active', function ($query) {
                    $query->where('status', true);
                })
                ->when(config('areviews.status.show_only', 'active') == 'inactive', function ($query) {
                    $query->where('status', false);
                })
                ->when(in_array(request('reviews_rating'), ['1', '2', '3', '4', '5']), function ($query) {
                    $query->where('rating', request('reviews_rating'));
                })
                ->when(request('reviews_order') == 'latest', function ($query) {
                    $query->latest();
                })
                ->when(request('reviews_order') == 'oldest', function ($query) {
                    $query->oldest();
                })
                ->when(request('reviews_order') == 'rating_asc', function ($query) {
                    $query->orderBy('rating', 'asc');
                })
                ->when(request('reviews_order') == 'rating_desc', function ($query) {
                    $query->orderBy('rating', 'desc');
                })
                ->latest();

            if ($this->paginate) {
                $query = $query->paginate($this->limit);
            } else {
                $query = $query->limit($limit)->get();
            }

            $this->reviews = $query;
        } else {
            $this->reviews = $this->reviews->take($limit);
        }

        if ($this->avgRating == null) {
            if ($this->model) {
                $this->avgRating = Review::query()
                    ->active()
                    ->where('reviewable_type', get_class($this->model))
                    ->where('reviewable_id', $this->model->id)
                    ->avg('rating');
            } else {
                $this->avgRating = 0.0;
            }
        }

        if ($this->countReviews == null) {
            if ($this->model) {
                $this->countReviews = Review::query()
                    ->active()
                    ->where('reviewable_type', get_class($this->model))
                    ->where('reviewable_id', $this->model->id)
                    ->count();
            } else {
                $this->countReviews = 0;
            }
        }

        if (!$this->column) {
            $this->column = config('areviews.reviews.list.columns', 'col-lg-4 col-md-6');
        }
    }

    public function render()
    {
        return View::first(['components.areviews.reviews', 'areviews::components.areviews.reviews']);
    }
}
