<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuPost = 'active';
        $posts = Post::all();

        return view('pages.posts.index_post', compact('posts', 'menuPost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuPost = 'active';
        $category = Category::all();
        return view('pages.posts.form_post', compact('category', 'menuPost'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required'
        ]);

        $slug = \Str::slug($request->title);

        Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'categories_id' => $request->category,
            'users_id' => Auth::user()->id
        ]);

        return redirect()->back()->with(['success' => 'Post save successfully!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $menuPost = 'active';
        $category = Category::all();
        $edit = Post::find($post->id);

        return view('pages.posts.form_edit_post', compact('category', 'menuPost', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $db = Post::find($post->id);

        $db->title = $request->title;
        $db->slug = \Str::slug($request->title);
        $db->description = $request->description;
        $db->categories_id = $request->category;

        $db->update();

        return redirect()->back()->with(['success' => 'Post Update Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $db = Post::find($post->id);

        if($db){
            $db->delete();
            return redirect()->route('posts.index')->with(['success'=> 'Post success to delete']);
        }
        return redirect()->route('posts.index')->with(['failed'=> 'Post failed to delete']);

    }

    //for ckeditor
    public function uploadImage(){
        //code upload here
        $post = new Post();
        $post->id = 0;
        $post->exists = true;

        $images = $post->addMediaFromRequest('upload')->toMediaCollection('images');

        return response()->json([
            'url'=> $images->getUrl()
        ]);

    }
}
