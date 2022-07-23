@extends('layouts.app')

@section('content')
 <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class = 'breadcrumb-item active'>Photo</li>
    </ol>
 </nav>
 <div class="card">
    <div class="card-body s">

        <div class="gallery">
            @forelse (Auth::user()->photos as $photo)
            <img class = "mt-3 shadow p-3 w-100 bg-white rounded"  src="{{asset('storage/'.$photo->name)}}">
            @empty
             <p class = "text-center mb-0 fw-bold">There is no photo in Gallery!!!</p>
            @endforelse



            {{-- @forelse (Auth::user()as $image )
                {{ $image }}
            @empty

            @endforelse --}}
        </div>
    </div>
 </div>
@endsection
