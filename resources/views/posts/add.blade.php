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
                var categoriesInput = $("input[name=categories]").tagsinput('input');
                categoriesInput.addClass('form-control');
                categoriesInput.attr('name','categories');
            })
        </script>
@endsection

@section('content')
    <form method="POST" action="" enctype="multipart/form-data">
        @csrf
        <div class="post" class="card">
            <div class="card-body">
                @if($success)
                    <p class="alert alert-success">{{ $success }}</p>
                @endif
                <h5 class="card-title">Add a post</h5>
                <br/>
                <h6 class="card-subtitle mb-2 text-muted">Title</h6>
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <input name="title" class="form-control" placeholder="Title goes here..." />
                <br />

                <h6 class="card-subtitle mb-2 text-muted">What is in your mind?</h6>
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <p class="card-text">
                    <textarea name="body" class="post-textarea" placeholder="Write something here..."></textarea>
                    <br/>
                    <br/>
                    <label class="form-label text-muted">Categories </label>
                    <br/>
                    <input name="categories" data-role="tagsinput" type="text" />
                    <p>
                        <label class="form-label text-muted">Post Image  </label>
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                        <input name="image" type="file" class="form-control" />
                    </p>
                </p>
                <div class="buttons-container">
                    <button type="submit" class="btn btn-secondary">Post</a>
                </div>
            </div>
        </div>
    </form>

@endsection