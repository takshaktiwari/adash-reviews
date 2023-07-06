<div class="reviews mb-4">
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
                width: 60px;
            }

            .reviews .review .rating i {
                color: rgb(238, 238, 4);
            }
        </style>
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
            integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
        </script>
    @endpush
@endonce
