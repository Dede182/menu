@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class = 'breadcrumb-item'><a href="{{route('home')}}">Home</a> </li>
        <li class = 'breadcrumb-item active'>Categories</li>
    </ol>
 </nav>
 <div class="card">
    <div class="card-body">
            <h4>Categories list</h4>
            <table class = "table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        @notAuthor
                            <th>Owner</th>
                        @endnotAuthor

                        <th>Control</th>
                        <th>Craeted_at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>
                                {{$category->title}}
                                <br>
                                <span class = "badge bg-secondary">{{$category->slug}} </span>
                            </td>
                                @notAuthor
                                    <td>
                                        {{App\Models\User::find($category->user_id)->name}}
                                    </td>
                                @endnotAuthor

                            <td>
                            @can('update',$category)
                                 <a class = "btn btn-outline-dark btn-sm" href="{{route('category.edit',$category->id)}}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endcan

                            @can('delete',$category)
                                <form action="{{route('category.destroy',$category->id)}}" class="d-inline-block" method = "POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-dark btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            @endcan

                            </td>
                            <td>
                                <p class = "small mb-0 text-black-50">
                                    <i class="bi bi-calendar"></i>
                                    {{$category->created_at->format('d M Y')}}
                                </p>
                                <p class = "small mb-0 text-black-50">
                                    <i class="bi bi-clock"></i>
                                    {{$category->created_at->format('h : m A')}}
                                </p>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
</div>
@endsection
