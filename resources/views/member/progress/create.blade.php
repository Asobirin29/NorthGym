<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-500">
                    📝 Input Progress Baru
                </h1>
                <p class="text-gray-400 mt-2">Catat perkembangan fisik dan komposisi tubuh Anda</p>
            </div>

            <!-- Latest Progress Reference -->
            @if($latestProgress)
                <div class="bg-gray-800 rounded-2xl p-6 mb-8 border border-gray-700">
                    <h3 class="text-lg font-bold text-white mb-4">📈 Progress Terakhir ({{ $latestProgress->tanggal->format('d M Y') }})</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div>
                            <p class="text-gray-400 text-sm">Berat</p>
                            <p class="text-xl font-bold text-cyan-400">{{ $latestProgress->berat_badan ?? '-' }} kg</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">BMI</p>
                            <p class="text-xl font-bold text-cyan-400">{{ $latestProgress->bmi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">L. Perut</p>
                            <p class="text-xl font-bold text-cyan-400">{{ $latestProgress->lingkar_perut ?? '-' }} cm</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Body Fat</p>
                            <p class="text-xl font-bold text-orange-400">{{ $latestProgress->body_fat_percentage ?? '-' }}%</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('member.progress.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Date & Workout Type -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Date -->
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <label class="block text-white font-bold mb-2">📅 Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" 
                               class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                      focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all" required>
                        @error('tanggal')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Workout Type -->
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <label class="block text-white font-bold mb-2">🏋️ Tipe Latihan</label>
                        <select name="workout_type_id" id="workoutTypeSelect" 
                                class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                       focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
                            <option value="">-- Pilih (Opsional) --</option>
                        </select>
                        <button type="button" id="addCustomTypeBtn"
                                class="mt-2 w-full bg-purple-700 hover:bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all">
                            + Tambah Kustom
                        </button>
                        <input type="hidden" name="custom_workout_type_id" id="customWorkoutTypeId">
                    </div>
                </div>

                <!-- Tabbed Sections -->
                <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden">
                    <!-- Tab Headers -->
                    <div class="flex border-b border-gray-700">
                        <button type="button" onclick="switchTab('physical')" id="tab-physical"
                                class="flex-1 px-6 py-4 text-white font-bold bg-gradient-to-r from-cyan-600 to-purple-600 transition-all">
                            📏 Ukuran Fisik
                        </button>
                        <button type="button" onclick="switchTab('composition')" id="tab-composition"
                                class="flex-1 px-6 py-4 text-gray-400 font-bold hover:bg-gray-700 transition-all">
                            💪 Komposisi Tubuh
                        </button>
                        <button type="button" onclick="switchTab('photos')" id="tab-photos"
                                class="flex-1 px-6 py-4 text-gray-400 font-bold hover:bg-gray-700 transition-all">
                            📸 Foto Progress
                        </button>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6">
                        <!-- Physical Measurements Tab -->
                        <div id="content-physical" class="tab-content">
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">Berat Badan (kg) *</label>
                                    <input type="number" name="berat_badan" value="{{ old('berat_badan') }}" step="0.01"
                                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                           placeholder="70.5">
                                </div>
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">Tinggi Badan (cm) *</label>
                                    <input type="number" name="tinggi_badan" value="{{ old('tinggi_badan', $latestProgress?->tinggi_badan) }}" step="0.01"
                                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                           placeholder="175">
                                </div>
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">Lingkar Perut (cm)</label>
                                    <input type="number" name="lingkar_perut" value="{{ old('lingkar_perut') }}" step="0.01"
                                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                           placeholder="80">
                                </div>
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">Lingkar Dada (cm)</label>
                                    <input type="number" name="lingkar_dada" value="{{ old('lingkar_dada') }}" step="0.01"
                                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                           placeholder="95">
                                </div>
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">Lingkar Lengan (cm)</label>
                                    <input type="number" name="lingkar_lengan" value="{{ old('lingkar_lengan') }}" step="0.01"
                                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                           placeholder="35">
                                </div>
                            </div>
                        </div>

                        <!-- Body Composition Tab -->
                        <div id="content-composition" class="tab-content hidden">
                            <div class="mb-4 bg-blue-900/30 border border-blue-700 rounded-xl p-4">
                                <p class="text-blue-300 text-sm">💡 <strong>Tips:</strong> Gunakan timbangan body composition untuk hasil akurat. Jika tidak punya, field ini bisa dikosongkan.</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">Body Fat % (Lemak Tubuh)</label>
                                    <input type="number" name="body_fat_percentage" value="{{ old('body_fat_percentage') }}" step="0.01" min="0" max="100"
                                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                           placeholder="15.5">
                                    <p class="text-gray-500 text-xs mt-1">Normal: Pria 10-20%, Wanita 18-28%</p>
                                </div>
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">Muscle Mass % (Massa Otot)</label>
                                    <input type="number" name="muscle_mass_percentage" value="{{ old('muscle_mass_percentage') }}" step="0.01" min="0" max="100"
                                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                           placeholder="40.0">
                                    <p class="text-gray-500 text-xs mt-1">Normal: Pria 33-40%, Wanita 25-31%</p>
                                </div>
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">Water % (Kadar Air)</label>
                                    <input type="number" name="water_percentage" value="{{ old('water_percentage') }}" step="0.01" min="0" max="100"
                                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                           placeholder="58.0">
                                    <p class="text-gray-500 text-xs mt-1">Normal: Pria 50-65%, Wanita 45-60%</p>
                                </div>
                            </div>
                        </div>

                        <!-- Photos Tab -->
                        <div id="content-photos" class="tab-content hidden">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-white font-bold mb-2">Foto Before</label>
                                    <input type="file" name="foto_before" accept="image/*"
                                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                                  file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                                  file:bg-cyan-600 file:text-white file:cursor-pointer hover:file:bg-cyan-700">
                                    <p class="text-gray-500 text-sm mt-2">Max 5MB. Format: JPG, PNG</p>
                                </div>
                                <div>
                                    <label class="block text-white font-bold mb-2">Foto After</label>
                                    <input type="file" name="foto_after" accept="image/*"
                                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                                  file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                                  file:bg-purple-600 file:text-white file:cursor-pointer hover:file:bg-purple-700">
                                    <p class="text-gray-500 text-sm mt-2">Max 5MB. Format: JPG, PNG</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <label class="block text-white font-bold mb-2">📝 Catatan</label>
                    <textarea name="catatan" rows="3"
                              class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                     focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all resize-none"
                              placeholder="Bagaimana perasaan Anda hari ini? Ada perubahan yang Anda rasakan?">{{ old('catatan') }}</textarea>
                </div>

                <!-- Submit -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-cyan-500 to-purple-500 text-white py-4 rounded-xl 
                               font-bold text-lg hover:opacity-90 transition-all hover:scale-[1.02] shadow-lg">
                    💾 Simpan Progress
                </button>
            </form>

            <!-- Back Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('member.progress.index') }}" class="text-gray-400 hover:text-white transition-all">
                    ← Kembali ke Progress
                </a>
            </div>
        </div>
    </div>

    <!-- Custom Workout Type Modal -->
    <div id="customWorkoutModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-gray-800 rounded-2xl p-6 max-w-md w-full mx-4 border border-gray-700">
            <h3 class="text-xl font-bold text-white mb-4">+ Tambah Tipe Latihan Kustom</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-400 text-sm mb-2">Nama Latihan</label>
                    <input type="text" id="customWorkoutName" 
                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                           placeholder="e.g. Calisthenics">
                </div>
                <div>
                    <label class="block text-gray-400 text-sm mb-2">Kategori</label>
                    <select id="customWorkoutCategory" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                   focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
                        <option value="cardio">🏃 Cardio</option>
                        <option value="strength">💪 Strength</option>
                        <option value="flexibility">🧘 Flexibility</option>
                        <option value="other" selected>🏋️ Other</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="button" id="saveCustomType"
                            class="flex-1 bg-gradient-to-r from-cyan-500 to-purple-500 text-white px-4 py-3 rounded-xl font-bold hover:opacity-90 transition-all">
                        Simpan
                    </button>
                    <button type="button" id="cancelCustomType"
                            class="flex-1 bg-gray-700 text-white px-4 py-3 rounded-xl font-bold hover:bg-gray-600 transition-all">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Tab switching
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('[id^="tab-"]').forEach(el => {
                el.classList.remove('bg-gradient-to-r', 'from-cyan-600', 'to-purple-600', 'text-white');
                el.classList.add('text-gray-400', 'hover:bg-gray-700');
            });
            
            // Show selected tab
            document.getElementById('content-' + tabName).classList.remove('hidden');
            const activeTab = document.getElementById('tab-' + tabName);
            activeTab.classList.add('bg-gradient-to-r', 'from-cyan-600', 'to-purple-600', 'text-white');
            activeTab.classList.remove('text-gray-400', 'hover:bg-gray-700');
        }

        // Load workout types
        async function loadWorkoutTypes() {
            try {
                const response = await fetch('{{ route("member.workout-types.index") }}');
                const data = await response.json();
                
                const select = document.getElementById('workoutTypeSelect');
                select.innerHTML = '<option value="">-- Pilih (Opsional) --</option>';
                
                if (data.default && data.default.length > 0) {
                    const defaultGroup = document.createElement('optgroup');
                    defaultGroup.label = 'Tipe Latihan Default';
                    data.default.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.id;
                        option.textContent = `${type.icon} ${type.name}`;
                        option.dataset.isCustom = 'false';
                        defaultGroup.appendChild(option);
                    });
                    select.appendChild(defaultGroup);
                }
                
                if (data.custom && data.custom.length > 0) {
                    const customGroup = document.createElement('optgroup');
                    customGroup.label = 'Tipe Latihan Kustom';
                    data.custom.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.id;
                        option.textContent = `${type.icon} ${type.name}`;
                        option.dataset.isCustom = 'true';
                        customGroup.appendChild(option);
                    });
                    select.appendChild(customGroup);
                }
            } catch (error) {
                console.error('Error loading workout types:', error);
            }
        }

        document.getElementById('workoutTypeSelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const isCustom = selectedOption.dataset.isCustom === 'true';
            
            if (isCustom) {
                document.getElementById('customWorkoutTypeId').value = this.value;
                this.value = '';
            } else {
                document.getElementById('customWorkoutTypeId').value = '';
            }
        });

        document.getElementById('addCustomTypeBtn').addEventListener('click', () => {
            document.getElementById('customWorkoutModal').classList.remove('hidden');
            document.getElementById('customWorkoutName').value = '';
        });

        document.getElementById('cancelCustomType').addEventListener('click', () => {
            document.getElementById('customWorkoutModal').classList.add('hidden');
        });

        document.getElementById('saveCustomType').addEventListener('click', async () => {
            const name = document.getElementById('customWorkoutName').value.trim();
            const category = document.getElementById('customWorkoutCategory').value;
            
            if (!name) {
                alert('Nama latihan harus diisi!');
                return;
            }
            
            try {
                const response = await fetch('{{ route("member.custom-workout-types.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name, category })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    document.getElementById('customWorkoutModal').classList.add('hidden');
                    await loadWorkoutTypes();
                    document.getElementById('customWorkoutTypeId').value = result.workout_type.id;
                    document.getElementById('workoutTypeSelect').value = '';
                } else {
                    alert('Gagal menambahkan tipe latihan');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            }
        });

        loadWorkoutTypes();
    </script>
    @endpush
</x-app-layout>
