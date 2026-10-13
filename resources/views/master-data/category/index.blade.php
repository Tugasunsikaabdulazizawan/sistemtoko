<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Data Kategori
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
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