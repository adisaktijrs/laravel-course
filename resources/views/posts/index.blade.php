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

                    @updated(['date' => $post->created_at, 'name' => $post->user->name])
                    @endupdated

                    @tags(['tags' => $post->tags])
                    @endtags

                    @if ($post->comments_count)
                        <p>{{ $post->comments_count }} comments</p>
                    @else
                        <p>No comments yet!</p>
                    @endif

                    @auth
                        @can('update', $post)
                            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        @endcan
                    @endauth

                    {{-- @cannot('delete', $post)
                        <p>You cannot delete the post.</p>
                    @endcannot --}}

                    @auth
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
                    @endauth
                    

                </div>
            @empty
                <p>No blog posts yet!</p>
            @endforelse
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
@endsection('content')
