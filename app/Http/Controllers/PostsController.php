<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Spatie\MediaLibrary\MediaCollections\Models\Media;


class PostsController extends Controller
{
    private function getPosts($isAuth){
        $posts=Post::inRandomOrder();
        if($isAuth){
            $posts=$posts->where('published',true);
        }
        $posts=$posts->get();
        $posts=$posts->map(function($post){
            $post->categories=strlen($post->categories)>0?explode(',',$post->categories):null;
            if($post->image!=null){
                $imageUrl=$post->getFirstMediaUrl('image');
                $post->image=$imageUrl;
            }
            return $post;
        });
        return $posts;
    }
    private function getPostById($id){
        $post=Post::where('id',$id)->first();
        if(isset($post) && $post->categories!=null){
            $post->categories=strlen($post->categories)>0?explode(',',$post->categories):null;
        }
        if(isset($post->image)){
            $imageUrl=$post->getFirstMediaUrl('image');
            $post->image=$imageUrl;
        }
        
        return $post;
    }


    public function index(){
        $posts=$this->getPosts(Auth::user()===null);
        return view('posts.index',['posts'=>$posts]);
    }

    public function add(){
        return view('posts.add_edit');
    }
    public function postAdd(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $post=Post::create($request->all());

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $imageName = time().$request->file('image')->getClientOriginalName();  
            $post->addMediaFromRequest('image')->usingName($imageName)->toMediaCollection('image');
            $post->update(['image'=>$imageName]);
            $post->save;
        }
        
        return view('posts.add_edit')->with(['success'=>"The post is added successfully!"]);
    }

    public function edit($id){
        $post=$this->getPostById($id);
        return view('posts.add_edit',['post'=>$post, 'success'=>null]);
    }
    public function postEdit(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $post=Post::where('id',$request->id)->first();
        $post->update([
            'title'=>$request->title,
            'body'=>$request->body,
            'categories'=>$request->categories,
        ]);
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $imageName = time().$request->file('image')->getClientOriginalName();  
            $post->addMediaFromRequest('image')->usingName($imageName)->toMediaCollection('image');
            $post->update(['image'=>$imageName]);
            $post->save;
        }
        return view('posts.add_edit')->with(['success'=>"The post is edited successfully!",'post'=>$this->getPostById($request->id)]);
    }

    public function viewPost($id){
        $post=$this->getPostById($id);
        return view('posts.post',['post'=>$post]);
    }
    public function delete($id){
        $post=Post::where('id',$id)->first();
        $post->delete();
        return redirect('/posts')->with(['success'=>'The post is deleted successfully!']);
    }
    

    public function publish($id){
        $post=Post::where('id',$id)->first();
        $post->update(['published'=>(!$post->published)]);
        return redirect("/posts/view/$post->id");
    }

}
