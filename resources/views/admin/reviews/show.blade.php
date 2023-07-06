<x-admin.layout>
    <x-admin.breadcrumb title='Blog Posts' :links="[['text' => 'Dashboard', 'url' => route('admin.dashboard')], ['text' => 'Posts']]" :actions="[
        [
            'text' => 'Reviews',
            'icon' => 'fas fa-sliders-h',
            'url' => route('admin.reviews.index'),
            'class' => 'btn-success btn-loader',
        ],
    ]" />

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <td><b>Name:</b></td>
                            <td>{{ $review->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Mobile:</b></td>
                            <td>{{ $review->mobile }}</td>
                        </tr>
                        <tr>
                            <td><b>Email:</b></td>
                            <td>{{ $review->email }}</td>
                        </tr>
                        <tr>
                            <td><b>Rating:</b></td>
                            <td>{{ $review->rating }} <i class="fas fa-star"></i></td>
                        </tr>
                        <tr>
                            <td><b>Review For:</b></td>
                            <td>{{ $review->review_for }}</td>
                        </tr>
                        <tr>
                            <td><b>Title:</b></td>
                            <td>{{ $review->title }}</td>
                        </tr>

                        <tr>
                            <td class="text-nowrap"><b>Created At:</b></td>
                            <td>{{ $review->created_at->format('d-M-Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>Content:</b>
                                <br />
                                <p>{{ $review->content }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.reviews.edit', [$review]) }}"
                        class="btn btn-success px-3 btn-loader load-circle">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <form action="{{ route('admin.reviews.destroy', [$review]) }}" method="POST"
                        class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn px-3 btn-danger delete-alert btn-loader load-circle">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin.layout>
