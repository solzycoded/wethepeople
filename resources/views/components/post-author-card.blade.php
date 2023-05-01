@props(['post'])

@php
    $author = $post->author
@endphp 

<h5 class="font-bold">
    <a href="/?author={{ $author->username }}">
        {{ $author->name }}
    </a>
</h5>