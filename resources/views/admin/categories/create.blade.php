<x-layout>
    <x-admin.setting heading="Create New Category">
        <form method="POST" action="/admin/categories" enctype="multipart/form-data">
            @csrf

            {{-- category --}}
            <x-form.input :name="'name'" maxlength="100" required />

            <x-form.submit-button>Create</x-submit-button>
        </form>
    </x-admin.setting>
</x-layout>