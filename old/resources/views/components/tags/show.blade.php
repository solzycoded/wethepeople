@props(['tags', 'all' => false])

<section {{ $attributes(['class' => 'flex items-left p-0']) }}>

    @for ($i = 0; $i < count($tags); $i++)
        @if (!$all && $i==5)
            @break
        @endif

        <x-tags.tag :postTag="$tags[$i]" />
    @endfor

</section>