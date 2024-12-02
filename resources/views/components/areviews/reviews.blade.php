<div class="reviews mb-4">
    <div class="reviews_sec_header d-flex justify-content-between gap-3 flex-wrap mb-3">
        <div class="flex-fill">
            <h4 class="fw-bold mb-0">Ratings & Reviews</h4>
            <div class="reviews_sec_header_info">
                <span class="badge bg-warning my-auto text-dark">
                    {{ round($avgRating, 1) }} <i class="fas fa-star"></i>
                </span>
                <span class="reviews_sec_header_count">{{ $countReviews }} Reviews</span>
            </div>
        </div>
        @if ($addReview)
            <div class="my-auto">
                <a href="javascript:void(0)" class="btn btn-primary reviews_add_btn" data-bs-toggle="collapse"
                    data-bs-target=".reviews .add_review_form">
                    <i class="fas fa-plus"></i> Add Review
                </a>
            </div>
        @endif
    </div>

    @if ($addReview)
        <div class="add_review_form collapse mb-4">
            <x-areviews-areviews:review-form :model="$model" header="" />
        </div>
    @endif

    @if ($reviewStats)
        <div class="reviews_stats_sec">
            <x-areviews-areviews:reviews-stats :model="$model" :avgRating="$avgRating" :countReviews="$countReviews" />
        </div>
    @endif

    <div class="row gy-4 gx-2" data-masonry='{"percentPosition": true }'>
        @foreach ($reviews as $review)
            <div class="{{ $column }}">
                <x-areviews-areviews:review-card :review="$review" />
            </div>
        @endforeach
    </div>

    @if (method_exists($reviews, 'links'))
        <div class="mt-5">
            {{ $reviews->links() }}
        </div>
    @endif
</div>

@once
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .reviews .review .user-icon img {
                width: 55px;
            }

            .reviews .review .rating i {
                color: rgb(185, 185, 16);
            }
        </style>
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
            integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
        </script>
    @endpush
@endonce
