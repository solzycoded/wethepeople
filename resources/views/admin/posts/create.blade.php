<x-layout>
    <x-admin.setting heading="Publish New Post">
        <form method="POST" action="/portfolios/wethepeople/public/admin/posts" enctype="multipart/form-data">
            @csrf

            {{-- title --}}
            <x-form.input :name="'title'" maxlength="120" required />

            {{-- thumbnail --}}
            <x-form.input :name="'thumbnail'" type="file" required />
            
            {{-- excerpt (TEXTAREA) --}}
            <x-form.textarea :name="'excerpt'">
                {{ old('excerpt') }}
            </x-form.textarea>
            
            {{-- body (TEXTAREA) --}}
            <x-form.textarea :name="'body'">
                {{ old('body') }}
            </x-form.textarea>
   
            {{-- category (SELECT) --}}
            <x-form.field class="mb-6">

                @php
                    $title = 'category';
                @endphp

                <x-form.label :name="$title" />
                
                <select name="category_id" id="{{ $title }}" required>
                    <option value="" selected>Choose a category</option>
                    
                    @foreach ($categories as $category)
                        <option {{ old('category_id')==$category->id ? 'selected' : '' }} 
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
                
                <select name="tag_ids[]" id="{{ $title }}" multiple>
                    @foreach ($tags as $tag)
                        <option {{ old('tag_ids')==$tag->id ? 'selected' : '' }} 
                            value="{{ $tag->id }}">
                            {{ ucwords($tag->name) }}
                        </option>
                    @endforeach
                </select>
                <p>
                    <small>
                        Can't find the tag, you want? Create one 
                        <a href="{{ env('WEB_URL_PREFIX') }}admin/tags/create" class="text-blue-500">here</a>
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
                        <option {{ old('status_id')==$status->id ? 'selected' : '' }} 
                            value="{{ $status->id }}">
                            {{ ucwords($status->name) }}
                        </option>
                    @endforeach
                </select>

                <x-form.error :name="'status_id'" />

            </x-form.field>

            <x-form.submit-button>Publish</x-submit-button>
        </form>
    </x-admin.setting>
</x-layout>