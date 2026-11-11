<x-app-layout>
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-glass border border-border-default mb-3 backdrop-blur-md rounded">
                <span class="w-1.5 h-1.5 bg-primary-container rounded-none pulse-volt"></span>
                <span class="font-label-tag text-label-tag text-text-muted tracking-widest uppercase">
                    [ ENTRY // BIOMETRIC CALIBRATION ]
                </span>
            </div>
            <h1 class="text-display-section-mobile md:text-headline-lg font-headline-lg font-extrabold uppercase tracking-tight text-text-primary">
                INPUT METRIK <span class="text-primary-container">TUBUH</span>.
            </h1>
            <p class="font-body-base text-text-secondary text-sm md:text-base mt-2">
                Masukkan parameter berat badan dan estimasi komposisi tubuh untuk komputasi otomatis BMI dan rekomendasi beban.
            </p>
        </div>

        <!-- Latest Metric Reference Banner -->
        @if($latestMetric)
            <div class="bg-surface-card border border-border-default rounded p-5 mb-8 backdrop-blur-md">
                <div class="flex items-center justify-between pb-3 border-b border-border-default mb-3">
                    <span class="font-label-tag text-xs text-primary-container tracking-wider uppercase">
                        [ REKAMAN TERAKHIR: {{ $latestMetric->recorded_at->format('d M Y') }} ]
                    </span>
                    <span class="font-label-meta text-[11px] text-text-muted">
                        {{ $latestMetric->recorded_at->diffForHumans() }}
                    </span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 font-label-code">
                    <div class="p-2.5 bg-surface-container-lowest border border-border-default rounded">
                        <span class="text-[10px] text-text-muted uppercase font-label-meta block">BERAT</span>
                        <span class="text-text-primary font-bold">{{ $latestMetric->weight }} KG</span>
                    </div>
                    <div class="p-2.5 bg-surface-container-lowest border border-border-default rounded">
                        <span class="text-[10px] text-text-muted uppercase font-label-meta block">BMI</span>
                        <span class="text-primary-container font-bold">{{ $latestMetric->bmi }}</span>
                    </div>
                    <div class="p-2.5 bg-surface-container-lowest border border-border-default rounded">
                        <span class="text-[10px] text-text-muted uppercase font-label-meta block">LEMAK</span>
                        <span class="text-status-warning font-bold">{{ $latestMetric->body_fat_percentage ?? '--' }}%</span>
                    </div>
                    <div class="p-2.5 bg-surface-container-lowest border border-border-default rounded">
                        <span class="text-[10px] text-text-muted uppercase font-label-meta block">OTOT</span>
                        <span class="text-primary-container font-bold">{{ $latestMetric->muscle_mass_percentage ?? '--' }}%</span>
                    </div>
                    <div class="p-2.5 bg-surface-container-lowest border border-border-default rounded">
                        <span class="text-[10px] text-text-muted uppercase font-label-meta block">AIR</span>
                        <span class="text-text-secondary font-bold">{{ $latestMetric->water_percentage ?? '--' }}%</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('member.body-metrics.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Date -->
            <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                <label class="block font-label-code text-xs uppercase tracking-wider text-text-primary mb-2">
                    TANGGAL LOGGING *
                </label>
                <input type="date" name="recorded_at" value="{{ old('recorded_at', date('Y-m-d')) }}" 
                       class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all" required>
                @error('recorded_at')
                    <p class="text-status-error font-label-code text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Basic Measurements -->
            <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                <div class="flex items-center gap-2 pb-3 border-b border-border-default mb-4">
                    <span class="material-symbols-outlined text-primary-container text-base">scale</span>
                    <h3 class="font-headline-sm font-bold text-xs uppercase tracking-wider text-text-primary">
                        PENGUKURAN DASAR (WAJIB)
                    </h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                            BERAT BADAN (KG) *
                        </label>
                        <input type="number" name="weight" value="{{ old('weight', $latestMetric?->weight) }}" 
                               step="0.01" min="20" max="500" required
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all"
                               placeholder="Contoh: 72.5">
                        @error('weight')
                            <p class="text-status-error font-label-code text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                            TINGGI BADAN (CM) *
                        </label>
                        <input type="number" name="height" value="{{ old('height', $latestMetric?->height) }}" 
                               step="0.01" min="50" max="300" required
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all"
                               placeholder="Contoh: 175">
                        @error('height')
                            <p class="text-status-error font-label-code text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Body Composition (Optional) -->
            <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                <div class="flex items-center gap-2 pb-3 border-b border-border-default mb-4">
                    <span class="material-symbols-outlined text-primary-container text-base">pie_chart</span>
                    <h3 class="font-headline-sm font-bold text-xs uppercase tracking-wider text-text-primary">
                        ESTIMASI KOMPOSISI TUBUH (OPSIONAL)
                    </h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                            LEMAK TUBUH (%)
                        </label>
                        <input type="number" name="body_fat_percentage" value="{{ old('body_fat_percentage') }}" 
                               step="0.01" min="0" max="100"
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all"
                               placeholder="16.5">
                    </div>
                    <div>
                        <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                            MASSA OTOT (%)
                        </label>
                        <input type="number" name="muscle_mass_percentage" value="{{ old('muscle_mass_percentage') }}" 
                               step="0.01" min="0" max="100"
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all"
                               placeholder="42.0">
                    </div>
                    <div>
                        <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                            KADAR AIR (%)
                        </label>
                        <input type="number" name="water_percentage" value="{{ old('water_percentage') }}" 
                               step="0.01" min="0" max="100"
                               class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all"
                               placeholder="58.0">
                    </div>
                </div>
                <p class="font-label-meta text-[10px] text-text-muted mt-3">
                    INFO: Dapat diperoleh dari scanner InBody atau smart scale di gym compound.
                </p>
            </div>

            <!-- Notes -->
            <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                <label class="block font-label-code text-xs uppercase tracking-wider text-text-primary mb-2">
                    CATATAN PERFORMA & KONDISI FISIK
                </label>
                <textarea name="notes" rows="3"
                          class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-3 text-text-primary font-label-code text-sm focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all resize-none"
                          placeholder="Misal: Sesi fasted pagi hari, hidrasi optimal...">{{ old('notes') }}</textarea>
            </div>

            <!-- Submit & Cancel Buttons -->
            <div class="flex items-center gap-4">
                <button type="submit" 
                        class="flex-1 py-4 bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-label-code text-sm uppercase tracking-wider font-extrabold rounded neon-glow-btn transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-base">save</span>
                    <span>SIMPAN DATA METRIK</span>
                </button>
                <a href="{{ route('member.body-metrics.index') }}" 
                   class="px-6 py-4 bg-surface-container hover:bg-surface-container-high border border-border-subtle text-text-muted hover:text-text-primary font-label-code text-sm uppercase tracking-wider rounded transition-all">
                    BATAL
                </a>
            </div>
        </form>

    </div>
</x-app-layout>
