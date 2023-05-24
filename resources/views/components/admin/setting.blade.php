@props(['heading'])

<section class="py-8 max-w-4xl mx-auto">
    <h2 class="text-lg font-bold mb-8 pb-2 border-b">
        {!! $heading !!}
    </h2>

    <div class="flex">

        {{-- side bar --}}
        <aside class="w-48 flex-shrink-0">
            {{-- HEADER --}}
            <h4 class="font-semibold mb-4">Links</h4>

            <ul>
                @php
                    $links = [
                            ['title' => 'All Posts', 'link' => 'posts'], 
                            ['title' => 'New Post', 'link' => 'posts/create']
                        ];
                @endphp

                @foreach($links as $link)
                    @php
                        $sidebar = $link;
                    @endphp

                    <li>
                        <a href="/admin/{{ $sidebar['link'] }}" class="{{ request()->is('admin/' . $sidebar['link']) ? 'text-blue-500' : '' }}">
                            {{ $sidebar['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        {{-- main section --}}
        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>

    </div>
</section>