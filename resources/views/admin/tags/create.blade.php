<x-layout>
    <x-admin.setting heading="Create New Tag">
        <form method="POST" action="/admin/tags" enctype="multipart/form-data">
            @csrf

            {{-- tag --}}
            <x-form.input :name="'name'" maxlength="100" required />

            <x-form.submit-button>Create</x-submit-button>
        </form>
    </x-admin.setting>
</x-layout>