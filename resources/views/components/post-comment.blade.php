@props(['comment'])

<x-panel class="bg-gray-100">
    <article class="flex space-x-4">

        <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc/100?img={{ $comment->id }}" alt="" width="60" height="60" class="rounded-xl">
        </div>

        <div>
            <header class="mb-4">
                <h3 class="font-bold">{{ $comment->author->username }}</h3>
                
                <p class="text-xs">
                    Posted
                    <time>{{ $comment->created_at }}<!-- 8 months ago --></time>    
                </p>

                <p>{{ $comment->body }}</p>
            </header>
        </div>

    </article>
</x-panel> 