@forelse($categories as $category)
    {!! $category->name . "<br>" !!}
    @empty
    <p>No Categories</p>
@endforelse
