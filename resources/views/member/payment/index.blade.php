<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-500">
                        💳 Riwayat Transaksi
                    </h1>
                    <p class="text-gray-400 mt-2">Lihat status pembayaran Anda</p>
                </div>
                <a href="{{ route('member.payment.create') }}" 
                   class="bg-gradient-to-r from-cyan-500 to-purple-500 text-white px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all">
                    + Pembayaran Baru
                </a>
            </div>

            <!-- Transactions List -->
            @if($transactions->count() > 0)
                <div class="space-y-4">
                    @foreach($transactions as $transaction)
                        <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 hover:border-gray-600 transition-all">
                            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    @if($transaction->bukti_transfer_path)
                                        <img src="{{ Storage::url($transaction->bukti_transfer_path) }}" 
                                             alt="Bukti" class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gray-700 rounded-lg flex items-center justify-center">
                                            <span class="text-2xl">📄</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-white font-bold text-lg">
                                            Rp {{ number_format($transaction->nominal, 0, ',', '.') }}
                                        </p>
                                        <p class="text-gray-400 text-sm">
                                            {{ $transaction->durasi_bulan }} Bulan • {{ $transaction->tanggal_transaksi->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-4">
                                    @if($transaction->status === 'pending')
                                        <span class="px-4 py-2 bg-yellow-900/50 text-yellow-400 rounded-xl text-sm font-medium">
                                            ⏳ Menunggu Verifikasi
                                        </span>
                                    @elseif($transaction->status === 'approved')
                                        <span class="px-4 py-2 bg-green-900/50 text-green-400 rounded-xl text-sm font-medium">
                                            ✅ Disetujui
                                        </span>
                                    @else
                                        <span class="px-4 py-2 bg-red-900/50 text-red-400 rounded-xl text-sm font-medium">
                                            ❌ Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($transaction->status === 'rejected' && $transaction->catatan_admin)
                                <div class="mt-4 bg-red-900/30 border border-red-800 rounded-xl p-4">
                                    <p class="text-red-400 text-sm">
                                        <strong>Alasan:</strong> {{ $transaction->catatan_admin }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $transactions->links() }}
                </div>
            @else
                <div class="bg-gray-800 rounded-2xl p-12 text-center border border-gray-700">
                    <div class="text-6xl mb-4">💳</div>
                    <h3 class="text-xl font-bold text-white mb-2">Belum Ada Transaksi</h3>
                    <p class="text-gray-400 mb-6">Anda belum melakukan pembayaran apapun</p>
                    <a href="{{ route('member.payment.create') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-cyan-500 to-purple-500 text-white px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all">
                        + Buat Pembayaran Pertama
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
