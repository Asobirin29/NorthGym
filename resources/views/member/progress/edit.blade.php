<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-500">
                    ✏️ Edit Progress
                </h1>
                <p class="text-gray-400 mt-2">Perbarui data progress Anda</p>
            </div>

            <!-- Form -->
            <form action="{{ route('member.progress.update', $progress) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Date -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <label class="block text-white font-bold mb-2">📅 Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $progress->tanggal->format('Y-m-d')) }}" 
                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all" required>
                    @error('tanggal')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Workout Type Selector -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <label class="block text-white font-bold mb-2">🏋️ Tipe Latihan</label>
                    <div id="workout-type-selector" class="space-y-4">
                        <select name="workout_type_id" id="workoutTypeSelect" 
                                class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                       focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
                            <option value="">-- Pilih Tipe Latihan (Opsional) --</option>
                        </select>
                        
                        <button type="button" id="addCustomTypeBtn"
                                class="w-full bg-purple-700 hover:bg-purple-600 text-white px-4 py-3 rounded-xl font-medium transition-all">
                            + Tambah Tipe Latihan Kustom
                        </button>
                    </div>
                    <input type="hidden" name="custom_workout_type_id" id="customWorkoutTypeId">
                </div>

                <!-- Body Measurements -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <h3 class="text-lg font-bold text-white mb-4">📏 Ukuran Tubuh</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Berat Badan (kg)</label>
                            <input type="number" name="berat_badan" value="{{ old('berat_badan', $progress->berat_badan) }}" step="0.01"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                   placeholder="70.5">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Tinggi Badan (cm)</label>
                            <input type="number" name="tinggi_badan" value="{{ old('tinggi_badan', $progress->tinggi_badan) }}" step="0.01"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                   placeholder="175">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Lingkar Perut (cm)</label>
                            <input type="number" name="lingkar_perut" value="{{ old('lingkar_perut', $progress->lingkar_perut) }}" step="0.01"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                   placeholder="80">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Lingkar Dada (cm)</label>
                            <input type="number" name="lingkar_dada" value="{{ old('lingkar_dada', $progress->lingkar_dada) }}" step="0.01"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                   placeholder="95">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Lingkar Lengan (cm)</label>
                            <input type="number" name="lingkar_lengan" value="{{ old('lingkar_lengan', $progress->lingkar_lengan) }}" step="0.01"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                                   placeholder="35">
                        </div>
                    </div>
                </div>

                <!-- Current Photos -->
                @if($progress->foto_before_path || $progress->foto_after_path)
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <h3 class="text-lg font-bold text-white mb-4">📸 Foto Saat Ini</h3>
                        <div class="flex gap-4">
                            @if($progress->foto_before_path)
                                <div>
                                    <p class="text-gray-400 text-sm mb-2">Before</p>
                                    <img src="{{ Storage::url($progress->foto_before_path) }}" 
                                         alt="Before" class="w-32 h-32 object-cover rounded-lg">
                                </div>
                            @endif
                            @if($progress->foto_after_path)
                                <div>
                                    <p class="text-gray-400 text-sm mb-2">After</p>
                                    <img src="{{ Storage::url($progress->foto_after_path) }}" 
                                         alt="After" class="w-32 h-32 object-cover rounded-lg">
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Photos -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <h3 class="text-lg font-bold text-white mb-4">📸 Ganti Foto (Opsional)</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Foto Before</label>
                            <input type="file" name="foto_before" accept="image/*"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                          file:bg-cyan-600 file:text-white file:cursor-pointer">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">Foto After</label>
                            <input type="file" name="foto_after" accept="image/*"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                          file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                          file:bg-purple-600 file:text-white file:cursor-pointer">
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <label class="block text-white font-bold mb-2">📝 Catatan</label>
                    <textarea name="catatan" rows="3"
                              class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                     focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all resize-none"
                              placeholder="Bagaimana perasaan Anda hari ini?">{{ old('catatan', $progress->catatan) }}</textarea>
                </div>

                <!-- Submit -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-cyan-500 to-purple-500 text-white py-4 rounded-xl 
                               font-bold text-lg hover:opacity-90 transition-all hover:scale-[1.02] shadow-lg">
                    💾 Update Progress
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
        // Load workout types
        async function loadWorkoutTypes() {
            try {
                const response = await fetch('{{ route("member.workout-types.index") }}');
                const data = await response.json();
                
                const select = document.getElementById('workoutTypeSelect');
                select.innerHTML = '<option value="">-- Pilih Tipe Latihan (Opsional) --</option>';
                
                // Default types
                if (data.default && data.default.length > 0) {
                    const defaultGroup = document.createElement('optgroup');
                    defaultGroup.label = 'Tipe Latihan Default';
                    data.default.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.id;
                        option.textContent = `${type.icon} ${type.name}`;
                        option.dataset.isCustom = 'false';
                        
                        // Pre-select if matches current progress
                        if ({{ $progress->workout_type_id ?? 'null' }} == type.id) {
                            option.selected = true;
                        }
                        
                        defaultGroup.appendChild(option);
                    });
                    select.appendChild(defaultGroup);
                }
                
                // Custom types
                if (data.custom && data.custom.length > 0) {
                    const customGroup = document.createElement('optgroup');
                    customGroup.label = 'Tipe Latihan Kustom';
                    data.custom.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.id;
                        option.textContent = `${type.icon} ${type.name}`;
                        option.dataset.isCustom = 'true';
                        
                        // Pre-select if matches current progress
                        if ({{ $progress->custom_workout_type_id ?? 'null' }} == type.id) {
                            option.selected = true;
                            document.getElementById('customWorkoutTypeId').value = type.id;
                        }
                        
                        customGroup.appendChild(option);
                    });
                    select.appendChild(customGroup);
                }
            } catch (error) {
                console.error('Error loading workout types:', error);
            }
        }

        // Handle workout type selection
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

        // Modal handlers
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
                    
                    // Auto-select the newly created type
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

        // Load on page load
        loadWorkoutTypes();
    </script>
    @endpush
</x-app-layout>
