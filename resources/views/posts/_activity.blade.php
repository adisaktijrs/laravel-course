<div class="container">
    <div class="row">
        @card(['title' => 'Most Commented'])
            @slot('subtitle')
                What people are currently talking about
            @endslot
            @slot('items')
                @forelse ($mostCommented as $comment)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', ['post' => $comment->id]) }}">
                            {{ $comment->title }}
                        </a>
                    </li>
                @empty
                    <li class="list-group-item">No content yet!</li>
                @endforelse
            @endslot
        @endcard
    </div>

    <div class="row mt-4">
        @card(['title' => 'Most Active'])
            @slot('subtitle')
                Writers with most posts written
            @endslot
            @slot('items', collect($mostActive)->pluck('name'))
        @endcard
    </div>

    <div class="row mt-4">
        @card(['title' => 'Most Active Last Month'])
            @slot('subtitle')
                User with most posts written in the last month
            @endslot
            @slot('items', collect($mostActiveLastMonth)->pluck('name'))
        @endcard
    </div>
</div>