<x-layout>
    <x-admin.setting heading="Publish New Post">
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf

            {{-- title --}}
            <x-form.input :name="'title'" />

            {{-- slug --}}
            <x-form.input :name="'slug'" />

            {{-- thumbnail --}}
            <x-form.input :name="'thumbnail'" type="file" />
            
            {{-- excerpt (TEXTAREA) --}}
            <x-form.textarea :name="'excerpt'" />

            {{-- body (TEXTAREA) --}}
            <x-form.textarea :name="'body'" />
   
            {{-- category (SELECT) --}}
            <x-form.field class="mb-6">

                @php
                    $title = 'category';
                @endphp

                <x-form.label :name="$title" />
                
                <select name="category_id" id="{{ $title }}">
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

            <x-form.submit-button>Publish</x-submit-button>
        </form>
    </x-admin.setting>
</x-layout>