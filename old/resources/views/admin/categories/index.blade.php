<x-admin.index.table :title="'categories'">
    @foreach($categories as $category)
        <tr>
            <x-admin.index.table-column>
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900">
                        <a href="{{ env('WEB_URL_PREFIX') }}?category={{ $category->slug }}">
                            {{ $category->name }}
                        </a>
                    </div>
                </div>
            </x-admin.index.table-column>

            <x-admin.index.table-column class="text-right text-sm font-medium">
                <a href="{{ env('WEB_URL_PREFIX') }}admin/categories/{{ $category->id }}/edit" class="text-blue-500 hover:text-blue-600">
                    Edit
                </a>
            </x-admin.index.table-column>

            <x-admin.index.table-column class="text-right text-sm font-medium">
                <form method="POST" action="/portfolios/wethepeople/public/admin/categories/{{ $category->id }}">
                    @csrf
                    @method('DELETE')

                    <button class="text-xs text-red-500">Delete</button>
                </form>
            </x-admin.index.table-column>
        </tr>
    @endforeach
</x-admin.index.table>