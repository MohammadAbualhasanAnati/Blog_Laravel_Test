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
        #post{
            display:flex;
            flex-direction:column;
            justify-content:center;
            width:80%;
            padding:50px;
            min-height:500px;
        }
        #post .card-body{
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
            justify-content:space-between;
            padding-right:10px;
            padding-left:10px;
        }
        .buttons-container button{
            width:200px;
        }
    </style>
@endsection

@section('content')
    <form method="POST" action="">
        @csrf
        <div id="post" class="card">
            <div class="card-body">
                @if($success)
                    <p class="alert alert-success">{{ $success }}</p>
                @endif
                <h5 class="card-title">Add a post</h5>
                
                <h6 class="card-subtitle mb-2 text-muted">Title</h6>
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <input name="title" class="form-control" placeholder="Title goes here..." />
                

                <h6 class="card-subtitle mb-2 text-muted">What is in your mind?</h6>
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <p class="card-text">
                    <textarea name="body" class="post-textarea" placeholder="Write something here..."></textarea>
                    <br/>
                    <p>
                        <label class="form-label">Post Image  </label>
                        <input name="image" type="file" class="form-control" />
                    </p>
                </p>
                <div class="buttons-container">
                    <button type="submit" class="btn btn-primary">Post</a>
                    <button type="button" class="btn btn-primary">Cancel</button>
                </div>
            </div>
        </div>
    </form>

@endsection