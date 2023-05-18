<x-panel>
    <form method="POST" action="/posts/{{ $post->slug }}/comment">
        @csrf

        <header class="flex items-center">
            <img src="https://i.pravatar.cc/60" alt="" width="40" height="40" class="rounded-full">

            <h2 class="ml-3">Want to participate?</h2>
        </header>

        
        @auth
            <div class="mt-6">
                <textarea 
                    name="body" 
                    class="w-full text-sm focus:outline-none focus:ring" 

                    rows="5" 
                    placeholder="Quick, think of something to say!" 
                    required></textarea>

                @error('body')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">       
                <x-form.submit-button>Post</x-submit-button>
            </div>
        @else
            <div class="mt-5">
                <p class="font-semibold">
                    <a href="/login" class="text-blue-600 hover:underline">Login</a> 
                    <small>or</small>
                    <a href="/register" class="text-blue-600 hover:underline">Register</a>
                </p>
            </div>
        @endauth
    </form>
</x-panel>