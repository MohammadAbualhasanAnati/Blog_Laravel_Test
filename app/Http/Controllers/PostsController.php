<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function index(){
        $posts=Post::all();
        return view('posts.index',['posts'=>$posts]);
    }

    public function add(){
        return view('posts.add',['success'=>null]);
    }
    public function postAdd(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        if($validated){
            $post=Post::create($request->all());

            if($request->hasFile('image') && $request->file('image')->isValid()){
                $imageName = time().$request->image;  
                $post->addMediaFromRequest('image')->toMediaCollection('image');
            }
            
            return view('posts.add')->with(['success'=>"The post is added successfully!"]);
        }
        return view('posts.add',$validated);
    }

    public function edit($id){
        $post=Post::where('id',$id)->first();
        return view('posts.edit',['post'=>$post]);
    }

    public function publish($username){
        $post=Post::where('id',$id)->first();
        if($post->published){
            return view('posts.edit')->withErrors(['published'=>'The post is already published']);
        }
        $post->update(['published'=>true]);
        return view('posts.edit')->withSuccess(['published'=>'The post is published successfully!']);
    }

}
