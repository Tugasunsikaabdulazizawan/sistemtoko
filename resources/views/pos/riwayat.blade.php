<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Riwayat Transaksi Saya
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold">
                        Daftar Transaksi
                    </h3>

                    <a href="{{ route('pos.index') }}"
                       class="bg-indigo-600 text-white px-4 py-2 rounded-md">
                        Transaksi Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="p-3">No.</th>
                                <th class="p-3">Invoice</th>
                                <th class="p-3">Tanggal</th>
                                <th class="p-3">Total</th>
                                <th class="p-3">Bayar</th>
                                <th class="p-3">Kembalian</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr class="border-b">
                                    <td class="p-3">
                                        {{ $transactions->firstItem() + $loop->index }}
                                    </td>

                                    <td class="p-3">
                                        {{ $transaction->invoice_number }}
                                    </td>

                                    <td class="p-3">
                                        {{ $transaction->created_at->format('d-m-Y H:i') }}
                                    </td>

                                    <td class="p-3">
                                        Rp{{ number_format($transaction->total, 0, ',', '.') }}
                                    </td>

                                    <td class="p-3">
                                        Rp{{ number_format($transaction->pay, 0, ',', '.') }}
                                    </td>

                                    <td class="p-3">
                                        Rp{{ number_format($transaction->change, 0, ',', '.') }}
                                    </td>

                                    <td class="p-3">
                                        <a href="{{ route('pos.struk', $transaction) }}"
                                           class="text-indigo-600 hover:underline">
                                            Lihat Struk
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"
                                        class="p-4 text-center text-gray-500">
                                        Belum ada transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>