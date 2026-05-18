<div class="reviews-section">
    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap mb-4">
        <div>
            <h4 class="fw-bold mb-1">Ratings &amp; Reviews</h4>
            <div class="d-flex align-items-center gap-2">
                <div class="d-flex gap-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}" style="font-size:0.85rem;"></i>
                    @endfor
                </div>
                <span class="fw-bold">{{ number_format($avgRating, 1) }}</span>
                <span class="text-muted small">({{ $countReviews }} {{ Str::plural('review', $countReviews) }})</span>
            </div>
        </div>
        @if ($addReview)
            <button class="btn btn-outline-pk-purple rounded-3 fw-semibold" type="button"
                data-bs-toggle="collapse" data-bs-target="#pkAddReviewForm">
                <i class="bi bi-pencil-square me-1"></i> Write a Review
            </button>
        @endif
    </div>

    @if ($addReview)
        <div class="collapse mb-4" id="pkAddReviewForm">
            <x-areviews-areviews:review-form :model="$model" header="" />
        </div>
    @endif

    @if ($reviewStats && $countReviews > 0)
        <x-areviews-areviews:reviews-stats :model="$model" :avgRating="$avgRating" :countReviews="$countReviews" />
    @endif

    @if ($reviews->count() > 0)
        <div class="row g-4">
            @foreach ($reviews as $review)
                <div class="{{ $column }}">
                    <x-areviews-areviews:review-card :review="$review" />
                </div>
            @endforeach
        </div>

        @if (method_exists($reviews, 'links'))
            <div class="mt-4">
                {{ $reviews->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5 text-muted">
            <i class="bi bi-chat-square-text fs-1 d-block mb-2"></i>
            <p class="mb-0">No reviews yet. Be the first to share your experience!</p>
        </div>
    @endif
</div>
