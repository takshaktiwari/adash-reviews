<form action="{{ $url }}" class="card" method="POST">
    @csrf
    @method($method)
    <div class="card-header">
        <h5 class="my-auto">Write A Review</h5>
    </div>
    <div class="card-body">
        <div class="star_rating_inputs">
            <input class="star star-5" id="star-5" type="radio" value="5" name="rating" {{ ($review?->rating == 5) ? 'checked' : '' }} />
            <label class="star star-5" for="star-5"></label>
            <input class="star star-4" id="star-4" type="radio" value="4" name="rating" {{ ($review?->rating == 4) ? 'checked' : '' }} />
            <label class="star star-4" for="star-4"></label>
            <input class="star star-3" id="star-3" type="radio" value="3" name="rating" {{ ($review?->rating == 3) ? 'checked' : '' }} />
            <label class="star star-3" for="star-3"></label>
            <input class="star star-2" id="star-2" type="radio" value="2" name="rating" {{ ($review?->rating == 2) ? 'checked' : '' }} />
            <label class="star star-2" for="star-2"></label>
            <input class="star star-1" id="star-1" type="radio" value="1" name="rating" {{ ($review?->rating == 1) ? 'checked' : '' }} />
            <label class="star star-1" for="star-1"></label>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group mb-2">
                    <label for="">Name*</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $review?->name) }}" required>
                </div>
            </div>
            @if (config('areviews.fields.mobile.display', true))
                <div class="col">
                    <div class="form-group mb-2">
                        <label for="">
                            Mobile
                            @if (config('areviews.fields.mobile.required', true))
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        <input type="tel" name="mobile" class="form-control" value="{{ old('mobile', $review?->mobile) }}"
                            {{ config('areviews.fields.mobile.required', true) ? 'required' : '' }}>
                    </div>
                </div>
            @endif
            @if (config('areviews.fields.email.display', true))
                <div class="form-group mb-2">
                    <label for="">
                        Email
                        @if (config('areviews.fields.email.required', true))
                            <span class="text-danger">*</span>
                        @endif
                    </label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $review?->email) }}"
                        {{ config('areviews.fields.email.required', true) ? 'required' : '' }}>
                </div>
            @endif
            @if (config('areviews.fields.title.display', true))
                <div class="form-group mb-2">
                    <label for="">
                        Title
                        @if (config('areviews.fields.title.required', true))
                            <span class="text-danger">*</span>
                        @endif
                    </label>
                    <input name="title" cols="30" rows="3" class="form-control" value="{{ old('title', $review?->title) }}"
                        {{ config('areviews.fields.title.required', true) ? 'required' : '' }} />
                </div>
            @endif
            <div class="form-group mb-2">
                <label for="">Review*</label>
                <textarea name="content" cols="30" rows="3" class="form-control" required>{{ old('content', $review?->content) }}</textarea>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <input type="hidden" name="reviewable_type" value="{{ get_class($model) }}">
        <input type="hidden" name="reviewable_id" value="{{ $model->id }}">
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <input type="hidden" name="redirect" value="{{ $redirect }}">
        <button type="submit" class="btn btn-primary px-3">
            Submit
        </button>
    </div>
</form>
@once
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            div.star_rating_inputs {
                display: inline-block;
            }

            .star_rating_inputs input.star {
                display: none;
            }

            .star_rating_inputs label.star {
                float: right;
                padding: 10px;
                font-size: 36px;
                color: #444;
                transition: all .2s;
            }

            .star_rating_inputs input.star:checked~label.star:before {
                content: '\f005';
                color: rgb(255, 214, 30);
                transition: all .25s;
            }

            .star_rating_inputs input.star-5:checked~label.star:before {
                color: rgb(235, 207, 0);
                text-shadow: 0 0 10px rgba(150, 80, 30, 0.2);
            }

            .star_rating_inputs input.star-1:checked~label.star:before {
                color: #F62;
            }

            .star_rating_inputs label.star:hover {
                transform: rotate(-15deg) scale(1.3);
            }

            .star_rating_inputs label.star:before {
                content: '\f006';
                font-family: FontAwesome;
            }
        </style>
    @endpush
@endonce
