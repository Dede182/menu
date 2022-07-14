<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as Gate;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Post $post)
    {
        // return $request;
        $posts = Post::
        when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q->orWhere('title','like',"%$keyword%")
            ->orWhere('description','like',"%$keyword%");
        })
        ->When(request('cid'),function($q){
            $categoryid= request('cid');
            $q->orWhere('category_id','=',"$categoryid");
        })
        ->When(request('uid'),function($q){
            $userId= request('uid');
            $q->orWhere('user_id','=',"$userId");
        })
        ->latest('id')
        ->paginate(10)->withQueryString();
        // return dd($posts);
        return  view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response+
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,50,'....');
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        if($request->hasFile('featured_image')){
            $newname = uniqid()."_featured_image.".$request->file('featured_image')->extension();
            $request->file('featured_image')->storeAs('public',$newname);
            $post->featured_image = $newname;
        }
        $post->save();

        return redirect()->route('post.index')->with('status',$post->title .' is added sccessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Gate::denies('update',$post)){
            return abort(403,'you are not allowed to edit   ');
        }
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,50,'....');
        $post->user_id = Auth::id();
        $post->category_id = $request->category;

        if($request->hasFile('featured_image')){

            Storage::delete('public/',$post->featured_image);

            $newname = uniqid()."_featured_image.".$request->file('featured_image')->extension();
            $request->file('featured_image')->storeAs('public',$newname);
            $post->featured_image = $newname;
        }
        $post->save();

        return redirect()->route('post.index')->with('status',$post->title .' is updated succefully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Gate::denies('delete',$post)){
            return abort('403','you are not allowed to delete');
        }
        $postTitle = $post->title;
        Storage::delete($post->featured_image);
        $post->delete();
        return redirect()->back()->with('status',$postTitle .' is deleted succefully');
        return redirect()->route('post.index')->with('status',$postTitle .' is deleted succefully');
    }
}
