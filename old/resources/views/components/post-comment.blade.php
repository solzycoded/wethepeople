@props(['comment', 'isAuthor'])

<x-panel class="bg-gray-100">
    <article class="flex space-x-4">

        <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc/100?img={{ $comment->user_id }}" alt="Comment user image" width="60" height="60" class="rounded-xl">
        </div>

        <div>
            <header class="mb-4">
                <h3 class="font-bold">
                    {{ $comment->author->username }} 
                    {!! $isAuthor ? '<small class="text-green-400 ml-0.5" style="font-size: 10px !important;">AUTHOR</small>' : '' !!} 
                </h3>
                
                <p class="text-xs">
                    <small>Posted</small>
                    <time>{{ $comment->created_at->diffForHumans() }}</time>
                </p>

                <p>{{ $comment->body }}</p>
            </header>
        </div>

    </article>
</x-panel> 