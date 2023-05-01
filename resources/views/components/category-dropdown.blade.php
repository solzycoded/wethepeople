<x-dropdown>
    <!-- trigger -->
    <x-slot name="trigger">
        <button @click="show = !show" class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 flex text-left lg:inline-flex">

            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}
            <x-down-arrow class="absolute pointer-events-none" style="right: 12px;" />

        </button>
    </x-slot>
    
    @php
        $searchQuery = http_build_query(request()->except('category', 'page'));

        if(!empty($searchQuery)){
            $searchQuery = '&' . $searchQuery;
        }
    @endphp

    <!-- links -->
    <x-dropdown-item 
        href="/?{{ $searchQuery }}" 
        :active="request()->routeIs('home')">
        All
    </x-dropdown-item> 
    
    @foreach ($categories as $category)
        @php
            $slug = "categories/{$category->slug}";
            $isSlug = request()->is($slug);
        @endphp 

        <x-dropdown-item 
            href="/?category={{ $category->slug }}{{ $searchQuery }}" 
            :active="$isSlug">
            {{ ucwords($category->name) }}
        </x-dropdown-item>

    @endforeach
</x-dropdown>