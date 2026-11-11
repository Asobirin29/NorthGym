<x-app-layout>
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-glass border border-border-default mb-3 backdrop-blur-md rounded">
                <span class="w-1.5 h-1.5 bg-primary-container rounded-none pulse-volt"></span>
                <span class="font-label-tag text-label-tag text-text-muted tracking-widest uppercase">
                    [ EDIT PROTOCOL // KINETIC PROGRESSION ]
                </span>
            </div>
            <h1 class="text-display-section-mobile md:text-headline-lg font-headline-lg font-extrabold uppercase tracking-tight text-text-primary">
                EDIT LOG <span class="text-primary-container">PROGRESS</span>.
            </h1>
            <p class="font-body-base text-text-secondary text-sm md:text-base mt-2">
                Perbarui data antropometri dan rekaman visual tanggal {{ $progress->tanggal->format('d M Y') }}.
            </p>
        </div>

        <!-- Form -->
        <form action="{{ route('member.progress.update', $progress) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Date & Workout Type -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Date -->
                <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                    <label class="block font-label-code text-xs uppercase tracking-wider text-text-primary mb-2">
                        TANGGAL LOGGING *
                    </label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $progress->tanggal->format('Y-m-d')) }}" 
                           class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all" required>
                    @error('tanggal')
                        <p class="text-status-error font-label-code text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Workout Type -->
                <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                    <label class="block font-label-code text-xs uppercase tracking-wider text-text-primary mb-2">
                        TIPE LATIHAN UTAMA
                    </label>
                    <div class="flex gap-2">
                        <select name="workout_type_id" id="workoutTypeSelect" 
                                class="flex-1 bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all">
                            <option value="">-- PILIH TIPE (OPSIONAL) --</option>
                        </select>
                        <button type="button" id="addCustomTypeBtn"
                                class="px-4 py-2 bg-surface-container hover:bg-surface-container-high border border-border-subtle hover:border-primary-container text-primary-container rounded font-label-code text-xs uppercase tracking-wider transition-all whitespace-nowrap">
                            + KUSTOM
                        </button>
                    </div>
                    <input type="hidden" name="custom_workout_type_id" id="customWorkoutTypeId">
                </div>
            </div>

            <!-- Body Measurements Grid -->
            <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                <div class="flex items-center gap-2 pb-3 border-b border-border-default mb-4">
                    <span class="material-symbols-outlined text-primary-container text-base">straighten</span>
                    <h3 class="font-headline-sm font-bold text-xs uppercase tracking-wider text-text-primary">
                        DATA UKURAN FISIK & LINGKAR
                    </h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                            BERAT BADAN (KG)
                        </label>
                        <input type="number" name="berat_badan" value="{{ old('berat_badan', $progress->berat_badan) }}" step="0.01"
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all"
                               placeholder="70.5">
                    </div>
                    <div>
                        <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                            TINGGI BADAN (CM)
                        </label>
                        <input type="number" name="tinggi_badan" value="{{ old('tinggi_badan', $progress->tinggi_badan) }}" step="0.01"
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all"
                               placeholder="175">
                    </div>
                    <div>
                        <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                            LINGKAR PERUT (CM)
                        </label>
                        <input type="number" name="lingkar_perut" value="{{ old('lingkar_perut', $progress->lingkar_perut) }}" step="0.01"
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all"
                               placeholder="80">
                    </div>
                    <div>
                        <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                            LINGKAR DADA (CM)
                        </label>
                        <input type="number" name="lingkar_dada" value="{{ old('lingkar_dada', $progress->lingkar_dada) }}" step="0.01"
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all"
                               placeholder="95">
                    </div>
                    <div>
                        <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                            LINGKAR LENGAN (CM)
                        </label>
                        <input type="number" name="lingkar_lengan" value="{{ old('lingkar_lengan', $progress->lingkar_lengan) }}" step="0.01"
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all"
                               placeholder="35">
                    </div>
                </div>
            </div>

            <!-- Current Photos Display -->
            @if($progress->foto_before_path || $progress->foto_after_path)
                <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                    <div class="flex items-center gap-2 pb-3 border-b border-border-default mb-4">
                        <span class="material-symbols-outlined text-primary-container text-base">collections</span>
                        <h3 class="font-headline-sm font-bold text-xs uppercase tracking-wider text-text-primary">
                            FOTO TERSIMPAN SAAT INI
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if($progress->foto_before_path)
                            <div class="p-3 bg-surface-container-lowest border border-border-default rounded">
                                <span class="font-label-meta text-[10px] text-text-muted uppercase block mb-2">BEFORE PHOTO</span>
                                <img src="{{ Storage::url($progress->foto_before_path) }}" 
                                     alt="Before" class="w-full h-44 object-cover rounded border border-border-default">
                            </div>
                        @endif
                        @if($progress->foto_after_path)
                            <div class="p-3 bg-surface-container-lowest border border-border-default rounded">
                                <span class="font-label-meta text-[10px] text-primary-container uppercase block mb-2">AFTER PHOTO</span>
                                <img src="{{ Storage::url($progress->foto_after_path) }}" 
                                     alt="After" class="w-full h-44 object-cover rounded border border-border-default">
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Replace Photos (Optional) -->
            <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                <div class="flex items-center gap-2 pb-3 border-b border-border-default mb-4">
                    <span class="material-symbols-outlined text-primary-container text-base">photo_camera</span>
                    <h3 class="font-headline-sm font-bold text-xs uppercase tracking-wider text-text-primary">
                        UNGGAH / GANTI FOTO (OPSIONAL)
                    </h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-surface-container-lowest border border-border-default rounded">
                        <label class="block font-label-code text-xs uppercase tracking-wider text-text-primary mb-2">GANTI FOTO BEFORE</label>
                        <input type="file" name="foto_before" accept="image/*"
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-3 py-2 text-text-secondary font-label-code text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:bg-surface-container file:text-text-primary file:font-bold hover:file:bg-surface-container-high cursor-pointer">
                    </div>
                    <div class="p-4 bg-surface-container-lowest border border-border-default rounded">
                        <label class="block font-label-code text-xs uppercase tracking-wider text-text-primary mb-2">GANTI FOTO AFTER</label>
                        <input type="file" name="foto_after" accept="image/*"
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-3 py-2 text-text-secondary font-label-code text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:bg-primary-container file:text-surface-container-lowest file:font-bold hover:file:bg-primary-fixed cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                <label class="block font-label-code text-xs uppercase tracking-wider text-text-primary mb-2">
                    CATATAN PERFORMA & EVALUASI
                </label>
                <textarea name="catatan" rows="3"
                          class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all resize-none"
                          placeholder="Catatan update progress...">{{ old('catatan', $progress->catatan) }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4">
                <button type="submit" 
                        class="flex-1 py-4 bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-label-code text-sm uppercase tracking-wider font-extrabold rounded neon-glow-btn transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-base">save</span>
                    <span>UPDATE LOG PROGRESS</span>
                </button>
                <a href="{{ route('member.progress.index') }}" 
                   class="px-6 py-4 bg-surface-container hover:bg-surface-container-high border border-border-subtle text-text-muted hover:text-text-primary font-label-code text-sm uppercase tracking-wider rounded transition-all">
                    BATAL
                </a>
            </div>
        </form>

    </div>

    <!-- Custom Workout Type Modal -->
    <div id="customWorkoutModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-surface-vault border border-border-default rounded p-6 max-w-md w-full shadow-2xl">
            <h3 class="font-headline-sm font-bold text-base text-text-primary uppercase mb-4">
                + TAMBAH TIPE LATIHAN KUSTOM
            </h3>
            <div class="space-y-4 font-label-code">
                <div>
                    <label class="block text-text-muted text-xs uppercase tracking-wider mb-2">Nama Latihan</label>
                    <input type="text" id="customWorkoutName" 
                           class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-2.5 text-text-primary text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all"
                           placeholder="Misal: Calisthenics / Hyrox">
                </div>
                <div>
                    <label class="block text-text-muted text-xs uppercase tracking-wider mb-2">Kategori</label>
                    <select id="customWorkoutCategory" 
                            class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-2.5 text-text-primary text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all">
                        <option value="cardio">Cardio</option>
                        <option value="strength">Strength</option>
                        <option value="flexibility">Flexibility</option>
                        <option value="other" selected>Other</option>
                    </select>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" id="saveCustomType"
                            class="flex-1 py-2.5 bg-primary-container text-surface-container-lowest font-bold uppercase tracking-wider rounded text-xs transition-all">
                        SIMPAN
                    </button>
                    <button type="button" id="cancelCustomType"
                            class="flex-1 py-2.5 bg-surface-container hover:bg-surface-container-high border border-border-subtle text-text-muted hover:text-text-primary rounded text-xs transition-all">
                        BATAL
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const currentWorkoutTypeId = {{ $progress->workout_type_id ?? 'null' }};
        const currentCustomWorkoutTypeId = {{ $progress->custom_workout_type_id ?? 'null' }};

        async function loadWorkoutTypes() {
            try {
                const response = await fetch('{{ route("member.workout-types.index") }}');
                const data = await response.json();
                
                const select = document.getElementById('workoutTypeSelect');
                select.innerHTML = '<option value="">-- PILIH TIPE (OPSIONAL) --</option>';
                
                if (data.default && data.default.length > 0) {
                    const defaultGroup = document.createElement('optgroup');
                    defaultGroup.label = 'TIPE LATIHAN DEFAULT';
                    data.default.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.id;
                        option.textContent = `${type.name}`;
                        option.dataset.isCustom = 'false';
                        if (currentWorkoutTypeId && currentWorkoutTypeId === type.id) {
                            option.selected = true;
                        }
                        defaultGroup.appendChild(option);
                    });
                    select.appendChild(defaultGroup);
                }
                
                if (data.custom && data.custom.length > 0) {
                    const customGroup = document.createElement('optgroup');
                    customGroup.label = 'TIPE LATIHAN KUSTOM';
                    data.custom.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.id;
                        option.textContent = `${type.name}`;
                        option.dataset.isCustom = 'true';
                        if (currentCustomWorkoutTypeId && currentCustomWorkoutTypeId === type.id) {
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

        document.getElementById('workoutTypeSelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const customInput = document.getElementById('customWorkoutTypeId');
            if (selectedOption && selectedOption.dataset.isCustom === 'true') {
                customInput.value = this.value;
            } else {
                customInput.value = '';
            }
        });

        document.getElementById('addCustomTypeBtn').addEventListener('click', function() {
            document.getElementById('customWorkoutModal').classList.remove('hidden');
        });

        document.getElementById('cancelCustomType').addEventListener('click', function() {
            document.getElementById('customWorkoutModal').classList.add('hidden');
            document.getElementById('customWorkoutName').value = '';
        });

        document.getElementById('saveCustomType').addEventListener('click', async function() {
            const name = document.getElementById('customWorkoutName').value.trim();
            const category = document.getElementById('customWorkoutCategory').value;
            
            if (!name) {
                alert('Nama latihan harus diisi');
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
                
                const data = await response.json();
                
                if (response.ok) {
                    await loadWorkoutTypes();
                    document.getElementById('workoutTypeSelect').value = data.id;
                    document.getElementById('customWorkoutTypeId').value = data.id;
                    document.getElementById('customWorkoutModal').classList.add('hidden');
                    document.getElementById('customWorkoutName').value = '';
                } else {
                    alert(data.message || 'Gagal menyimpan tipe latihan');
                }
            } catch (error) {
                console.error('Error saving custom workout type:', error);
                alert('Terjadi kesalahan saat menyimpan');
            }
        });

        document.addEventListener('DOMContentLoaded', loadWorkoutTypes);
    </script>
    @endpush
</x-app-layout>
