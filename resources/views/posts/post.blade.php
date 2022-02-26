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

        .top-container {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: left;
        }

        .form-inline {
            display: block-inline;
            margin: 0;
            padding: 0;
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
            $('#deleteModal').modal({
                show: true,
                backdrop: 'static'
            })
            $("#deleteModal .btn-cancel,#deleteModal .close").click(function() {
                $('#deleteModal').modal('hide');
            })
            $("#deleteModal .btn-delete").click(function() {
                $(".deleteForm").submit()
            })
            $(".deleteForm button").click(function() {
                $('#deleteModal').modal('show');
            })
        })
    </script>
@endsection

@section('content')
    <div class="top-container">
        <a href="/posts" class="btn btn-primary">View All Posts</a>
    </div>
    <br />
    <div class="post card">
        <div class="card-body">
            <div class="card-header title">
                {{ $post->title }}
            </div>
            <pre class="body">
                                                                                                                                                                                {{ $post->body }}
                                                                                                                                                                            </pre>
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
            @if (isset($post->image) && strlen(trim($post->image)) != 0)
                <img class="image" src="{{ $post->image }}" alt="" onerror="this.onerror=null; this.remove();" />
            @endif
            <br />
            <br />
            <div class="footer">
                @if (Auth::user()->type == 'admin')
                    <label
                        class="p-1 mb-2 text-light {{ $post->published ? 'bg-success' : 'bg-dark' }}">{{ $post->published ? 'published' : 'not published' }}</label>
                    <div class="buttons-container">
                        <form class="form-inline" method="POST" action="/posts/publish/{{ $post->id }}">
                            @csrf
                            <button
                                class='btn {{ $post->published ? 'btn-danger' : 'btn-success' }}'>{{ $post->published ? 'unpublish' : 'publish' }}</button>
                        </form>
                        <form class="form-inline" method="GET" action="/posts/edit/{{ $post->id }}">
                            @csrf
                            <button class='btn btn-secondary'>Edit</button>
                        </form>
                        <form class="deleteForm" class="form-inline" method="POST"
                            action="/posts/delete/{{ $post->id }}">
                            @csrf
                            <button type="button" class='btn btn-danger'>Delete</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br />


    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete a post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you want to delete the post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
