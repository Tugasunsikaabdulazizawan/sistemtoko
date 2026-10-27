<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Data Kategori
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">
                                    No.
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">
                                    Nama Kategori
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">
                                    Jumlah Produk
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $categories->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $category->name }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-center">
                                        <span class="px-2 py-1 rounded-full bg-indigo-100 text-indigo-700">
                                            {{ $category->products_count }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-center whitespace-nowrap">

                                        <a href="{{ route('categories.show', $category) }}"
                                            class="text-gray-600 hover:text-gray-900">
                                            Detail
                                        </a>

                                        <a href="{{ route('categories.edit', $category) }}"
                                           class="text-indigo-600 hover:text-indigo-800 mr-3">
                                            Ubah
                                        </a>

                                        <form action="{{ route('categories.destroy', $category) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori {{ $category->name }}?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-800">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"
                                        class="px-4 py-6 text-center text-gray-500">
                                        Belum ada data kategori.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>