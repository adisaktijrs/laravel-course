@extends('layout')

@section('content')
    <div class="row">
        <div class="col-8">
            <h1>
                {{ $post->title }}
        
                @badge([
                'type' => 'primary',
                'show' => now()->diffInMinutes($post->created_at) < 30])
                    A brand new post!
                @endbadge
            </h1>
        
            <p>{{ $post->content }}</p>
        
        
            @updated(['date' => $post->created_at, 'name' => $post->user->name])
            @endupdated
        
            @updated(['date' => $post->updated_at])
                Updated
            @endupdated
        
            @tags(['tags' => $post->tags])
            @endtags
        
            <p>Currently read by {{ $counter }} people</p>
        
            <h4>Comments</h4>
        
            @forelse($post->comments as $comment)
                <p>
                    {{ $comment->content }}
                </p>
                {{-- <p class="text-muted">
                    added {{ $comment->created_at->diffForHumans() }}
                </p> --}}
        
                @updated(['date' => $comment->created_at])
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
