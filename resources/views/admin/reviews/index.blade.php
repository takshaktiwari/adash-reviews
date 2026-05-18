<x-admin.layout>
    <x-admin.breadcrumb title='Reviews' :links="[['text' => 'Dashboard', 'url' => route('admin.dashboard')], ['text' => 'Reviews']]" :actions="[]" />

    <div class="card shadow-sm">
        <x-admin.paginator-info :items="$reviews" class="card-header" />
        <div class="card-body table-responsive p-0">
            <table class="table mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>For</th>
                        <th>Rating</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $review->name }}</td>
                            <td><small class="text-muted">{{ $review->review_for }}</small></td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ $review->rating }} <i class="bi bi-star-fill"></i>
                                </span>
                            </td>
                            <td>{{ Str::limit($review->title, 40) }}</td>
                            <td>
                                <a href="{{ route('admin.reviews.status-toggle', [$review]) }}"
                                    class="badge {{ $review->status ? 'bg-success' : 'bg-secondary' }} text-decoration-none">
                                    {{ $review->status ? 'Active' : 'Inactive' }}
                                </a>
                            </td>
                            <td><small>{{ $review->created_at->format('d M Y') }}</small></td>
                            <td>
                                <a href="{{ route('admin.reviews.show', [$review]) }}"
                                    class="btn btn-info btn-sm btn-loader load-circle">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.reviews.edit', [$review]) }}"
                                    class="btn btn-success btn-sm btn-loader load-circle">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.reviews.destroy', [$review]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger delete-alert btn-loader load-circle">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $reviews->links() }}
        </div>
    </div>
</x-admin.layout>
