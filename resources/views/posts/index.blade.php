@extends('layout')

@section('content')
    <div class="row">
        <div class="col-8">
            @forelse ($posts as $post)
                <div class="mb-4">
                    <h3>
                        @if ($post->trashed())
                            <del>
                        @endif
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                        @if ($post->trashed())
                            </del>
                        @endif
                    </h3>

                    <p class="text-muted">Added {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>

                    @if ($post->comments_count)
                        <p>{{ $post->comments_count }} comments</p>
                    @else
                        <p>No comments yet!</p>
                    @endif

                    @can('update', $post)
                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary btn-sm">
                            Edit
                        </a>
                    @endcan

                    {{-- @cannot('delete', $post)
                <p>You cannot delete the post.</p>
            @endcannot --}}
                    @if (!$post->trashed())
                        @can('delete', $post)
                            <form method="POST" class="fm-inline"
                                action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                                @csrf
                                @method('DELETE')

                                <input type="submit" value="Delete!" class="btn btn-primary btn-sm" />
                            </form>
                        @endcan
                    @endif

                </div>
            @empty
                <p>No blog posts yet!</p>
            @endforelse
        </div>
        <div class="col-4">
            <div class="container">
                <div class="row">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Commented</h5>
                            <h6 class="card-subtitle mb-2 text-muted">What people are currently talking about</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse ($mostCommented as $comment)
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', ['post' => $comment->id]) }}">
                                        {{ $comment->title }}
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item">No content yet!</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Active</h5>
                            <h6 class="card-subtitle mb-2 text-muted">User with most posts written.</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse ($mostActive as $user)
                                <li class="list-group-item">
                                    {{ $user->name }}
                                </li>
                            @empty
                                <li class="list-group-item">No content yet!</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Active Last Month</h5>
                            <h6 class="card-subtitle mb-2 text-muted">User with most posts written in the last month.</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse ($mostActiveLastMonth as $user)
                                <li class="list-group-item">
                                    {{ $user->name }}
                                </li>
                            @empty
                                <li class="list-group-item">No content yet!</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
