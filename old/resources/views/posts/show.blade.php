<x-layout>
    <section class="px-6 py-8">
       
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">

            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-5 lg:text-center lg:pt-14 mb-10">
                    {{-- bookmark post --}}
                    <x-post.bookmark :post="$post" />

                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Post image" class="rounded-xl single-post-image">

                    {{-- Time & Date of post --}}
                    <x-post.status :time="$post->published_at" class="mt-4 text-left" />
                    
                    {{-- No of views --}}
                    <span class="mt-2 block text-gray-400 text-xs text-left">
                        <i class="bi bi-eye-fill"></i>
                        {{ number_format($post->views_count) }} views
                    </span>

                    <div class="flex items-center lg:justify-left text-sm mt-4">
                        <x-post-author-card :post="$post" class="text-left" />
                    </div>
                </div>

                <div class="col-span-7">
                    <div class="hidden lg:flex justify-between mb-6">
                        <a href="{{ env('WEB_URL_PREFIX') }}"
                            class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                        d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>

                            Back to Posts
                        </a>
                    </div>

                    <div class="flex justify-between">
                        <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                            {{ $post->title }}
                        </h1>

                        <div class="space-x-2">
                            <x-category-button :category="$post->category" />
                        </div>
                    </div>

                    <div class="space-y-4 lg:text-lg leading-loose">
                        {{ $post->body }}
                    </div>

                    <x-tags.show :tags="$post->postTags" :all="true" class="mt-7" />
                </div>
            </article>
            
            <hr>

            <!-- comments -->
            <section class="col-span-8 col-start-5 mt-20 space-y-6">
                <!-- comments form -->
                @include('posts._add-comment-form')
                
                <!-- comments display -->
                @foreach($post->comments as $comment)
                    <x-post-comment :comment="$comment" :isAuthor="$comment->user_id==$post->user_id" />
                @endforeach
            </section>
            <!-- END comments -->
        </main>

    </section>
</x-layout>