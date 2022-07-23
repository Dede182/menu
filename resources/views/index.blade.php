@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center row">



                    <h1 class="text-center">Blog Post</h1>
                 @forelse ($posts as $post)
                    {{-- <div class="card" style="width: 33rem;">
                    @isset($post->featured_image)
                        <img class="card-img-top w-25" src="{{ asset('storage/'.$post->featured_image) }}" alt="Card image cap">
                    @endisset

                    <div class="card-body">
                      <h5 class="card-title">{{ $post->title }}</h5>
                      <p class="card-text">{{ $post->excerpt }}</p>
                      <a href="{{ route('page.detail') }}" class="btn btn-primary">Detail</a>
                    </div>
                  </div> --}}
                     <div class="card mb-3 col-8 rounded">
                        @isset($post->featured_image)
                            <img class="card-img-top ci" src="{{ asset('storage/' . $post->featured_image) }}" alt="Card image cap">
                        @endisset

                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <a href="{{ route('page.index',$post->category->id) }}" class="">
                                <span class = "badge bg-secondary">
                                    {{ $post->category->title }}
                                </span>
                            </a>
                            <p class="card-text mb-2">{{ $post->excerpt }}.</p><p>{{ Str::ucfirst($post->user->name) }}</p>
                            <div class="d-flex align-items-center justify-content-between">

                                <p class="card-text">

                                    <small class="text-muted">{{$post->created_at->diffInHours(\Carbon\Carbon::now()) }} hrs ago</small>
                                </p>

                                <a href="{{ route('page.detail',$post->id) }}" class="btn btn-primary">Detail</a>
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
                    </div>

        </div>
    </div>
@endsection
