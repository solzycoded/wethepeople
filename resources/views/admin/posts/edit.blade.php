<x-layout>
    <x-admin.setting :heading="'Edit Post: <small>' . $post->title . '</small>'">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">     
            @csrf
            @method('PATCH')
            
            {{-- title --}}
            <x-form.input :name="'title'" value="{{ old('title', $post->title) }}" maxlength="120" />
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
            <x-form.textarea :name="'excerpt'">{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
            {{-- body (TEXTAREA) --}}
            <x-form.textarea :name="'body'">{{ old('body', $post->body) }}</x-form.textarea>
   
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

            {{-- tags (SELECT) --}}
            <x-form.field class="mb-6">

                @php
                    $title = 'tags';
                @endphp

                <x-form.label :name="$title" />

                {{-- I NEED to check, if any of the "id's" in "tags", exists in "tagIds" --}}

                {{-- check if tag_id exists, in $post->postTags --}}
                <select name="tag_ids[]" id="{{ $title }}" multiple>
                    @foreach ($tags as $tag)
                        <option 
                            {{ in_array($tag->id, (array) old('tag_ids')) || $tag->tagExists($post->id) ? 'selected' : '' }}
                            value="{{ $tag->id }}" >
                            {{ ucwords($tag->name) }}
                        </option>
                    @endforeach
                </select>
                <p>
                    <small>
                        Can't find the tag, you want? Create one 
                        <a href="admin/tags/create" class="text-blue-500">here</a>
                    </small>
                </p>

                <x-form.error :name="'tag_ids'" />

            </x-form.field>
            
            {{-- status (SELECT) --}}
            <x-form.field class="mb-6">

                @php
                    $title = 'status';
                @endphp

                <x-form.label :name="$title" />
                
                <select name="status_id" id="{{ $title }}" required>
                    <option value="" selected>Choose a status</option>
                    
                    @foreach ($status as $status)
                        <option {{ old('status_id', $post->status_id)==$status->id ? 'selected' : '' }} 
                            value="{{ $status->id }}">
                            {{ ucwords($status->name) }}
                        </option>
                    @endforeach
                </select>

                <x-form.error :name="'status_id'" />

            </x-form.field>

            <x-form.submit-button>Save</x-submit-button>

        </form>
    </x-admin.setting>
</x-layout>