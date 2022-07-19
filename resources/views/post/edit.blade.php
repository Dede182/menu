
@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class = 'breadcrumb-item'><a href="{{route('home')}}">Home</a> </li>
        <li class = 'breadcrumb-item'><a href="{{route('post.index')}}">Post</a> </li>
        <li class = 'breadcrumb-item active'>Edit</li>
    </ol>
 </nav>
 <div class="card">
    <div class="card-body">
        <h4>
            Edit Category
        </h4>
        <form action="{{route('post.update',$post->id)}}" method = "POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class = "mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" value="{{old('title',$post->title)}}" id = "title" class = "form-control @error('title') is-invalid @enderror" name = "title">
                @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>
            <div class= "mb-3">
                 <label for="category" class="form-label">Select Category</label>
                    <select type="text" value="{{old('category')}}" id = "category" class = "form-select @error('category') is-invalid @enderror" name = "category">

                        @foreach (\App\Models\Category::all() as $category)
                        <option
                        value="{{ $category->id }}"
                        {{ $category->id == old('category',$post->category->id) ? 'selected':'' }}>
                        {{ $category->title }}
                    </option>
                        @endforeach
                    </select>

                    @error('category')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
            </div>

            <div class = "mb-3">
                <label for="photos" class="form-label d-block mb-0">Post Image</label>
                @foreach ($post->photos as $photo)
                <img height="100" class = "mt-3 shadow p-3 bg-white d-inline rounded mb-4   " src="{{asset("storage/".$photo->name)}}" alt="">
                @endforeach
                <input type="file" id = "photos" class = "form-control d-inline @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror" name = "photos[]" multiple enctype='multipart/form-data'>
                @error('photos')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
                @error('photos.*')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>

            <div class = "mb-3">
                     <label for="description" class="form-label">Post Description</label>
                     <textarea type="text" value="{{old('description')}}" rows = '10' id = "description" class = "form-control @error('description') is-invalid @enderror" name = "description">{{old('description',$post->description)}}</textarea>
                      @error('description')
                        <div class="invalid-feedback">{{$message}}</div>
                     @enderror
            </div>
           <div class="d-flex justify-content-between">
            <div class = "mb-0">
                <label for="featured_image" class="form-label d-block mb-0">Post Title</label>
                @isset($post->featured_image)

                <img class = "w-25 mt-1 mb-3 shadow p-3 bg-white rounded" src="{{asset("storage/".$post->featured_image)}}" alt="">

              @endisset
                <input type="file" id = "title" class = "form-control w-75 @error('featured_image') is-invalid @enderror" name = "featured_image" >
                @error('featured_image')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>
            <button class="btn btn-sm py-1 btn-primary h-75 align-self-end">Update</button>
           </div>
        </form>
    </div>
 </div>
@endsection
