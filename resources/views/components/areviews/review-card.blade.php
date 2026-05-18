<div class="card border-0 shadow-sm rounded-4 h-100">
    <div class="card-body p-4 d-flex flex-column">

        {{-- Author row --}}
        <div class="d-flex align-items-center gap-3 mb-3">
            <img src="{{ $review->avatarUrl() }}" alt="{{ $review->name }}"
                class="rounded-circle flex-shrink-0" width="46" height="46" style="object-fit:cover;">
            <div class="flex-fill overflow-hidden">
                <div class="fw-bold small text-truncate lh-sm">{{ $review->name }}</div>
                <div class="text-muted" style="font-size:0.7rem;">{{ $review->created_at->diffForHumans() }}</div>
            </div>
            @if ($deleteBtn)
                <form method="POST" action="{{ route('review.destroy', $review) }}" class="flex-shrink-0"
                    onsubmit="return confirm('Delete this review?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle p-0 d-flex align-items-center justify-content-center"
                        style="width:36px;height:36px;" title="Delete review">
                        <i class="bi bi-trash3" style="font-size:0.85rem;"></i>
                    </button>
                </form>
            @endif
        </div>

        {{-- Star rating --}}
        <div class="d-flex gap-1 mb-3">
            @for ($i = 1; $i <= 5; $i++)
                <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"
                    style="font-size:0.875rem;"></i>
            @endfor
        </div>

        {{-- Content --}}
        <div class="border-start border-3 border-warning ps-3 flex-fill">
            @if ($review->title)
                <p class="fw-semibold small mb-1 lh-sm">{{ $review->title }}</p>
            @endif
            <p class="small text-secondary mb-0" style="line-height:1.65;">{{ $review->content }}</p>
        </div>

    </div>
</div>
