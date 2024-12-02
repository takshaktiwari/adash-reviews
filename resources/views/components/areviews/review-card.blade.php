<div class="card review">
    <div class="card-body">
        <div class="user d-flex mb-3">
            <div class="user-icon me-2 my-auto">
                <img src="{{ $review->avatarUrl() }}" alt="user icon" class="rounded-circle">
            </div>
            <div class="user-detail flex-fill my-auto">
                <div class="d-flex justify-content-between gap-2">
                    <div class="flex-fill">
                        <h6 class="mb-0">{{ $review->name }}</h6>
                        <div class="rating">
                            @for ($i = 1; $i <= $review->rating; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            @for ($i = 1; $i <= 5 - $review->rating; $i++)
                                <i class="fa-regular fa-star"></i>
                            @endfor
                        </div>
                    </div>
                    <div class="mt-auto">
                        <p class="small mb-0 fst-italic">
                            {{ $review->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <h6>{{ $review->title }}</h6>
        <p class="small mb-0">{{ $review->content }}</p>
    </div>
</div>
