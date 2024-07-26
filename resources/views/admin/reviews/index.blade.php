<x-admin.layout>
    <x-admin.breadcrumb title='Blog Posts' :links="[['text' => 'Dashboard', 'url' => route('admin.dashboard')], ['text' => 'Posts']]" :actions="[
        [
            'text' => 'Filter',
            'icon' => 'fas fa-sliders-h',
            'url' => route('admin.reviews.index', ['filter' => 1]),
            'class' => 'btn-success btn-loader',
        ],
    ]" />

    <div class="card shadow-sm">
        <x-admin.paginator-info :items="$reviews" class="card-header" />
        <div class="card-body table-responsive">
            <table class="table mb-0">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Rating</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $review->name }}</td>
                            <td>
                                {{ $review->rating }}
                                <i class="fas fa-star"></i>
                            </td>
                            <td>{{ $review->title }}</td>
                            <td>
                                <a href="{{ route('admin.reviews.status-toggle', [!$review->status]) }}">
                                    {{ $review->status ? 'Active' : 'Inactive' }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.reviews.show', [$review]) }}"
                                    class="btn btn-info btn-sm btn-loader load-circle">
                                    <i class="fas fa-info-circle"></i>
                                </a>

                                <a href="{{ route('admin.reviews.edit', [$review]) }}"
                                    class="btn btn-success btn-sm btn-loader load-circle">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.reviews.destroy', [$review]) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger delete-alert btn-loader load-circle"><i
                                            class="fas fa-trash"></i></button>
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
