<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        $posts = Post::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q ->orWhere('title','like','%$keyword%')
            ->orWhere('description','like','%$keyword%');
        })
        ->latest('id')
        ->with(['user','category'])
        ->paginate(10)
        ->withQuerystring();


        return view('index',compact('posts'));
    }

    public function detail($id){
       $post = Post::
       with(['user','category','photos'])
       ->findOrFail($id);
       ;
       return view('detail',compact(['post']));

    }
}
