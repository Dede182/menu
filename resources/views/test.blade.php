@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class = 'breadcrumb-item'><a href="{{route('home')}}">Home</a> </li>
        <li class = 'breadcrumb-item active'>Test</li>
    </ol>



 </nav>
 <div class="card">
    <div class="card-body">
        This is test
    </div>
 </div>
@endsection
