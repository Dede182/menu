@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center row">
                     <div class="card mb-3 col-8 mt-4 rounded">
                        <div class="card-body">
                            <h5 class="card-title text-center   ">{{ $post->title }}</h5>
                            <a href="{{ route('page.index',$post->category->id) }}" class="text-center">
                                <span class = "badge bg-secondary">
                                    {{ $post->category->title }}
                                </span>
                            </a>
                            <p class="card-text mb-2">{{ $post->description }}.</p>

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="">
                                   <p class="mb-0">{{ Str::ucfirst($post->user->name) }}</p>
                                <p class="card-text">
                                    <small class="text-muted">{{$post->created_at->diffInHours(\Carbon\Carbon::now()) }} hrs ago</small>
                                </p>
                                </div>


                                <a href="{{ route('page.detail',$post->id) }}" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                        </div>
                    </div>

        </div>
    </div>
@endsection
