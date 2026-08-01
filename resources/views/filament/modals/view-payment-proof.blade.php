<div class="p-4">
    @if($transaction->bukti_transfer_path)
        <img src="{{ Storage::url($transaction->bukti_transfer_path) }}" 
             alt="Bukti Transfer" 
             class="max-w-full h-auto rounded-lg shadow-lg mx-auto">
        
        <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
            <p><strong>Member:</strong> {{ $transaction->user->name }}</p>
            <p><strong>Nominal:</strong> Rp {{ number_format($transaction->nominal, 0, ',', '.') }}</p>
            <p><strong>Durasi:</strong> {{ $transaction->durasi_bulan }} Bulan</p>
            <p><strong>Tanggal:</strong> {{ $transaction->tanggal_transaksi->format('d M Y') }}</p>
        </div>
    @else
        <div class="text-center py-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="mt-2 text-gray-500 dark:text-gray-400">Bukti transfer belum diupload</p>
        </div>
    @endif
</div>
