@props(['post'])

<article {{ $attributes->merge(['class' => "transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl"]) }}>

    <div class="py-6 px-5">
        <div>
            <img src="{{ asset('/storage/' . $post->thumbnail) }}" alt="Blog Post illustration" class="rounded-xl post-card-image">
        </div>

        <div class="mt-8 flex flex-col justify-between">
            <header>
                <div class="space-x-2">
                    <x-category-button :category="$post->category" />
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="{{ env('WEB_URL_PREFIX') }}posts/{{ $post->slug }}">
                            {{ $post->title }}
                        </a>
                    </h1>

                    <x-post.status :time="$post->published_at" />
                </div>
            </header>

            <div class="text-sm mt-4 space-y-4">
                <p>
                    {!! $post->excerpt !!}
                </p>
                
                <x-tags.show :tags="$post->postTags" />
            </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <x-post-author-card :post="$post" />
                </div>

                <div>
                    <a href="{{ env('WEB_URL_PREFIX') }}posts/{{ $post->slug }}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >Read More</a>
                </div>
            </footer>

        </div>

    </div>
</article>