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
        public $paginate = false
    ) {
        if (!$this->reviews) {
            $query = Review::query()
                ->when($this->model, function ($query) {
                    $query->where('reviewable_type', get_class($this->model));
                    $query->where('reviewable_id', $this->model->id);
                })
                ->when(config('areviews.status.show_only', 'active') == 'active', function($query){
                    $query->where('status', true);
                })
                ->when(config('areviews.status.show_only', 'active') == 'inactive', function($query){
                    $query->where('status', false);
                })
                ->latest();

            if ($this->paginate) {
                $query = $query->paginate($this->limit);
            } else {
                $query = $query->limit($limit)->get();
            }

            $this->reviews = $query;
        }else{
            $this->reviews = $this->reviews->take($limit);
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
