<x-layout>
    <x-admin.setting :heading="'Edit Post: <small>' . $post->title . '</small>'">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">     
            @csrf
            @method('PATCH')

            {{-- title --}}
            <x-form.input :name="'title'" value="{{ old('title', $post->title) }}" />
            {{-- slug --}}
            <x-form.input :name="'slug'" value="{{ old('slug', $post->slug) }}" />
            {{-- thumbnail --}}
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input :name="'thumbnail'" type="file" value="{{ old('thumbnail', $post->thumbnail) }}" />
                </div>
                
                <img src="{{ asset('storage/' . $post->thumbnail) }}" 
                    alt="" 
                    class="rounded-xl ml-6" 
                    width="100" />
            </div>
            
            {{-- excerpt (TEXTAREA) --}}
            <x-form.textarea :name="'excerpt'">
                {{ old('excerpt', $post->excerpt) }}
            </x-form.textarea>
            {{-- body (TEXTAREA) --}}
            <x-form.textarea :name="'body'">
                {{ old('body', $post->body) }}
            </x-form.textarea>
   
            {{-- category (SELECT) --}}
            <x-form.field class="mb-6">

                @php
                    $title = 'category';
                @endphp

                <x-form.label :name="$title" />
                
                <select name="category_id" id="{{ $title }}">
                    <option value="" selected>Choose a category</option>
                    
                    @foreach ($categories as $category)
                        <option {{ old('category_id', $post->category_id)==$category->id ? 'selected' : '' }} 
                            value="{{ $category->id }}">
                            {{ ucwords($category->name) }}
                        </option>
                    @endforeach
                </select>

                <x-form.error :name="'category_id'" />

            </x-form.field>

            <x-form.submit-button>Publish</x-submit-button>

        </form>
    </x-admin.setting>
</x-layout>