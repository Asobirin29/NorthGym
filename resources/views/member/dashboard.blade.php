<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Telemetry Title -->
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-glass border border-border-default mb-3 backdrop-blur-md rounded">
                <span class="w-1.5 h-1.5 bg-primary-container rounded-full pulse-volt"></span>
                <span class="font-label-tag text-label-tag text-text-muted tracking-widest uppercase">
                    [ ATHLETE TELEMETRY // NODE #09 ACTIVE ]
                </span>
            </div>
            <h1 class="text-display-section-mobile md:text-headline-lg font-headline-lg font-extrabold uppercase tracking-tight text-text-primary">
                WELCOME BACK, <span class="text-primary-container">{{ strtoupper($user->name) }}</span>.
            </h1>
            <p class="font-body-base text-text-secondary text-sm md:text-base mt-2 max-w-2xl">
                Sistem sinkronisasi biometrik aktif. Pantau perkembangan kekuatan, adaptasi metabolik, dan status akses fasilitas latihan Anda.
            </p>
        </div>

        <!-- Membership Status Card -->
        @if($user->isMembershipExpired())
            <!-- EXPIRED STATUS: High-Security Alert Card -->
            <div class="relative bg-surface-vault border-2 border-status-error/80 p-6 md:p-8 rounded-lg mb-8 shadow-2xl overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-status-error/10 blur-3xl pointer-events-none"></div>
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
                    <div class="space-y-1">
                        <div class="inline-flex items-center gap-2 text-status-error font-label-tag text-label-tag tracking-widest uppercase">
                            <span class="material-symbols-outlined text-base">gpp_bad</span>
                            [ ACCESS PROTOCOL: REVOKED // EXPIRED ]
                        </div>
                        <h2 class="text-headline-sm font-headline-sm uppercase text-text-primary font-bold">
                            Keanggotaan Anda Telah Kedaluwarsa
                        </h2>
                        <p class="font-body-base text-text-secondary text-sm max-w-xl">
                            Akses turnstile biometrik, program latihan, dan recovery pods terkunci sementara. Lakukan perpanjangan protokol untuk aktivasi kembali.
                        </p>
                    </div>
                    <a href="{{ route('member.payment.create') }}" 
                       class="h-[50px] px-8 bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-headline-sm text-label-code uppercase tracking-wider font-extrabold flex items-center justify-center gap-2 neon-glow-btn transition-all duration-200 whitespace-nowrap">
                        <span>RE-ACTIVATE ACCESS PROTOCOL</span>
                        <span class="material-symbols-outlined font-bold text-base">arrow_forward</span>
                    </a>
                </div>
            </div>
        @else
            <!-- ACTIVE STATUS: Kinetic Brutalism Elevated Card -->
            <div class="relative bg-surface-vault border-2 border-primary-container p-6 md:p-8 rounded-lg mb-8 neon-glow-card overflow-hidden">
                <!-- Ambient radial volt glow -->
                <div class="absolute -right-16 -top-16 w-60 h-60 bg-primary-container opacity-10 blur-3xl pointer-events-none"></div>
                
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-primary-container pulse-volt"></span>
                            <span class="font-label-tag text-label-tag text-primary-container tracking-widest uppercase font-bold">
                                [ PROTOCOL STATUS: FULL ATHLETE ACCESS // 24/7 ACTIVE ]
                            </span>
                        </div>
                        <h2 class="text-headline-sm font-headline-sm uppercase text-text-primary font-bold">
                            Pass Keanggotaan Terverifikasi
                        </h2>
                        <div class="flex flex-wrap items-center gap-4 text-xs font-label-code text-text-secondary pt-1">
                            <div>
                                <span class="text-text-muted">BERLAKU HINGGA:</span> 
                                <span class="text-text-primary font-bold">{{ $user->membership_end_date->format('d M Y') }}</span>
                            </div>
                            <span>•</span>
                            <div>
                                <span class="text-text-muted">SISA DURASI:</span> 
                                <span class="text-primary-container font-bold">{{ $user->getDaysRemaining() }} HARI OPERASIONAL</span>
                            </div>
                        </div>
                    </div>

                    @if($user->getDaysRemaining() <= 7)
                        <a href="{{ route('member.payment.create') }}" 
                           class="h-[46px] px-6 bg-status-warning text-surface-container-lowest font-headline-sm text-label-code uppercase tracking-wider font-bold flex items-center justify-center gap-2 transition-all hover:scale-105 whitespace-nowrap">
                            <span>EXTEND EARLY PROTOCOL</span>
                            <span class="material-symbols-outlined text-sm">schedule</span>
                        </a>
                    @else
                        <div class="flex items-center gap-2 px-4 py-2 bg-surface-glass border border-primary-container/30 rounded text-primary-container font-label-code text-xs">
                            <span class="material-symbols-outlined text-sm">contactless</span>
                            <span>NFC GATE UNLOCKED</span>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Pending Transaction Notice -->
        @if($pendingTransaction)
            <div class="bg-surface-vault border border-status-warning p-5 rounded-lg mb-8 flex items-start gap-4">
                <div class="p-2.5 bg-status-warning-container text-status-warning rounded">
                    <span class="material-symbols-outlined text-2xl">hourglass_top</span>
                </div>
                <div>
                    <div class="font-label-tag text-label-tag text-status-warning uppercase tracking-widest mb-1">
                        [ TRANSACTION BUFFER: VERIFICATION IN PROGRESS ]
                    </div>
                    <h3 class="text-base font-bold text-text-primary uppercase font-headline-sm">
                        Menunggu Verifikasi Staf
                    </h3>
                    <p class="text-xs font-label-code text-text-secondary mt-1">
                        Pembayaran transfer <span class="text-text-primary font-bold">Rp {{ number_format($pendingTransaction->nominal, 0, ',', '.') }}</span> untuk durasi <span class="text-primary-container font-bold">{{ $pendingTransaction->durasi_bulan }} bulan</span> sedang dalam antrian validasi mutasi ledger bank.
                    </p>
                </div>
            </div>
        @endif

        <!-- Quick Actions Bento Grid (Kinetic Brutalist Style) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            
            <!-- Bento 1: Workout Plans Card -->
            <div class="bg-surface-vault border border-border-default hover:border-primary-container p-6 relative rounded-lg transition-all duration-300 flex flex-col justify-between group overflow-hidden">
                @if($user->isMembershipExpired())
                    <!-- Lock Overlay -->
                    <div class="absolute inset-0 bg-surface-container-lowest/90 backdrop-blur-sm flex flex-col items-center justify-center z-20 p-6 text-center">
                        <span class="material-symbols-outlined text-4xl text-status-error mb-2">lock</span>
                        <p class="font-label-code text-xs text-text-muted uppercase tracking-wider mb-4">MOD.01 // ACCESS RESTRICTED</p>
                        <a href="{{ route('member.payment.create') }}" 
                           class="px-4 py-2 bg-primary-container text-surface-container-lowest font-label-code text-xs font-bold uppercase tracking-widest neon-glow-btn">
                            AKTIFKAN AKSES
                        </a>
                    </div>
                @endif
                <div>
                    <div class="flex items-center justify-between border-b border-border-default pb-3 mb-4">
                        <span class="font-label-meta text-label-meta text-primary-container uppercase tracking-widest">
                            MOD.01 // LOAD PROTOCOL
                        </span>
                        <span class="material-symbols-outlined text-text-muted group-hover:text-primary-container transition-colors">
                            fitness_center
                        </span>
                    </div>
                    <h3 class="text-headline-sm font-headline-sm uppercase text-text-primary mb-2">
                        Program Latihan
                    </h3>
                    <p class="font-body-base text-text-secondary text-xs leading-relaxed mb-6">
                        Panduan latihan beban, hypertrophy progresif, dan velocity conditioning yang disesuaikan dengan fase adaptasi Anda.
                    </p>
                </div>
                <a href="{{ route('member.workout-plans') }}" 
                   class="inline-flex items-center gap-2 text-primary-container font-label-code text-xs uppercase tracking-widest group-hover:translate-x-1 transition-transform {{ $user->isMembershipExpired() ? 'pointer-events-none opacity-40' : '' }}">
                    <span>BUKA PROTOCOL</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            <!-- Bento 2: Progress Tracking Card -->
            <div class="bg-surface-vault border border-border-default hover:border-primary-container p-6 relative rounded-lg transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between border-b border-border-default pb-3 mb-4">
                        <span class="font-label-meta text-label-meta text-primary-container uppercase tracking-widest">
                            MOD.02 // BIOMETRICS
                        </span>
                        <span class="material-symbols-outlined text-text-muted group-hover:text-primary-container transition-colors">
                            monitoring
                        </span>
                    </div>
                    <h3 class="text-headline-sm font-headline-sm uppercase text-text-primary mb-2">
                        Pelacakan Progres
                    </h3>
                    <p class="font-body-base text-text-secondary text-xs leading-relaxed mb-6">
                        Pencatatan data antropometrik fisik, kalkulasi BMI, lingkar perut, dan dokumentasi visual transformasi fisik.
                    </p>
                </div>
                <a href="{{ route('member.progress.index') }}" 
                   class="inline-flex items-center gap-2 text-primary-container font-label-code text-xs uppercase tracking-widest group-hover:translate-x-1 transition-transform">
                    <span>LOG BIOMETRIK</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            <!-- Bento 3: Billing & Transactions Card -->
            <div class="bg-surface-vault border border-border-default hover:border-primary-container p-6 relative rounded-lg transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between border-b border-border-default pb-3 mb-4">
                        <span class="font-label-meta text-label-meta text-primary-container uppercase tracking-widest">
                            MOD.03 // LEDGER
                        </span>
                        <span class="material-symbols-outlined text-text-muted group-hover:text-primary-container transition-colors">
                            receipt_long
                        </span>
                    </div>
                    <h3 class="text-headline-sm font-headline-sm uppercase text-text-primary mb-2">
                        Riwayat Transaksi
                    </h3>
                    <p class="font-body-base text-text-secondary text-xs leading-relaxed mb-6">
                        Log audit pembayaran membership, bukti transfer perpanjangan paket, dan status verifikasi transaksi keuangan.
                    </p>
                </div>
                <a href="{{ route('member.transactions') }}" 
                   class="inline-flex items-center gap-2 text-primary-container font-label-code text-xs uppercase tracking-widest group-hover:translate-x-1 transition-transform">
                    <span>INSPEKSI LEDGER</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>

        <!-- Latest Progress Biometric Stream -->
        <div class="bg-surface-vault border border-border-default rounded-lg p-6 md:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-border-default pb-4 mb-6">
                <div>
                    <div class="font-label-tag text-label-tag text-primary-container uppercase tracking-widest mb-1">
                        [ STREAM LOG // ANTHROPOMETRIC READINGS ]
                    </div>
                    <h3 class="text-headline-sm font-headline-sm uppercase text-text-primary font-bold">
                        Telemetri Fisik Terakhir
                    </h3>
                </div>
                @if($latestProgress)
                    <span class="font-label-code text-xs text-text-muted">
                        TIMESTAMP: {{ $latestProgress->tanggal->format('d M Y') }}
                    </span>
                @endif
            </div>

            @if($latestProgress)
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="p-4 bg-surface-container-lowest border border-border-default rounded">
                        <div class="font-label-meta text-label-meta text-text-muted uppercase mb-1">BERAT BADAN</div>
                        <div class="font-headline-sm text-2xl font-bold text-text-primary">
                            {{ $latestProgress->berat_badan ?? '-' }} <span class="text-xs text-text-muted font-normal">KG</span>
                        </div>
                    </div>
                    <div class="p-4 bg-surface-container-lowest border border-border-default rounded">
                        <div class="font-label-meta text-label-meta text-text-muted uppercase mb-1">LINGKAR PERUT</div>
                        <div class="font-headline-sm text-2xl font-bold text-text-primary">
                            {{ $latestProgress->lingkar_perut ?? '-' }} <span class="text-xs text-text-muted font-normal">CM</span>
                        </div>
                    </div>
                    <div class="p-4 bg-surface-container-lowest border border-border-default rounded">
                        <div class="font-label-meta text-label-meta text-text-muted uppercase mb-1">BODY MASS INDEX (BMI)</div>
                        <div class="font-headline-sm text-2xl font-bold text-primary-container">
                            {{ $latestProgress->bmi ?? '-' }}
                        </div>
                    </div>
                    <div class="p-4 bg-surface-container-lowest border border-border-default rounded">
                        <div class="font-label-meta text-label-meta text-text-muted uppercase mb-1">KLASIFIKASI METRIK</div>
                        <div class="font-label-code text-base font-bold text-primary-container truncate">
                            {{ $latestProgress->bmi_category ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <a href="{{ route('member.progress.create') }}" 
                       class="h-[44px] px-5 bg-surface-glass border border-border-subtle hover:border-primary-container text-text-primary hover:text-primary-container font-label-code text-xs uppercase tracking-widest flex items-center gap-2 rounded transition-all">
                        <span>+ LOG PROGRES TERBARU</span>
                        <span class="material-symbols-outlined text-sm">add_chart</span>
                    </a>
                </div>
            @else
                <div class="py-12 text-center space-y-4">
                    <span class="material-symbols-outlined text-5xl text-text-muted">query_stats</span>
                    <div>
                        <h4 class="font-headline-sm uppercase text-text-primary font-bold">Belum Ada Data Baseline</h4>
                        <p class="font-body-base text-text-secondary text-xs max-w-sm mx-auto mt-1">
                            Catat data awal berat badan dan ukuran tubuh Anda untuk memulai grafik telemetri perkembangan fisik.
                        </p>
                    </div>
                    <a href="{{ route('member.progress.create') }}" 
                       class="inline-flex items-center gap-2 h-[46px] px-6 bg-primary-container text-surface-container-lowest font-headline-sm text-xs font-bold uppercase tracking-widest neon-glow-btn">
                        <span>+ INPUT RECORD PERTAMA</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
