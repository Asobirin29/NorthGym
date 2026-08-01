<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-500">
                    Selamat datang kembali, {{ $user->name }}! 💪
                </h1>
                <p class="text-gray-400 mt-2">Lanjutkan perjalanan fitness Anda hari ini</p>
            </div>

            <!-- Membership Status Card -->
            @if($user->isMembershipExpired())
                <!-- EXPIRED STATUS -->
                <div class="bg-gradient-to-r from-red-600 to-pink-600 rounded-2xl p-6 mb-8 shadow-2xl border-2 border-red-400 animate-pulse">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-2">⚠️ Keanggotaan Kedaluwarsa</h2>
                            <p class="text-red-100">Membership Anda telah berakhir. Perpanjang sekarang untuk akses penuh!</p>
                        </div>
                        <a href="{{ route('member.payment.create') }}" 
                           class="bg-white text-red-600 px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition-all hover:scale-105 shadow-xl whitespace-nowrap">
                            🔓 Perpanjang Sekarang
                        </a>
                    </div>
                </div>
            @else
                <!-- ACTIVE STATUS -->
                <div class="bg-gradient-to-r from-green-500 to-cyan-500 rounded-2xl p-6 mb-8 shadow-2xl">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-2">✅ Keanggotaan Aktif</h2>
                            <p class="text-green-50">
                                Berlaku hingga: <span class="font-bold">{{ $user->membership_end_date->format('d M Y') }}</span>
                            </p>
                            <p class="text-green-100 text-sm mt-1">{{ $user->getDaysRemaining() }} hari lagi</p>
                        </div>
                        @if($user->getDaysRemaining() <= 7)
                            <a href="{{ route('member.payment.create') }}" 
                               class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-xl font-bold hover:bg-yellow-300 transition-all whitespace-nowrap">
                                Perpanjang Dini
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Pending Transaction Notice -->
            @if($pendingTransaction)
                <div class="bg-yellow-900/50 border border-yellow-500 rounded-2xl p-6 mb-8">
                    <div class="flex items-center gap-4">
                        <div class="text-4xl">⏳</div>
                        <div>
                            <h3 class="text-xl font-bold text-yellow-400">Menunggu Verifikasi</h3>
                            <p class="text-yellow-200">
                                Pembayaran Rp {{ number_format($pendingTransaction->nominal, 0, ',', '.') }} 
                                untuk {{ $pendingTransaction->durasi_bulan }} bulan sedang diproses admin.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <!-- Workout Plans Card -->
                <div class="bg-gray-800 rounded-2xl p-6 shadow-xl border border-gray-700 hover:border-cyan-500 transition-all hover:scale-105 relative overflow-hidden group">
                    @if($user->isMembershipExpired())
                        <!-- Lock Overlay -->
                        <div class="absolute inset-0 bg-black/90 flex items-center justify-center z-10 backdrop-blur-sm">
                            <div class="text-center">
                                <div class="text-6xl mb-4">🔒</div>
                                <p class="text-white font-bold mb-4">Fitur Terkunci</p>
                                <a href="{{ route('member.payment.create') }}" 
                                   class="bg-gradient-to-r from-cyan-500 to-purple-500 text-white px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all inline-block">
                                    Aktifkan Membership
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="text-5xl mb-4">🏋️</div>
                    <h3 class="text-xl font-bold text-white mb-2">Program Latihan</h3>
                    <p class="text-gray-400 mb-4">Program latihan terstruktur untuk Anda</p>
                    <a href="{{ route('member.workout-plans') }}" 
                       class="inline-flex items-center text-cyan-400 hover:text-cyan-300 font-semibold {{ $user->isMembershipExpired() ? 'pointer-events-none opacity-50' : '' }}">
                        Lihat Program →
                    </a>
                </div>

                <!-- Progress Tracking Card -->
                <div class="bg-gray-800 rounded-2xl p-6 shadow-xl border border-gray-700 hover:border-purple-500 transition-all hover:scale-105 group">
                    <div class="text-5xl mb-4">📊</div>
                    <h3 class="text-xl font-bold text-white mb-2">Pelacakan Progres</h3>
                    <p class="text-gray-400 mb-4">Catat perkembangan fisik Anda</p>
                    <a href="{{ route('member.progress.index') }}" 
                       class="inline-flex items-center text-purple-400 hover:text-purple-300 font-semibold">
                        Perbarui Progres →
                    </a>
                </div>

                <!-- Payment History Card -->
                <div class="bg-gray-800 rounded-2xl p-6 shadow-xl border border-gray-700 hover:border-green-500 transition-all hover:scale-105 group">
                    <div class="text-5xl mb-4">💳</div>
                    <h3 class="text-xl font-bold text-white mb-2">Riwayat Pembayaran</h3>
                    <p class="text-gray-400 mb-4">Riwayat transaksi pembayaran</p>
                    <a href="{{ route('member.transactions') }}" 
                       class="inline-flex items-center text-green-400 hover:text-green-300 font-semibold">
                        Lihat Riwayat →
                    </a>
                </div>
            </div>

            <!-- Latest Progress Section -->
            @if($latestProgress)
                <div class="bg-gray-800 rounded-2xl p-6 shadow-xl border border-gray-700 mb-8">
                    <h3 class="text-2xl font-bold text-white mb-4">📈 Progress Terakhir</h3>
                    <p class="text-gray-400 mb-4">Dicatat pada {{ $latestProgress->tanggal->format('d M Y') }}</p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-gray-700 rounded-xl p-4">
                            <p class="text-gray-400 text-sm">Berat Badan</p>
                            <p class="text-2xl font-bold text-white">{{ $latestProgress->berat_badan ?? '-' }} kg</p>
                        </div>
                        <div class="bg-gray-700 rounded-xl p-4">
                            <p class="text-gray-400 text-sm">Lingkar Perut</p>
                            <p class="text-2xl font-bold text-white">{{ $latestProgress->lingkar_perut ?? '-' }} cm</p>
                        </div>
                        <div class="bg-gray-700 rounded-xl p-4">
                            <p class="text-gray-400 text-sm">BMI</p>
                            <p class="text-2xl font-bold text-white">{{ $latestProgress->bmi ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-700 rounded-xl p-4">
                            <p class="text-gray-400 text-sm">Kategori</p>
                            <p class="text-2xl font-bold text-cyan-400">{{ $latestProgress->bmi_category ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('member.progress.create') }}" 
                           class="inline-flex items-center text-cyan-400 hover:text-cyan-300 font-semibold">
                            + Perbarui Progres Baru →
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-gray-800 rounded-2xl p-6 shadow-xl border border-gray-700 mb-8 text-center">
                    <div class="text-6xl mb-4">📊</div>
                    <h3 class="text-xl font-bold text-white mb-2">Belum Ada Data Progress</h3>
                    <p class="text-gray-400 mb-4">Mulai catat progress fitness Anda sekarang!</p>
                    <a href="{{ route('member.progress.create') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-cyan-500 to-purple-500 text-white px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all">
                        + Input Progress Pertama
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
