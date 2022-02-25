@extends('layouts.general.index')
 
@section('title', 'Admin Panel')
 
@section('sidebar')
    @parent
@endsection

@section('styles')
    <style>
        .post{
            width:80%;
            background-color:#F76E11;
        }
        .post .post-title{
            text-align:center;
            color:white;
            font-size 160%;
            font-weight:bold;
        }
        .post .post-body{
            width:100%;
            background-color:transparent;
            border:1px solid black;
            resize:none;
        }
        .post .post-image{
            width:100%;
        }
    </style>
@endsection
 
@section('scripts')
    <script>
        $(document).ready(function(){

        })
    </script>
@endsection

@section('content')
    @foreach($posts as $post)
        <div class="post card">
            <div class="card-body">
                <div class="card-header post-title">
                    {{$post->title}}
                </div>
                <pre class="post-body">
                    {{$post->body}}
                </pre>
                @if($post->categories)
                    <input type="text" class="post-categories" value="{{$post->categories}}" />
                @endif
                @if($post->image && strlen(trim($post->image))!=0)
                    <img class="post-image" src="{{$post->image}}" alt="" onerror="this.onerror=null; this.remove();" />
                @endif
            </div>
        </div>
        <br/>
    @endforeach
@endsection