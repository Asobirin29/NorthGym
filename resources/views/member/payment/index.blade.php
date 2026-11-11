<x-app-layout>
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Telemetry Block -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-glass border border-border-default mb-3 backdrop-blur-md rounded">
                    <span class="w-1.5 h-1.5 bg-primary-container rounded-none pulse-volt"></span>
                    <span class="font-label-tag text-label-tag text-text-muted tracking-widest uppercase">
                        [ MODULE.05 // BILLING & FAST-PASS SETTLEMENT ]
                    </span>
                </div>
                <h1 class="text-display-section-mobile md:text-headline-lg font-headline-lg font-extrabold uppercase tracking-tight text-text-primary">
                    TRANSACTION <span class="text-primary-container">LEDGER</span>.
                </h1>
                <p class="font-body-base text-text-secondary text-sm md:text-base mt-2 max-w-2xl">
                    Rekap riwayat aktivasi keanggotaan gym, konfirmasi pembayaran bukti transfer, dan status verifikasi akses fast-pass Anda.
                </p>
            </div>
            <div>
                <a href="{{ route('member.payment.create') }}" 
                   class="h-[46px] px-6 bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-label-code text-xs uppercase tracking-wider font-extrabold rounded flex items-center justify-center gap-2 neon-glow-btn transition-all duration-200">
                    <span class="material-symbols-outlined text-base">add_card</span>
                    <span>PERPANJANG / PEMBAYARAN BARU</span>
                </a>
            </div>
        </div>

        <!-- Transactions List -->
        @if($transactions->count() > 0)
            <div class="space-y-4">
                @foreach($transactions as $transaction)
                    <div class="bg-surface-card border border-border-default rounded p-6 backdrop-blur-md hover:border-primary-container/40 transition-all">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                @if($transaction->bukti_transfer_path)
                                    <a href="{{ Storage::url($transaction->bukti_transfer_path) }}" target="_blank" class="block group relative">
                                        <img src="{{ Storage::url($transaction->bukti_transfer_path) }}" 
                                             alt="Bukti Transfer" class="w-16 h-16 object-cover rounded border border-border-default group-hover:border-primary-container transition-all">
                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity rounded">
                                            <span class="material-symbols-outlined text-white text-sm">visibility</span>
                                        </div>
                                    </a>
                                @else
                                    <div class="w-16 h-16 bg-surface-container-lowest border border-border-default rounded flex items-center justify-center text-text-muted">
                                        <span class="material-symbols-outlined text-2xl">receipt</span>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-headline-sm font-extrabold text-xl text-text-primary">
                                        Rp {{ number_format($transaction->nominal, 0, ',', '.') }}
                                    </div>
                                    <div class="font-label-meta text-xs text-text-muted uppercase tracking-wider mt-0.5">
                                        DURASI: <span class="text-primary-container font-bold">{{ $transaction->durasi_bulan }} BULAN</span> 
                                        &bull; {{ $transaction->tanggal_transaksi->format('d M Y') }}
                                        &bull; TRX #{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3">
                                @if($transaction->status === 'pending')
                                    <span class="px-3 py-1.5 rounded font-label-meta text-xs uppercase font-bold bg-status-warning-container text-status-warning border border-status-warning/40 flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[16px]">hourglass_top</span>
                                        <span>MENUNGGU VERIFIKASI ADMIN</span>
                                    </span>
                                @elseif($transaction->status === 'approved')
                                    <span class="px-3 py-1.5 rounded font-label-meta text-xs uppercase font-bold bg-primary-hover-subtle text-primary-container border border-primary-container/40 flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[16px]">verified</span>
                                        <span>DISETUJUI // ACTIVE</span>
                                    </span>
                                @else
                                    <span class="px-3 py-1.5 rounded font-label-meta text-xs uppercase font-bold bg-status-error-container text-status-error border border-status-error/40 flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[16px]">cancel</span>
                                        <span>DITOLAK</span>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if($transaction->status === 'rejected' && $transaction->catatan_admin)
                            <div class="mt-4 p-3.5 bg-status-error-container border border-status-error/30 rounded font-label-code text-xs text-status-error">
                                <span class="font-bold uppercase tracking-wider mr-2">[ ALASAN PENOLAKAN ]</span>
                                {{ $transaction->catatan_admin }}
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
            <div class="bg-surface-vault border border-border-default rounded p-12 text-center backdrop-blur-md">
                <span class="material-symbols-outlined text-5xl text-primary-container mb-3">receipt_long</span>
                <h3 class="font-headline-sm font-bold text-lg text-text-primary uppercase mb-2">BELUM ADA RIWAYAT TRANSAKSI</h3>
                <p class="font-body-base text-text-secondary text-sm max-w-md mx-auto mb-6">
                    Aktivasi paket membership NorthGym Anda dengan mengunggah bukti transfer untuk mengaktifkan akses gym dan locker biometrik.
                </p>
                <a href="{{ route('member.payment.create') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-label-code text-xs uppercase tracking-wider font-extrabold rounded neon-glow-btn transition-all">
                    <span class="material-symbols-outlined text-base">add_card</span>
                    <span>BUAT TRANSAKSI PERTAMA</span>
                </a>
            </div>
        @endif

    </div>
</x-app-layout>
