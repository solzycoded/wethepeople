<x-admin.index.table :title="'Posts'">
    @foreach($posts as $post)
        <tr>
            <x-admin.index.table-column>
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900">
                        <a href="/posts/{{ $post->slug }}">
                            {{ $post->title }}
                        </a>
                    </div>
                </div>
            </x-admin.index.table-column>

            {{-- <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Published
                </span>
            </td> --}}

            <x-admin.index.table-column class="text-right text-sm font-medium">
                <a href="/admin/posts/{{ $post->id }}/edit" class="text-blue-500 hover:text-blue-600">
                    Edit
                </a>
            </x-admin.index.table-column>

            <x-admin.index.table-column class="text-right text-sm font-medium">

                <form method="POST" action="/admin/posts/{{ $post->id }}">
                    @csrf
                    @method('DELETE')

                    <button class="text-xs text-red-500">Delete</button>
                </form>
                
            </x-admin.index.table-column>
        </tr>
    @endforeach
</x-admin.index.table>