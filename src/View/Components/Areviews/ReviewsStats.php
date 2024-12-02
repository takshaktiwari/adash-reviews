<?php

namespace Takshak\Areviews\View\Components\Areviews;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Illuminate\Support\Facades\View;
use Takshak\Areviews\Models\Areviews\Review;

class ReviewsStats extends Component
{
    public $stats;
    public $total;
    public function __construct(
        public $model,
        public $avgRating = null,
        public $countReviews = null
    ) {
        $this->stats = Review::groupBy('rating')
            ->active()
            ->select('rating', DB::raw('count(*) as count'))
            ->where('reviewable_type', get_class($this->model))
            ->where('reviewable_id', $this->model->id)
            ->orderBy('rating', 'DESC')
            ->get()
            ->pluck('count', 'rating');

        $this->total = $this->stats->sum();

        $this->stats = $this->stats->map(function ($item) {
            return [
                'count' => $item,
                'percentage' => round($item / $this->total * 100, 1)
            ];
        });

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
    }

    public function render()
    {
        return View::first(['components.areviews.reviews-stats', 'areviews::components.areviews.reviews-stats']);
    }
}
