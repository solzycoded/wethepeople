<!doctype html>

<title>Laravel From Scratch Blog</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link href="{{ env('WEB_URL_PREFIX') }}css/app.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script src="//unpkg.com/alpinejs" defer></script>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="{{ env('WEB_URL_PREFIX') }}">
                    {{-- /images/logo.svg --}}
                    <img src="{{ env('WEB_URL_PREFIX') }}images/my/logo (no-bg).png" alt="wethepeople Logo" width="140" height="16">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @auth
                    <x-dropdown>

                        <x-slot name="trigger">
                            <button @click="show = !show" class="text-xs font-bold uppercase">
                                Welcome, {{ auth()->user()->name }}!
                            </button>
                        </x-slot>
                        
                        {{-- DROP DOWNs --}}
                        {{-- Home Page --}}
                        <x-dropdown-item href="{{ env('WEB_URL_PREFIX') }}" :active="request()->is('/')">
                            Home
                        </x-dropdown-item>
                        {{-- Home Page --}}
                        <x-dropdown-item href="{{ env('WEB_URL_PREFIX') }}bookmarks" :active="request()->is('bookmarks')">
                            Saved Posts
                        </x-dropdown-item>

                        {{-- ONLY FOR ADMIN --}}
                        @can('admin')
                            {{-- dashboard & new post --}}
                            @php
                                $prefix = 'admin/';
                                $dropDownMenus = [
                                    ['title' => 'Dashboard', 'link'   => $prefix . 'posts'],
                                    ['title' => 'New Post', 'link'    => $prefix . 'posts/create'],
                                    ['title' => 'Categories', 'link'  => $prefix . 'categories'],
                                    ['title' => 'Tags', 'link'        => $prefix . 'tags']
                                ];
                            @endphp
                            @foreach ($dropDownMenus as $item)
                                <x-dropdown-item href="/portfolios/wethepeople/public/{{ $item['link'] }}" :active="request()->is($item['link'])">
                                    {{ $item['title'] }}
                                </x-dropdown-item>
                            @endforeach
                        @endcan

                        {{-- log out --}}
                        <x-dropdown-item href="#"
                            x-data="{}"
                            @click.prevent="document.querySelector('#logout-form').submit()">
                            Log Out
                        </x-dropdown-item>
                        
                        <form id="logout-form" method="POST" action="{{ env('WEB_URL_PREFIX') }}logout" class="hidden">
                            @csrf
                        </form>
                    </x-dropdown>
                @else

                    <a href="{{ env('WEB_URL_PREFIX') }}register" class="text-xs font-bold uppercase">Register</a>
                    <a href="{{ env('WEB_URL_PREFIX') }}login" class="text-xs font-bold uppercase ml-3">Login</a>
                
                @endguest

                <a href="#newsletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a>
            </div>
        </nav>
        
        {{ $slot }}
        
        <footer id="newsletter" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            {{-- /images/lary-newsletter-icon.svg --}}
            <img src="{{ env('WEB_URL_PREFIX') }}images/my/icon (no-bg).png" alt="wethepeople icon" class="mx-auto -mb-1" style="width: 220px;">
            
            <h5 class="text-3xl">Stay in touch with the latest gist</h5>
            <p class="text-sm mt-3">Promise to keep the inbox clean. No spamming.</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                    <form method="POST" action="{{ env('WEB_URL_PREFIX') }}newsletter" class="lg:flex text-sm">
                        @csrf 

                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="{{ env('WEB_URL_PREFIX') }}images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <div>
                                <input id="email" 
                                    name="email"
                                    type="text" 
                                    placeholder="Your email address"
                                    class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                            </div>
                        </div>

                        <button 
                            type="submit"
                            class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8">
                            Subscribe
                        </button>
                    </form>
                    
                </div>
            </div>

            <!-- subscription error -->
            <div>
                @error('email')
                    <span class="text-xs text-red-500 font-bold">
                        {!! $message !!}
                    </span>
                @enderror
            </div>
        </footer>
    </section>

    <x-flash />
</body>

{{-- SCRIPTS --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script src="{{ env('WEB_URL_PREFIX') }}js/request/ajax.js"></script>

{{-- posts --}}
<script src="{{ env('WEB_URL_PREFIX') }}js/posts/follow-author.js"></script>
<script src="{{ env('WEB_URL_PREFIX') }}js/posts/posts.js"></script>

{{-- post --}}
<script src="{{ env('WEB_URL_PREFIX') }}js/post/bookmark/bookmark-post.js"></script>
<script src="{{ env('WEB_URL_PREFIX') }}js/post/bookmark/bookmark.js"></script>

{{-- ABOUT US IDEAS --}}
    {{-- 1. this is a platform of the people, built "for the people", by Solzy. on here feel free, to say what you want, tell your story, anonymously. --}}