<div class="card reviews-stats mb-4" id="reviews-stats">
    <div class="card-body">
        <div class="row g-0">
            <div class="col-sm-4 col-lg-3 my-auto">
                <div class="stats_left p-4">
                    <h4 class="mb-0 fw-bold text-center text-nowrap">
                        <span>{{ round($avgRating, 1) }}</span>
                        <i class="fa-solid fa-star"></i>
                    </h4>
                    <p class="mb-0 text-center text-nowrap">{{ $countReviews }} Reviews</p>
                </div>
            </div>
            <div class="col-sm-8 col-lg-9">
                @foreach ($stats as $key => $stat)
                    <div class="d-flex gap-2">
                        <div class="digits fw-bold">{{ $key }}</div>
                        <div class="flex-fill">
                            <div class="progress my-1 bg-light">
                                <div @class([
                                    'stats_progress',
                                    'progress-bar',
                                    'bg-success' => in_array($key, [5, 4]),
                                    'bg-warning text-dark' => in_array($key, [3, 2]),
                                    'bg-secondary' => $key == 1,
                                ]) id="{{ 'stats_progress_' . $key }}"
                                    data-rating="{{ $key }}" role="progressbar"
                                    style="width: {{ $stat['percentage'] }}%;" aria-valuenow="75" aria-valuemin="0"
                                    aria-valuemax="100">
                                    {{ $stat['count'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@once
    @push('styles')
        <style>
            .reviews-stats {
                background-color: #e5e5e5;
            }

            .reviews-stats .progress {
                height: 0.85rem;
            }

            .reviews-stats .progress:hover{
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                background-color: #fff;
                cursor: pointer;
            }
        </style>
    @endpush
@endonce
