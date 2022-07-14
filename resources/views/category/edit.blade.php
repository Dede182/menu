
@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class = 'breadcrumb-item'><a href="{{route('home')}}">Home</a> </li>
        <li class = 'breadcrumb-item'><a href="{{route('category.index')}}">Category</a> </li>
        <li class = 'breadcrumb-item active'>Edit</li>
    </ol>
 </nav>
 <div class="card">
    <div class="card-body">
        <h4>
           Edit Category
        </h4>
        <form action="{{route('category.update',$category->id)}}" method = "POST">
            @csrf
            @method('put')
            <div class="row">
                <div class="col">
                    <input type="text" value="{{old('title',$category->title)}}" name = "title" class ="form-control @error('title')
                    is-invalid
                    @enderror">
                    @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="col">
                    <button class = "btn btn-primary">Edit</button>
                </div>
            </div>
        </form>
    </div>
 </div>
@endsection
