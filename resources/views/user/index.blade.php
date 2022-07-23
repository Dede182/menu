@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class = 'breadcrumb-item'><a href="{{route('home')}}">Home</a> </li>
        <li class = 'breadcrumb-item active'>User</li>
    </ol>
 </nav>
 <div class="card">
    <div class="card-body">
            <h4 class="d-inline">User list </h4><p class="d-inline text-muted"> result( {{$users->total()}} )</p>

            <div class="hr">
                <div class="d-flex mb-3 justify-content-between align-items-center">
                    <div class="">
                        @if(request('keyword'))
                         <p class="text-black-75 mb-1">Searched by : {{request('keyword')}}</p>
                         <a href="{{route('user.index')}}"><i class="bi bi-trash"></i></a>

                        @endif
                    </div>
                <form method = "GET" action="{{route('user.index')}}">
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Control</th>
                        <th>Joined in</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>
                                {{ucfirst($user->role)}}
                            </td>
                            <td>
                                <a class = "btn btn-outline-dark btn-sm" href="{{route('user.show',$user->id)}}">
                                    <i class="bi bi-info-circle my-1"></i>
                                </a>

                                @can('delete',$user)
                                    <form action="{{route('user.destroy',$user->id)}}" class="d-inline-block">
                                        @csrf

                                        <button class="btn btn-outline-dark btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endcan


                            </td>
                            <td>
                                <p class = "small mb-0 text-black-50">
                                    <i class="bi bi-calendar"></i>
                                    {{$user->created_at->format('d M Y')}}
                                </p>
                                <p class = "small mb-0 text-black-50">
                                    <i class="bi bi-clock"></i>
                                    {{$user->created_at->format('h : m A')}}
                                </p>

                            </td>
                        </tr>
                    @empty
                        <td colspan="6" class="text-center">There is no user with <p class = "mb-0 d-inline text-black-50">{{request('keyword')}}</p></td>
                    @endforelse
                </tbody>
            </table>
                <div class="">
                    {{$users->onEachSide(1)->links()}}
                </div>
</div>
@endsection
