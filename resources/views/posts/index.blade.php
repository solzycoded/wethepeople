<x-layout>
    @include ('posts._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6"> 
        
        @if($posts->count())
            <x-posts.heading :author="$posts[0]->author" />

            {{ $posts->links() }}
            
            <x-posts.grid :posts="$posts" />

            {{ $posts->links() }}
        @else
            <p class="text-center">
                @if(request()->is('bookmarks'))
                    You currently don't have any bookmarked / saved posts.<br><br>You can select a post <a href="" class="text-blue-500">here</a>
                @else
                    No posts yet. Please check back later.
                @endif
            </p>
        @endif
    </main>

</x-layout>