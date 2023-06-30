@props(['time'])

<p {{ $attributes(["class" => "mt-2 block text-gray-400 text-xs"]) }}>
    <i class="bi bi-calendar-event-fill"></i> 
    Published <time> {{ $time->diffForHumans() }}</time>
</p>