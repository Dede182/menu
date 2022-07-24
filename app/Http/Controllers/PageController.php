<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        $posts = Post::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q ->orWhere('title','like',"%$keyword%")
            ->orWhere('description','like',"%$keyword%");
        })
        ->latest('id')
        ->with(['user','category'])
        ->paginate(10)
        ->withQuerystring();


        return view('index',compact('posts'));
    }

    public function detail($slug){
        // return $slug;
       $post = Post::where('slug',$slug)
       ->with(['user','category','photos'])
       ->first();
       return view('detail',compact(['post']));

    }

    public function postsByCategory(Category $category,$id){
        $category = Category::where('id',$id)->first();

        $posts = Post::
        where(function($q){
            $q-> when(request('keyword'),function($q){
                 $keyword = request('keyword');
                 $q ->orWhere('title','like',"%$keyword%")
                    ->orWhere('description','like',"%$keyword%");
        });
        })
        ->where("category_id",$id)
        ->latest('id')
        ->with(['user','category'])
        ->paginate(10)
        ->withQuerystring();

        return view('index',compact(['posts','category']));

    }
}
