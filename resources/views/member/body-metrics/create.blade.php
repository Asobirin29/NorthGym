<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-500">
                    📝 Input Metrik Tubuh
                </h1>
                <p class="text-gray-400 mt-2">Catat komposisi tubuh Anda hari ini</p>
            </div>

            <!-- Latest Metric Reference -->
            @if($latestMetric)
                <div class="bg-gray-800 rounded-2xl p-6 mb-8 border border-gray-700">
                    <h3 class="text-lg font-bold text-white mb-4">📊 Terakhir Dicatat ({{ $latestMetric->recorded_at->format('d M Y') }})</h3>
                    <div class="grid grid-cols-3 md:grid-cols-5 gap-4 text-center">
                        <div>
                            <p class="text-gray-400 text-sm">Berat</p>
                            <p class="text-xl font-bold text-cyan-400">{{ $latestMetric->weight }} kg</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">BMI</p>
                            <p class="text-xl font-bold text-cyan-400">{{ $latestMetric->bmi }}</p>
                        </div>
                        @if($latestMetric->body_fat_percentage)
                            <div>
                                <p class="text-gray-400 text-sm">Lemak Tubuh</p>
                                <p class="text-xl font-bold text-orange-400">{{ $latestMetric->body_fat_percentage }}%</p>
                            </div>
                        @endif
                        @if($latestMetric->muscle_mass_percentage)
                            <div>
                                <p class="text-gray-400 text-sm">Otot</p>
                                <p class="text-xl font-bold text-red-400">{{ $latestMetric->muscle_mass_percentage }}%</p>
                            </div>
                        @endif
                        @if($latestMetric->water_percentage)
                            <div>
                                <p class="text-gray-400 text-sm">Kadar Air</p>
                                <p class="text-xl font-bold text-blue-400">{{ $latestMetric->water_percentage }}%</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('member.body-metrics.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Date -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <label class="block text-white font-bold mb-2">📅 Tanggal</label>
                    <input type="date" name="recorded_at" value="{{ old('recorded_at', date('Y-m-d')) }}" 
                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all" required>
                    @error('recorded_at')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Basic Measurements (Required) -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <h3 class="text-lg font-bold text-white mb-4">⚖️ Pengukuran Dasar (Wajib)</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Berat Badan (kg) *</label>
                            <input type="number" name="weight" value="{{ old('weight', $latestMetric?->weight) }}" 
                                   step="0.01" min="20" max="500" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                   placeholder="70.5">
                            @error('weight')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Tinggi Badan (cm) *</label>
                            <input type="number" name="height" value="{{ old('height', $latestMetric?->height) }}" 
                                   step="0.01" min="50" max="300" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                   placeholder="175">
                            @error('height')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Body Composition (Optional) -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <h3 class="text-lg font-bold text-white mb-4">💪 Komposisi Tubuh (Opsional)</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Lemak Tubuh %</label>
                            <input type="number" name="body_fat_percentage" value="{{ old('body_fat_percentage') }}" 
                                   step="0.01" min="0" max="100"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                   placeholder="15.5">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Massa Otot %</label>
                            <input type="number" name="muscle_mass_percentage" value="{{ old('muscle_mass_percentage') }}" 
                                   step="0.01" min="0" max="100"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                   placeholder="40.0">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Kadar Air %</label>
                            <input type="number" name="water_percentage" value="{{ old('water_percentage') }}" 
                                   step="0.01" min="0" max="100"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                   placeholder="58.0">
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mt-3">💡 Tips: Gunakan timbangan komposisi tubuh untuk mendapatkan nilai ini</p>
                </div>

                <!-- Notes -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <label class="block text-white font-bold mb-2">📝 Catatan</label>
                    <textarea name="notes" rows="3"
                              class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                     focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all resize-none"
                              placeholder="Bagaimana perasaan Anda hari ini?">{{ old('notes') }}</textarea>
                </div>

                <!-- Submit -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-cyan-500 to-purple-500 text-white py-4 rounded-xl 
                               font-bold text-lg hover:opacity-90 transition-all hover:scale-[1.02] shadow-lg">
                    💾 Simpan Metrik
                </button>
            </form>

            <!-- Back Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('member.body-metrics.index') }}" class="text-gray-400 hover:text-white transition-all">
                    ← Kembali ke Metrik Tubuh
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
