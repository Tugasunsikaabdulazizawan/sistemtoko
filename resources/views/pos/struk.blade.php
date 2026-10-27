<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Struk Transaksi</h2>
    </x-slot>

    <style>
        @media print {
            /* Sembunyikan navigasi dan elemen yang tidak perlu */
            nav,
            header,
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .print-area {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            @page {
                margin: 10mm;
            }
        }
    </style>

    <div class="py-8 print-area">
        <div class="max-w-md mx-auto sm:px-6">
            <x-card>
                <div class="receipt">
                    <p class="text-center font-semibold">
                        POS Barokah Mart
                    </p>

                    <p class="text-center text-xs text-gray-500 mb-3">
                        {{ $transaction->invoice_number }}
                    </p>

                    <p class="text-xs text-gray-500 mb-3">
                        {{ $transaction->created_at->format('d M Y H:i') }}
                        &middot;
                        Kasir: {{ $transaction->user->name }}
                    </p>

                    <hr class="mb-3">

                    @foreach ($transaction->details as $detail)
                        <div class="flex justify-between text-sm mb-1">
                            <span>
                                {{ $detail->product->name }}
                                x{{ $detail->qty }}
                            </span>
                            <span>
                                Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach

                    <hr class="my-3">

                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span>
                            Rp{{ number_format($transaction->total, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span>Bayar</span>
                        <span>
                            Rp{{ number_format($transaction->pay, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span>Kembali</span>
                        <span>
                            Rp{{ number_format($transaction->change, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div class="no-print mt-4 space-y-2">
                    <button
                        type="button"
                        onclick="window.print()"
                        class="w-full bg-indigo-600 text-white py-2 rounded-md">
                        Cetak Struk
                    </button>

                    <a
                        href="{{ route('pos.index') }}"
                        class="block text-center bg-gray-200 py-2 rounded-md">
                        Transaksi Baru
                    </a>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>