@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class = 'breadcrumb-item'><a href="{{route('home')}}">Home</a> </li>
        <li class = 'breadcrumb-item'><a href="{{route('post.index')}}">Post</a> </li>
        <li class = 'breadcrumb-item active'>Show</li>
    </ol>
 </nav>
 <div class="card">
    <div class="card-body">
        <h4>{{$post->title}}</h4>
        <hr>
        <div class="mb-3">

            <span class = "badge bg-secondary">

                <form action="{{route('post.index',$post->category_id)}}" method="GET">
                @csrf
                <button name = "cid" value = "{{$post->category_id}}" type = "submit" class="btn text-light btn-sm adjustbtn p-0 m-0">
                    <i class="bi bi-grid">{{$post->category->title}}</i>
                </button>
                </form>
                {{-- <a class = "text-decoration-none text-light" href="{{route('post.index',$post->category_id)}}">
                    <i class="bi bi-grid">{{App\Models\Category::find($post->category_id)->title}}</i>
                </a> --}}
            </span>
            <span class = "badge bg-secondary">
                <form action="{{route('post.index',$post->user_id)}}" method="GET">
                    @csrf
                    <button name = "uid" value = "{{$post->user_id}}" type = "submit" class="btn text-light btn-sm adjustbtn p-0 m-0">
                        <i class="bi bi-grid">{{$post->user->name}}</i>
                    </button>
                    </form>
            </span>
            <span class = "badge bg-secondary">
                <button class="btn btn-sm text-light adjustbtn p-0 m-0">
                     <i class="bi bi-calendar"></i>
                {{$post->created_at->format('d M Y')}}
                </button>

            </span>
            <span class = "badge bg-secondary">
                <button class="btn btn-sm text-light adjustbtn p-0 m-0">
                <i class="bi bi-clock"></i>
                {{$post->created_at->format('h : m A')}}
                </button>
            </span>
        </div>
        <div class="mb-3">

            @foreach ($post->photos as $photo)
                <img class = "mt-3 shadow p-3 bg-white rounded" src="{{asset('storage/'.$photo->name)}}" height="125" alt="">

            @endforeach
        </div>
        <p>
            {{$post->description}}
        </p>
        @isset($post->featured_image)
            <h4>Featured Image</h4>
             <img class = "w-25 mt-3 shadow p-3 bg-white rounded" src="{{asset("storage/".$post->featured_image)}}" alt="">

           @endisset
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{route('post.create')}}" class = "btn btn-primary"><i class="bi bi-plus-square-fill"></i> Create New Post</a>
            <a href="{{route('post.index')}}" class = "btn btn-outline-primary">All Post</a>
            @if (Auth::user()->id == $post->user_id || Auth::user()->role === "admin")
            <a href="{{route('post.edit',$post->id)}}" class = "btn btn-primary"><i class = "bi bi-pencil"></i> Edit Post</a>
            @endif
        </div>
    </div>
 </div>
@endsection
