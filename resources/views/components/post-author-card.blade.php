@props(['post'])

@php
    $author = $post->author
@endphp 

{{-- /images/lary-avatar.svg --}}
<img src="https://i.pravatar.cc/100?img={{ $post->author->id }}" alt="Author image" class="rounded-full" width="40" height="40">
                    
<div {{ $attributes(['class' => "ml-3"]) }}>
    <h5 class="font-bold">
        <a href="?author={{ $author->username }}" class="capitalize">
            {{ $author->name }}
        </a>
    </h5>
    <h6>Mascot at wethepeople</h6>
</div> 