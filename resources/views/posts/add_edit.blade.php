@extends('layouts.general.index')
 
@section('title', 'Admin Panel')
 
@section('sidebar')
    @parent
@endsection
 
@section('styles')
    <style>
        form{
            width:100%;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }
        .post{
            display:flex;
            flex-direction:column;
            justify-content:center;
            width:80%;
            padding:50px;
            min-height:500px;
            background-color:#F76E11;
        }
        .post .card-body{
            display:flex;
            flex-direction:column;
            justify-content:center;
        }
        .post-textarea{
            width:100%;
            min-height:300px;
        }
        form > *{
            width:100%;
            text-align:center;
        }
        .buttons-container{
            display:flex;
            flex-direction:row;
            justify-content:center;
            padding-right:10px;
            padding-left:10px;
        }
        .buttons-container button{
            width:60%;
        }
        .bootstrap-tagsinput .tag {
            background: gray;
            border: 1px solid black;
            padding: 0 6px;
            margin-right: 2px;
            color: white;
            border-radius: 4px;
        }
        .post .bootstrap-tagsinput{
            width:100%;
        }
    </style>
@endsection

@section('scripts')
        <script>
            $(document).ready(function(){
                var categoriesInput = $("#categories").tagsinput('input');
                categoriesInput.addClass('form-control');
                categoriesInput.attr('name','categories');
                @isset($post)
                @if($post->categories!=null)
                    categoriesInput.tagsinput('add','');
                    @foreach($post->categories as $category)
                        categoriesInput.tagsinput('add','{{$category}}');
                    @endforeach
                @endif
                @endisset
            })
        </script>
@endsection

@section('content')
    <form method="POST" action='{{isset($post)?"/posts/edit":"/posts/add"}}' enctype="multipart/form-data">
        @csrf
        @isset($post)
            <input name="id" type="hidden" value="{{$post->id}}" />
        @endisset
        <div class="post" class="card">
            <div class="card-body">
                @isset($success)
                    <p class="alert alert-success">{{ $success }}</p>
                @endisset
                <h5 class="card-title">{{isset($post)?"Edit post":"Add a post"}}</h5>
                <br/>
                <h6 class="card-subtitle mb-2 text-muted">Title</h6>
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <input name="title" class="form-control" placeholder="Title goes here..." value='{{isset($post)?$post->title:""}}' />
                <br />

                <h6 class="card-subtitle mb-2 text-muted">What is in your mind?</h6>
                @if ($errors->has('body'))
                    <span class="text-danger">{{ $errors->first('body') }}</span>
                @endif
                <p class="card-text">
                    <textarea name="body" class="post-textarea" placeholder="Write something here...">{{isset($post)?$post->body:""}}</textarea>
                    <br/>
                    <br/>
                    <label class="form-label text-muted">Categories </label>
                    <br/>
                    <input id="categories" data-role="tagsinput" type="text" />
                    <p>
                        <label class="form-label text-muted">Post Image  </label>
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                        <input name="image" type="file" class="form-control" />
                    </p>
                </p>
                <div class="buttons-container">
                    <button type="submit" class="btn btn-secondary">{{isset($post)?"Edit":"Post"}}</a>
                </div>
            </div>
        </div>
    </form>

@endsection