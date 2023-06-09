@props(['post'])

<p {{ $attributes(["class" => "mt-2 block text-gray-400 text-xs"]) }}>
    Published <time> {{ $post->published_at->diffForHumans() }}</time>
</p>