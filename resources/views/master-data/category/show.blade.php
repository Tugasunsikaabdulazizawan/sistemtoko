<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Kategori
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <h3 class="text-lg font-semibold mb-2">
                    {{ $category->name }}
                </h3>

                <p class="text-sm text-gray-500 mb-4">
                    Total Produk: {{ $category->products->count() }}
                </p>

                <div class="bg-gray-50 rounded-md p-4 mb-6">
                    <p class="text-sm text-gray-500">
                        Total Stok Seluruh Produk
                    </p>
                    <p class="text-xl font-semibold">
                        {{ $totalStok }}
                    </p>
                </div>

                <h4 class="font-medium mb-2">Daftar Produk</h4>

                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-left">Kode</th>
                            <th class="px-3 py-2 text-left">Nama Produk</th>
                            <th class="px-3 py-2 text-right">Harga</th>
                            <th class="px-3 py-2 text-right">Stok</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($category->products as $product)
                            <tr>
                                <td class="px-3 py-2">
                                    {{ $product->code }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ $product->name }}
                                </td>
                                <td class="px-3 py-2 text-right">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="px-3 py-2 text-right">
                                    {{ $product->stock }} {{ $product->unit }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="px-3 py-4 text-center text-gray-500">
                                    Belum ada produk dalam kategori ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </x-card>
        </div>
    </div>
</x-app-layout>