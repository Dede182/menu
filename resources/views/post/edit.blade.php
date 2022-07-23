
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
        <form action="{{route('post.update',$post->id)}}" method = "POST" id = "postUpdateFrom" enctype="multipart/form-data">
            @csrf
            @method('put')
        </form>
            <div class = "mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input form="postUpdateFrom" type="text" value="{{old('title',$post->title)}}" id = "title" class = "form-control @error('title') is-invalid @enderror" name = "title">
                @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>
            <div class= "mb-3">
                 <label for="category" class="form-label">Select Category</label>
                    <select form="postUpdateFrom" type="text" value="{{old('category')}}" id = "category" class = "form-select @error('category') is-invalid @enderror" name = "category">

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

            <div class = "mb-2">
                <label for="photos" class="form-label d-block mb-0">Post Image</label>
                <div class="mb-0">
                        @foreach ($post->photos as $photo)
                          <div class="mb-4 mt-3 d-md-inline-block position-relative">
                              <img height="130" class = "shadow p-3 bg-white d-inline rounded" src="{{asset("storage/".$photo->name)}}" alt="">
                                  <form action="{{route('photo.destroy',$photo->id)}}" class="d-inline-block" method="post">
                                  @csrf
                                  @method('delete')
                                      <button  class="btn btn-danger btn-sm position-absolute bottom-0 end-0 me-1">
                                          <i class="bi bi-trash3"></i>
                                      </button>
                              </form>
                          </div>
                          @endforeach
                </div>

            </div>
            <div class="mb-3">
                <input type="file" form="postUpdateFrom" id = "photos" class = "form-control d-inline @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror" name = "photos[]" multiple enctype='multipart/form-data'>
                @error('photos')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
                @error('photos.*')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>

            <div class = "mb-3">
                     <label for="description" class="form-label">Post Description</label>
                     <textarea form="postUpdateFrom" type="text" value="{{old('description')}}" rows = '10' id = "description" class = "form-control @error('description') is-invalid @enderror" name = "description">{{old('description',$post->description)}}</textarea>
                      @error('description')
                        <div class="invalid-feedback">{{$message}}</div>
                     @enderror
            </div>
           <div class="d-flex justify-content-between">
            <div class = "mb-0">
                <label for="featured_image" class="form-label d-block mb-0">Featured IMage</label>
                @isset($post->featured_image)
                <img class = "w-25 mt-1 mb-3 shadow p-3 bg-white rounded" src="{{asset("storage/".$post->featured_image)}}" alt="">

              @endisset
                <input form="postUpdateFrom" type="file" id = "title" class = "form-control w-75 @error('featured_image') is-invalid @enderror" name = "featured_image" >
                @error('featured_image')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>
            <button form="postUpdateFrom" class="btn btn-sm py-1 btn-primary h-75 align-self-end">Update</button>
           </div>
    </div>
 </div>
@endsection
