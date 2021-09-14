@extends('layout')

@section('content')
    <div class="row">
        <div class="col-8">
            @if ($post->image)
                <div class="mb-3">
                    <img class="img-fluid" src="{{ $post->image->url() }}" />
                </div>
            @endif
            <h1>
                {{ $post->title }}
        
                @badge([
                'type' => 'primary',
                'show' => now()->diffInMinutes($post->created_at) < 30])
                    A brand new post!
                @endbadge
            </h1>
        
            <p>{{ $post->content }}</p>

            {{-- <img src="{{ Storage::url($post->image->path) }}" /> --}}
        
        
            @updated(['date' => $post->created_at, 'name' => $post->user->name])
            @endupdated
        
            @updated(['date' => $post->updated_at])
                Updated
            @endupdated
        
            @tags(['tags' => $post->tags])
            @endtags
        
            <p>Currently read by {{ $counter }} people</p>
        
            <h4>Comments</h4>

            @include('comments._form')
        
            @forelse($post->comments as $comment)
                <p>
                    {{ $comment->content }}
                </p>
                {{-- <p class="text-muted">
                    added {{ $comment->created_at->diffForHumans() }}
                </p> --}}
        
                @updated(['date' => $comment->created_at, 'name' => $comment->user->name])
                @endupdated
            @empty
                <p>No comments yet!</p>
            @endforelse
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
    
@endsection('content')
