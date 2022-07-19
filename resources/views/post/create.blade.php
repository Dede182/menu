
@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class = 'breadcrumb-item'><a href="{{route('home')}}">Home</a> </li>
        <li class = 'breadcrumb-item'><a href="{{route('post.index')}}">Post</a> </li>
        <li class = 'breadcrumb-item active'>Create</li>
    </ol>
 </nav>
 <div class="card">
    <div class="card-body">
        <h4>
            Create Category
        </h4>
        <form action="{{route('post.store')}}" method = "POST" enctype="multipart/form-data">
            @csrf
            <div class = "mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" value="{{old('title')}}" id = "title" class = "form-control @error('title') is-invalid @enderror" name = "title">
                @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>

            <div class= "mb-3">
                 <label for="category" class="form-label">Select Category</label>
                    <select type="text" value="{{old('category')}}" id = "category" class = "form-select @error('category') is-invalid @enderror" name = "category">
                        @foreach (\App\Models\Category::all() as $category)
                            <option  value="{{$category->id}}" {{$category->id == old('category') ? "selected" : ""}}>{{$category->title}}</option>
                        @endforeach
                    </select>

                    @error('category')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
            </div>

            <div class = "mb-3">
                <label for="photos" class="form-label">Post Image</label>
                <input type="file" id = "photos" class = "form-control @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror" name = "photos[]" multiple>
                @error('photos')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
                @error('photos.*')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>

            <div class = "mb-3">
                     <label for="description" class="form-label">Post Description</label>
                     <textarea type="text" value="{{old('description')}}" rows = '10' id = "description" class = "form-control @error('description') is-invalid @enderror" name = "description"></textarea>
                      @error('description')
                        <div class="invalid-feedback">{{$message}}</div>
                     @enderror
            </div>
           <div class="d-flex justify-content-between">
            <div class = "mb-0">
                <label for="featured_image" class="form-label">Featured Image</label>
                <input type="file" id = "title" class = "form-control @error('featured_image') is-invalid @enderror" name = "featured_image">
                @error('featured_image')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>
            <button class="btn btn-sm py-1 btn-primary">Create Post</button>
           </div>
        </form>
    </div>
 </div>
@endsection
