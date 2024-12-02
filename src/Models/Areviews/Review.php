<?php

namespace Takshak\Areviews\Models\Areviews;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Review extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getReviewForAttribute()
    {
        return Str::of($this->reviewable_type)->afterLast('\\');
    }

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', true);
    }

    public function avatarUrl()
    {
        return route('imgr.placeholder', [
            'w' =>  150,
            'h' =>  150,
            'text'  =>  strtoupper(substr($this->name, 0, 2)),
            'text_size' => 60,
            'background'    =>  'rgb(' . rand(150, 250) . ', ' . rand(150, 250) . ', ' . rand(150, 250) . ')'
        ]);
    }
}
