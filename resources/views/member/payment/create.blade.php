<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-500">
                    💳 Pembayaran Membership
                </h1>
                <p class="text-gray-400 mt-2">Pilih paket dan upload bukti transfer</p>
            </div>

            <!-- Pending Transaction Notice -->
            @if($pendingTransaction)
                <div class="bg-yellow-900/50 border border-yellow-500 rounded-2xl p-6 mb-8">
                    <div class="flex items-center gap-4">
                        <div class="text-4xl">⏳</div>
                        <div>
                            <h3 class="text-xl font-bold text-yellow-400">Pembayaran Sedang Diproses</h3>
                            <p class="text-yellow-200">
                                Anda memiliki pembayaran pending sebesar Rp {{ number_format($pendingTransaction->nominal, 0, ',', '.') }}.
                                Harap tunggu verifikasi admin sebelum membuat pembayaran baru.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <!-- Bank Info -->
                <div class="bg-gray-800 rounded-2xl p-6 mb-8 border border-gray-700">
                    <h3 class="text-xl font-bold text-white mb-4">🏦 Informasi Transfer</h3>
                    <div class="bg-gray-700 rounded-xl p-4">
                        <p class="text-gray-300"><span class="text-gray-500">Bank:</span> {{ $bankInfo['bank'] }}</p>
                        <p class="text-gray-300"><span class="text-gray-500">No. Rekening:</span> 
                            <span class="font-mono text-cyan-400 text-xl">{{ $bankInfo['account_number'] }}</span>
                        </p>
                        <p class="text-gray-300"><span class="text-gray-500">Atas Nama:</span> {{ $bankInfo['account_name'] }}</p>
                    </div>
                </div>

                <!-- Payment Form -->
                <form action="{{ route('member.payment.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Package Selection -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-white mb-4">📦 Pilih Paket Membership</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($packages as $duration => $package)
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="durasi_bulan" value="{{ $duration }}" 
                                           class="peer sr-only" {{ $duration == 1 ? 'checked' : '' }}>
                                    <div class="bg-gray-800 rounded-2xl p-6 border-2 border-gray-700 
                                                peer-checked:border-cyan-500 peer-checked:bg-gray-700
                                                hover:border-gray-500 transition-all">
                                        @if($package->discount_percentage > 0)
                                            <span class="absolute top-4 right-4 bg-gradient-to-r from-cyan-500 to-purple-500 
                                                         text-white text-xs font-bold px-3 py-1 rounded-full">
                                                HEMAT {{ $package->discount_percentage }}%
                                            </span>
                                        @endif
                                        <h4 class="text-2xl font-bold text-white mb-2">{{ $package->name }}</h4>
                                        <p class="text-3xl font-bold text-cyan-400">
                                            Rp {{ number_format($package->discounted_price, 0, ',', '.') }}
                                        </p>
                                        <p class="text-gray-400 text-sm mt-2">
                                            {{ $package->formatted_price_per_month }}
                                        </p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('durasi_bulan')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload Proof -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-white mb-4">📸 Upload Bukti Transfer</h3>
                        <div class="bg-gray-800 rounded-2xl p-6 border-2 border-dashed border-gray-600 
                                    hover:border-cyan-500 transition-all text-center">
                            <input type="file" name="bukti_transfer" id="bukti_transfer" 
                                   accept="image/*" class="hidden" onchange="previewImage(this)">
                            <label for="bukti_transfer" class="cursor-pointer block">
                                <div id="preview-container" class="hidden mb-4">
                                    <img id="preview-image" class="max-h-64 mx-auto rounded-lg">
                                </div>
                                <div id="upload-placeholder">
                                    <div class="text-5xl mb-4">📤</div>
                                    <p class="text-gray-300 font-medium">Klik untuk upload bukti transfer</p>
                                    <p class="text-gray-500 text-sm mt-2">PNG, JPG maksimal 5MB</p>
                                </div>
                            </label>
                        </div>
                        @error('bukti_transfer')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-cyan-500 to-purple-500 text-white py-4 rounded-xl 
                                   font-bold text-lg hover:opacity-90 transition-all hover:scale-[1.02] shadow-lg">
                        🚀 Submit Pembayaran
                    </button>
                </form>
            @endif

            <!-- Back Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('member.dashboard') }}" class="text-gray-400 hover:text-white transition-all">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                    document.getElementById('upload-placeholder').innerHTML = '<p class="text-cyan-400">Klik untuk ganti gambar</p>';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
