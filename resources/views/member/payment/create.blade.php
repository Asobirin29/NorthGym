<x-app-layout>
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-glass border border-border-default mb-3 backdrop-blur-md rounded">
                <span class="w-1.5 h-1.5 bg-primary-container rounded-none pulse-volt"></span>
                <span class="font-label-tag text-label-tag text-text-muted tracking-widest uppercase">
                    [ RE-AUTHENTICATION // MEMBERSHIP PASS ]
                </span>
            </div>
            <h1 class="text-display-section-mobile md:text-headline-lg font-headline-lg font-extrabold uppercase tracking-tight text-text-primary">
                PEMBAYARAN <span class="text-primary-container">MEMBERSHIP</span>.
            </h1>
            <p class="font-body-base text-text-secondary text-sm md:text-base mt-2">
                Pilih paket langganan gym dan unggah bukti transfer manual untuk verifikasi turnstile access pass.
            </p>
        </div>

        <!-- Pending Transaction Warning -->
        @if($pendingTransaction)
            <div class="bg-surface-vault border-2 border-status-warning p-6 rounded mb-8 backdrop-blur-md">
                <div class="flex items-start gap-4">
                    <div class="p-2.5 bg-status-warning-container text-status-warning rounded">
                        <span class="material-symbols-outlined text-3xl">hourglass_top</span>
                    </div>
                    <div>
                        <div class="font-label-tag text-xs text-status-warning tracking-widest uppercase mb-1">
                            [ STATUS: PENDING AUDIT VERIFICATION ]
                        </div>
                        <h3 class="font-headline-sm font-bold text-lg text-text-primary uppercase">
                            Pembayaran Anda Sedang Diverifikasi
                        </h3>
                        <p class="font-body-base text-text-secondary text-sm mt-1 max-w-xl">
                            Anda memiliki transaksi aktif sebesar <strong class="text-text-primary font-label-code">Rp {{ number_format($pendingTransaction->nominal, 0, ',', '.') }}</strong> yang menunggu persetujuan admin. Harap tunggu proses audit sebelum mengajukan pembayaran baru.
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('member.transactions') }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 bg-surface-container hover:bg-surface-container-high border border-border-subtle text-text-primary font-label-code text-xs uppercase tracking-wider rounded transition-all">
                                <span class="material-symbols-outlined text-sm">receipt_long</span>
                                <span>LIHAT LEDGER TRANSAKSI</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Bank Transfer Vault Card -->
            <div class="bg-surface-vault border border-border-default rounded p-6 mb-8 backdrop-blur-md">
                <div class="flex items-center gap-2 pb-3 border-b border-border-default mb-4">
                    <span class="material-symbols-outlined text-primary-container text-base">account_balance</span>
                    <h3 class="font-headline-sm font-bold text-xs uppercase tracking-wider text-text-primary">
                        DESTINASI TRANSFER BANK RESMI
                    </h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 font-label-code">
                    <div class="p-3 bg-surface-container-lowest border border-border-default rounded">
                        <span class="text-[10px] text-text-muted uppercase font-label-meta block">NAMA BANK</span>
                        <span class="text-text-primary font-bold text-base">{{ $bankInfo['bank'] }}</span>
                    </div>
                    <div class="p-3 bg-surface-container-lowest border border-border-default rounded">
                        <span class="text-[10px] text-text-muted uppercase font-label-meta block">NOMOR REKENING</span>
                        <span class="text-primary-container font-extrabold text-lg tracking-wider">{{ $bankInfo['account_number'] }}</span>
                    </div>
                    <div class="p-3 bg-surface-container-lowest border border-border-default rounded">
                        <span class="text-[10px] text-text-muted uppercase font-label-meta block">ATAS NAMA</span>
                        <span class="text-text-primary font-bold text-base">{{ $bankInfo['account_name'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('member.payment.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Package Selection -->
                <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                    <div class="flex items-center gap-2 pb-3 border-b border-border-default mb-4">
                        <span class="material-symbols-outlined text-primary-container text-base">inventory_2</span>
                        <h3 class="font-headline-sm font-bold text-xs uppercase tracking-wider text-text-primary">
                            PILIH DURASI PAKET MEMBERSHIP
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($packages as $duration => $package)
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="durasi_bulan" value="{{ $duration }}" 
                                       class="peer sr-only" {{ $duration == 1 ? 'checked' : '' }}>
                                <div class="bg-surface-card border-2 border-border-default rounded p-5 peer-checked:border-primary-container peer-checked:bg-primary-hover-subtle peer-checked:shadow-[0_0_20px_rgba(184,246,0,0.15)] group-hover:border-border-subtle transition-all relative overflow-hidden">
                                    @if($package->discount_percentage > 0)
                                        <span class="absolute top-3 right-3 bg-primary-container text-surface-container-lowest text-[10px] font-label-code uppercase tracking-wider font-extrabold px-2 py-0.5 rounded">
                                            HEMAT {{ $package->discount_percentage }}%
                                        </span>
                                    @endif
                                    <div class="font-label-tag text-[10px] text-text-muted tracking-widest uppercase mb-1">
                                        {{ $duration }} BULAN FULL ACCESS
                                    </div>
                                    <h4 class="font-headline-sm font-extrabold text-xl text-text-primary mb-2">
                                        {{ $package->name }}
                                    </h4>
                                    <div class="font-headline-lg font-extrabold text-2xl text-primary-container">
                                        Rp {{ number_format($package->discounted_price, 0, ',', '.') }}
                                    </div>
                                    <div class="font-label-meta text-xs text-text-secondary mt-1">
                                        {{ $package->formatted_price_per_month }}
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('durasi_bulan')
                        <p class="text-status-error font-label-code text-xs mt-3">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Proof Upload Box -->
                <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                    <div class="flex items-center gap-2 pb-3 border-b border-border-default mb-4">
                        <span class="material-symbols-outlined text-primary-container text-base">upload_file</span>
                        <h3 class="font-headline-sm font-bold text-xs uppercase tracking-wider text-text-primary">
                            UNGGAH BUKTI TRANSFER PEMBAYARAN
                        </h3>
                    </div>

                    <div class="border-2 border-dashed border-border-default hover:border-primary-container rounded p-8 text-center transition-all bg-surface-container-lowest/50">
                        <input type="file" name="bukti_transfer" id="bukti_transfer" 
                               accept="image/*" class="hidden" onchange="previewImage(this)">
                        <label for="bukti_transfer" class="cursor-pointer block">
                            <div id="preview-container" class="hidden mb-4">
                                <img id="preview-image" class="max-h-64 mx-auto rounded border border-border-default shadow-lg">
                            </div>
                            <div id="upload-placeholder">
                                <span class="material-symbols-outlined text-4xl text-primary-container mb-2">add_photo_alternate</span>
                                <p class="font-headline-sm font-bold text-sm text-text-primary uppercase tracking-wider">
                                    KLIK UNTUK UNGGAH STRUK / BUKTI TRANSFER
                                </p>
                                <p class="font-label-meta text-[11px] text-text-muted mt-1">
                                    Mendukung format JPG, PNG, WEBP (Maksimal 5MB)
                                </p>
                            </div>
                        </label>
                    </div>
                    @error('bukti_transfer')
                        <p class="text-status-error font-label-code text-xs mt-3">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Button -->
                <button type="submit" 
                        class="w-full py-4 bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-headline-sm text-sm uppercase tracking-wider font-extrabold rounded neon-glow-btn transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    <span>KIRIM KONFIRMASI PEMBAYARAN</span>
                </button>
            </form>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ route('member.dashboard') }}" class="font-label-code text-xs text-text-muted hover:text-text-primary uppercase tracking-wider transition-all">
                &larr; KEMBALI KE ATHLETE DASHBOARD
            </a>
        </div>

    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                    document.getElementById('upload-placeholder').innerHTML = '<span class="material-symbols-outlined text-3xl text-primary-container mb-1">sync</span><p class="font-label-code text-xs text-primary-container uppercase tracking-wider">Klik untuk mengganti gambar terpilih</p>';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
