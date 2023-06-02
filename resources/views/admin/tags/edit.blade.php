<x-layout>
    <x-admin.setting :heading="'Edit Post: <small>' . $tag->name . '</small>'">
        <form method="POST" action="/admin/tags/{{ $tag->id }}" enctype="multipart/form-data">     
            @csrf
            @method('PATCH')

            {{-- name --}}
            <x-form.input :name="'name'" value="{{ old('name', $tag->name) }}" requried />
            
            <x-form.submit-button>Update</x-submit-button>

        </form>
    </x-admin.setting>
</x-layout>