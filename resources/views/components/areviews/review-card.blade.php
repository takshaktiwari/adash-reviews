<div class="card review">
    <div class="card-body">
        <div class="user d-flex mb-3">
            <div class="user-icon me-2 my-auto">
                <img src="{{ $review->avatarUrl() }}" alt="user icon" class="rounded-circle">
            </div>
            <div class="user-detail my-auto">
                <h6 class="mb-1">{{ $review->name }}</h6>
                <div class="rating">
                    @for ($i = 1; $i <= $review->rating; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                    @for ($i = 1; $i <= 5 - $review->rating; $i++)
                        <i class="fa-regular fa-star"></i>
                    @endfor
                </div>
            </div>
        </div>
        <h6>{{ $review->title }}</h6>
        <p class="small mb-0">{{ $review->content }}</p>
    </div>
</div>
