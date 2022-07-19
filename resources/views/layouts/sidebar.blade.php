@section('sidebar')
<div class="list-group mb-3">
    <a href="{{route('home')}}" class="list-group-item list-group-item-action">Home</a>
    <a href="{{route('test')}}" class="list-group-item list-group-item-action">Test</a>
</div>


<p class="small text-black-50 mb-0">Manage Post</p>
<div class="list-group mb-3">
    <a href="{{route('post.create')}}" class="list-group-item list-group-item-action">Create Post</a>
    <a href="{{route('post.index')}}" class="list-group-item list-group-item-action">Post List</a>
</div>

<p class="small text-black-50 mb-0">Manage Categoies</p>
<div class="list-group mb-3">
    <a href="{{route('category.create')}}" class="list-group-item list-group-item-action">Create Category</a>
    <a href="{{route('category.index')}}" class="list-group-item list-group-item-action">Categories List</a>
</div>


@admin
<p class="small text-black-50 mb-0">Manage Users</p>
<div class="list-group mb-3">
    {{-- <a href="{{route('category.create')}}" class="list-group-item list-group-item-action">Create Category</a> --}}
    <a href="{{route('user.index')}}" class="list-group-item list-group-item-action">User List</a>
</div>
@endadmin
