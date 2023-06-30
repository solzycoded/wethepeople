@props(['postTag'])

@php
    $tag = $postTag->tag;
@endphp

<a href="?tag={{ $tag->slug }}" class="text-blue-300 text-xs uppercase font-semibold mr-4 p-0" style="font-size: 8px;">
    #{{ $tag->name }}
</a>