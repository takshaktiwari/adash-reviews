<?php

namespace Takshak\Areviews\Traits\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Takshak\Areviews\Models\Areviews\Review;

trait ReviewModelTrait
{
    public function getRatingAttribute()
    {
        $this->loadAvg('reviews', 'rating');
        return $this->reviews_avg_rating ? round($this->reviews_avg_rating, 1) : 0;
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
