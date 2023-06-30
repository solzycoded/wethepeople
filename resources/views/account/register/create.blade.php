<x-layout>

    <section class="px-6 py-8"> 
        {{-- bg-gray-100 border border-gray-200 p-6 rounded-xl --}}
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>

                <h1 class="text-center font-bold text-xl">Register!</h1>

                <form method="POST" action="/register" class="mt-10">
                    @csrf
                    
                    @if($errors->any())
                        <ul class="mb-15">
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500 text-xs mt-1">* {{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- name -->
                    <x-form.input :name="'name'" />
                    <!-- username -->
                    <x-form.input :name="'username'" />
                    <!-- email -->
                    <x-form.input :name="'email'" type="email" autocomplete="username" />
                    <!-- password -->
                    <x-form.input :name="'password'" type="password" autocomplete="new-password" />
                    
                    <!-- submit button -->
                    <x-form.submit-button>Submit</x-form.submit-button>
                </form>

            </x-panel>
        </main>
    </section>

</x-layout>