<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Use Eloquent to fetch all of the data in the 'Post' model
        $posts = Post::all();
        // index() is called whenever /posts sends a GET request
        // send $posts into the posts/index view
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        // If validated, create a new post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        // Finally, redirect
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // We will use this to show each Post when it is clicked
        // Use the $id parameter to fetch the data using the model
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Bring in the post to be edited, and load the edit view
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        // If validated, find the existing post with $id
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        // Finally, redirect
        return redirect('/posts')->with('success', 'Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the post
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted.');
    }
}
