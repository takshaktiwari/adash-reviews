<x-admin.layout>
    <x-admin.breadcrumb title='Blog Posts' :links="[['text' => 'Dashboard', 'url' => route('admin.dashboard')], ['text' => 'Posts']]" :actions="[
        [
            'text' => 'Reviews',
            'icon' => 'fas fa-sliders-h',
            'url' => route('admin.reviews.index'),
            'class' => 'btn-success btn-loader',
        ],
    ]" />

    <x-areviews-areviews:review-form method="PUT" :model="$review->reviewable" :review="$review" :url="route('admin.reviews.update', [$review])"
        :redirect="route('admin.reviews.index')" :display="true" :addStatus="true" />
</x-admin.layout>
