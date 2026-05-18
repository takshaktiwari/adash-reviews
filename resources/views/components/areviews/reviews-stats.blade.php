<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <div class="row g-0 align-items-center">
            <div class="col-sm-3 text-center py-3 border-end">
                <div class="display-5 fw-bold text-pk-purple mb-0">{{ number_format($avgRating, 1) }}</div>
                <div class="d-flex justify-content-center gap-1 my-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}" style="font-size:0.85rem;"></i>
                    @endfor
                </div>
                <small class="text-muted">{{ $countReviews }} {{ Str::plural('review', $countReviews) }}</small>
            </div>
            <div class="col-sm-9 px-4 py-3">
                @foreach ($stats as $key => $stat)
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <small class="fw-bold text-muted" style="width:1.2rem;">{{ $key }}</small>
                        <i class="bi bi-star-fill text-warning" style="font-size:0.7rem;"></i>
                        <div class="flex-fill">
                            <div class="progress rounded-pill" style="height:8px;">
                                <div class="progress-bar rounded-pill {{ in_array($key, [5, 4]) ? 'bg-success' : (in_array($key, [3, 2]) ? 'bg-warning' : 'bg-secondary') }}"
                                    role="progressbar" style="width: {{ $stat['percentage'] }}%;">
                                </div>
                            </div>
                        </div>
                        <small class="text-muted" style="width:1.5rem;">{{ $stat['count'] }}</small>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
