@props(['post'])

@auth
    @php
        // has the logged in user, bookmarked this post
        $bookmarked = auth()->user()->savedPost($post->id);
    @endphp

    <div class="bookmark p-0 bg-white rounded-full m-0 ml-3 mt-2" 
        style="position: absolute; font-size: 25px; cursor: pointer" 
        x-data="{bookmarked: {{ $bookmarked ? 'true' : 'false' }}}">

        <button type="button" 
            class="text-blue-500 font-semibold rounded-2xl hover:text-blue-"
            @click="bookmarked = !bookmarked"
            post-id="{{ $post->id }}"
            id="bookmark-post">
            <i class="bi" :class="!bookmarked ? 'bi-bookmark-plus' : 'bi-bookmark-x-fill'"></i>
        </button>

    </div>
@endauth