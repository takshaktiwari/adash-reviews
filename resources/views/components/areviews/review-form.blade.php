@if ($display)
    <div class="card border-0 shadow-sm rounded-4">
        @if ($header)
            <div class="card-header bg-transparent border-0 px-4 pt-4 pb-0">
                <h5 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-pk-purple"></i>
                    {{ $header }}
                </h5>
            </div>
        @endif
        <div class="card-body p-4">
            <form action="{{ $url }}" method="POST">
                @csrf
                @method($method)

                {{-- Star Rating --}}
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Your Rating <span class="text-danger">*</span></label>
                    <div class="pk-star-rating d-flex flex-row-reverse justify-content-end gap-1">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" name="rating" id="pk-star-{{ $i }}" value="{{ $i }}"
                                class="d-none pk-star-input"
                                {{ $review?->rating == $i ? 'checked' : '' }}>
                            <label for="pk-star-{{ $i }}" class="pk-star-label" title="{{ $i }} star">
                                <i class="bi bi-star-fill"></i>
                            </label>
                        @endfor
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-muted">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control login-input rounded-3"
                            value="{{ old('name', $review?->name ?? auth()->user()?->name) }}" required>
                    </div>

                    @if (config('areviews.fields.mobile.display', true))
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">
                                Mobile
                                @if (config('areviews.fields.mobile.required', true))
                                    <span class="text-danger">*</span>
                                @endif
                            </label>
                            <input type="tel" name="mobile" class="form-control login-input rounded-3"
                                value="{{ old('mobile', $review?->mobile ?? auth()->user()?->mobile) }}"
                                {{ config('areviews.fields.mobile.required', true) ? 'required' : '' }}>
                        </div>
                    @endif

                    @if (config('areviews.fields.email.display', true))
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">
                                Email
                                @if (config('areviews.fields.email.required', true))
                                    <span class="text-danger">*</span>
                                @endif
                            </label>
                            <input type="email" name="email" class="form-control login-input rounded-3"
                                value="{{ old('email', $review?->email ?? auth()->user()?->email) }}"
                                {{ config('areviews.fields.email.required', true) ? 'required' : '' }}>
                        </div>
                    @endif

                    @if ($addStatus)
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select login-input rounded-3" required>
                                <option value="">-- Select --</option>
                                <option value="1" @selected(old('status', $review?->status) == '1')>Active</option>
                                <option value="0" @selected(old('status', $review?->status) == '0')>Inactive</option>
                            </select>
                        </div>
                    @endif

                    @if (config('areviews.fields.title.display', true))
                        <div class="col-12">
                            <label class="form-label small fw-bold text-muted">
                                Review Title
                                @if (config('areviews.fields.title.required', true))
                                    <span class="text-danger">*</span>
                                @endif
                            </label>
                            <input type="text" name="title" class="form-control login-input rounded-3"
                                value="{{ old('title', $review?->title) }}"
                                {{ config('areviews.fields.title.required', true) ? 'required' : '' }}>
                        </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label small fw-bold text-muted">Review <span class="text-danger">*</span></label>
                        <textarea name="content" rows="4" class="form-control login-input rounded-3" required>{{ old('content', $review?->content) }}</textarea>
                    </div>
                </div>

                <input type="hidden" name="reviewable_type" value="{{ get_class($model) }}">
                <input type="hidden" name="reviewable_id" value="{{ $model->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="redirect" value="{{ $redirect }}">

                <div class="mt-4">
                    <button type="submit" class="btn btn-pk-purple px-4 rounded-3 fw-bold">
                        <i class="bi bi-send me-1"></i> Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>

    @once
        @push('styles')
            <style>
                .pk-star-rating .pk-star-label {
                    font-size: 1.6rem;
                    color: #ccc;
                    cursor: pointer;
                    transition: color .15s;
                }
                .pk-star-rating .pk-star-input:checked ~ .pk-star-label,
                .pk-star-rating .pk-star-label:hover,
                .pk-star-rating .pk-star-label:hover ~ .pk-star-label {
                    color: #f5c518;
                }
            </style>
        @endpush
    @endonce
@endif
