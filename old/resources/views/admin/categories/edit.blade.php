<x-layout>
    <x-admin.setting :heading="'Edit Post: <small>' . $category->name . '</small>'">
        <form method="POST" action="/portfolios/wethepeople/public/admin/categories/{{ $category->id }}" enctype="multipart/form-data">     
            @csrf
            @method('PATCH')

            {{-- name --}}
            <x-form.input :name="'name'" value="{{ old('name', $category->name) }}" maxlength="100" requried />
            
            <x-form.submit-button>Update</x-submit-button>

        </form>
    </x-admin.setting>
</x-layout>