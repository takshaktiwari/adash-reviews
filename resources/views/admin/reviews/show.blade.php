<x-admin.layout>
    <x-admin.breadcrumb title='Review Detail'
        :links="[['text' => 'Dashboard', 'url' => route('admin.dashboard')], ['text' => 'Reviews', 'url' => route('admin.reviews.index')], ['text' => 'Detail']]"
        :actions="[
            ['text' => 'Edit', 'icon' => 'bi bi-pencil', 'url' => route('admin.reviews.edit', [$review]), 'class' => 'btn-success btn-loader'],
        ]" />

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <td class="text-muted small fw-bold text-nowrap">Name</td>
                            <td>{{ $review->name }}</td>
                        </tr>
                        @if ($review->mobile)
                            <tr>
                                <td class="text-muted small fw-bold text-nowrap">Mobile</td>
                                <td>{{ $review->mobile }}</td>
                            </tr>
                        @endif
                        @if ($review->email)
                            <tr>
                                <td class="text-muted small fw-bold text-nowrap">Email</td>
                                <td>{{ $review->email }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="text-muted small fw-bold text-nowrap">Rating</td>
                            <td>
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                                @endfor
                                <span class="ms-1 small text-muted">({{ $review->rating }}/5)</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted small fw-bold text-nowrap">Review For</td>
                            <td>{{ $review->review_for }}</td>
                        </tr>
                        @if ($review->title)
                            <tr>
                                <td class="text-muted small fw-bold text-nowrap">Title</td>
                                <td>{{ $review->title }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="text-muted small fw-bold text-nowrap">Status</td>
                            <td>
                                <span class="badge {{ $review->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $review->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted small fw-bold text-nowrap">Date</td>
                            <td>{{ $review->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="text-muted small fw-bold mb-1">Review</p>
                                <p class="mb-0">{{ $review->content }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer d-flex gap-2">
                    <a href="{{ route('admin.reviews.edit', [$review]) }}"
                        class="btn btn-success px-3 btn-loader load-circle">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.reviews.destroy', [$review]) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn px-3 btn-danger delete-alert btn-loader load-circle">
                            <i class="bi bi-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
