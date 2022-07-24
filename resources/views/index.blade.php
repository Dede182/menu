@extends('master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                    <h1 class="text-center">Blog Post</h1>
                    <div class="d-flex justify-content-between align-items-center">

                    <div class="">
                      @if(request('keyword'))

                        <p class="text-black-75 mb-1 d-inline me-2">Searched by :</p><em><strong>{{request('keyword')}}</strong></em>
                        <a href="{{route('page.index')}}"><i class="bi bi-trash"></i></a>



                    @endif
                    </div>
                    <form action="{{ route('page.index') }}" method="get" class="d-flex mb-3 justify-content-end">

                        <div class="input-group">

                            <input id = "search-input" type="text" class="" name = "keyword" value="{{ request('keyword') }}">

                              <button for = "search-input" type = "submit" class = "btn btn-outline-success">
                                  <i class="bi bi-search"></i>
                              </button>

                        </div>



                    </form>
                    </div>

                    @isset($category)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p>Filter By : {{ $category->title }}</p>
                            <a href="{{ route('page.index') }}" class="btn  btn-outline-primary">See All</a>
                     </div>
                  @endisset

                 @forelse ($posts as $post)
                     <div class="card mb-3 col-12  rounded">

                        @isset($post->featured_image)
                            <img class="card-img-top mt-2 ci" src="{{ asset('storage/' . $post->featured_image) }}" alt="Card image cap">
                        @endisset

                        <div class="card-body">
                            <h5 class="card-title mb-1">{{ $post->title }}</h5>

                            <a href="{{ route('page.category',$post->category->id) }}" class="">
                                <span class = "badge bg-secondary">
                                    {{ $post->category->title }}
                                </span>
                            </a>

                            <p class="card-text my-2">{{ $post->excerpt }}.</p>

                            <div class="d-flex align-items-center justify-content-between">

                                <div class="">
                                  <p class = "mb-0">
                                    {{ Str::ucfirst($post->user->name) }}
                                  </p>
                                 <p class="card-text">

                                    <small class="text-muted ">{{$post->created_at->diffForHumans() }}</small>
                                 </p>

                                </div>

                                <a href="{{ route('page.detail',$post->slug) }}" class="btn btn-primary">Detail</a>

                            </div>

                        </div>

                    </div>
                    @empty

                    <div class="card">

                        <div class="card-body">

                            <h3 class="text-center">There is no posts yet</h3>

                        </div>

                    </div>
                    @endforelse

                    <div class="">
                        {{$posts->onEachSide(1)->links()}}
                    </div>

                    </div>

            </div>
    </div>
@endsection
