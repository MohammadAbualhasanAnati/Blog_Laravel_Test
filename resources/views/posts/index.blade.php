@extends('layouts.general.index')

@section('title', 'Admin Panel')

@section('sidebar')
    @parent
@endsection

@section('styles')
    <style>
        .post {
            width: 80%;
            background-color: #F76E11;
        }

        .post .title {
            text-align: center;
            color: white;
            font-size 160%;
            font-weight: bold;
        }

        .post .body {
            width: 100%;
            background-color: transparent;
            border: 1px solid black;
            resize: none;
        }

        .post .image {
            width: 100%;
            height: 400px;
        }

        .post .categories {
            width: 90%;
        }

        .post .category {
            border: 1px dashed black;
            background-color: grey;
            color: white;
        }

        .post .footer {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .post .publish-container {
            display: flex;
            flex-direction: column;
        }

        .footer .buttons-container {
            display: flex;
            flex-direction: row;
            gap: 10px;
        }

    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

        })
    </script>
@endsection

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @foreach ($posts as $post)
        <div class="post card">
            <div class="card-body">
                <div class="card-header title">
                    {{ $post->title }}
                </div>
                <pre class="body">{{ $post->body }}</pre>
                <br />
                @if (isset($post->image) && strlen(trim($post->image)) != 0)
                    <img class="image" src="{{ $post->image }}" alt=""
                        onerror="this.onerror=null; this.remove();" />
                @endif
                <br />
                <br />
                @if ($post->categories && count($post->categories) > 0)
                    <span class="form-label text-muted">Categories</span>
                    <br />
                    <div class="categories">
                        @foreach ($post->categories as $category)
                            <span class="category">{{ $category }}</span>
                        @endforeach
                    </div>
                @endif
                <br />
                <div class="footer">
                    @if (Auth::user()->type == 'admin')
                        <label
                            class="p-1 mb-2 text-light {{ $post->published ? 'bg-success' : 'bg-dark' }}">{{ $post->published ? 'published' : 'not published' }}</label>
                        <br />
                        <div class="buttons-container">
                            <a href="/posts/edit/{{ $post->id }}" class="btn btn-secondary">Edit Post</a>
                            <a href="/posts/view/{{ $post->id }}" class="btn btn-light">View Post</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <br />
    @endforeach
@endsection
