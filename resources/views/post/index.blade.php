@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class = 'breadcrumb-item'><a href="{{route('home')}}">Home</a> </li>
        <li class = 'breadcrumb-item active'>Post</li>
    </ol>
 </nav>
 <div class="card">
    <div class="card-body">
            <h4 class="d-inline">Post list </h4><p class="d-inline text-muted"> result( {{$posts->total()}} )</p>
            <form method="GET" class="mt-3" action="{{route('post.index',Auth::id())}}">
                <button name = "mypost" value = {{Auth::id()}} class = "btn btn-outline-success btn-sm">My posts</button>
                @csrf
            </form>
            <div class="hr">
                <div class="d-flex mb-3 justify-content-between align-items-center">
                    <div class="">
                        @if(request('keyword'))
                         <p class="text-black-75 mb-1 d-inline me-2">Searched by :</p><em><strong>{{request('keyword')}}</strong></em>
                         <a href="{{route('post.index')}}"><i class="bi bi-trash"></i></a>

                        @endif
                    </div>
                <form method = "GET" action="{{route('post.index')}}">
                    <div class="input-group">
                        <input type="text" name = "keyword" class = "form-control" required>
                            <button class="btn btn-success
                             btn-sm">
                                 <i class="bi bi-search"></i>
                                     Search
                            </button>
                    </div>

                </form>
                </div>

            </div>
            <table class = "table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        @if (Auth::user()->role != 'author')
                        <th>Owner</th>
                        @endif
                        <th>Control</th>
                        <th>Craeted_at</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td class = 'w-25'>
                                {{$post->title}}
                            </td>
                            <td>
                                {{$post->category->title}}
                            </td>
                            @if (Auth::user()->role != 'author')
                                <td>
                                {{$post->user->name}}
                                </td>
                            @endif

                            <td>
                                <a class = "btn btn-outline-dark btn-sm" href="{{route('post.show',$post->id)}}">
                                    <i class="bi bi-info-circle my-1"></i>
                                </a>
                                @can('update',$post)
                                    <a class = "btn btn-outline-dark btn-sm" href="{{route('post.edit',$post->id)}}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endcan
                                @can('delete',$post)
                                    <form action="{{route('post.destroy',$post->id)}}" class="d-inline-block" method = "POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-dark btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endcan


                            </td>
                            <td>
                                <p class = "small mb-0 text-black-50">
                                    <i class="bi bi-calendar"></i>
                                    {{$post->created_at->format('d M Y')}}
                                </p>
                                <p class = "small mb-0 text-black-50">
                                    <i class="bi bi-clock"></i>
                                    {{$post->created_at->format('h : m A')}}
                                </p>

                            </td>
                        </tr>
                    @empty
                        <td colspan="6" class="text-center">There is no post with <p class = "mb-0 d-inline text-black-50">{{request('keyword')}}</p></td>
                    @endforelse
                </tbody>
            </table>
                <div class="">
                    {{$posts->onEachSide(1)->links()}}
                </div>
</div>
@endsection
