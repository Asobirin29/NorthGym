<x-app-layout>
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Telemetry Block -->
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-glass border border-border-default mb-3 backdrop-blur-md rounded">
                <span class="w-1.5 h-1.5 bg-primary-container rounded-none pulse-volt"></span>
                <span class="font-label-tag text-label-tag text-text-muted tracking-widest uppercase">
                    [ MODULE.02 // KINETIC PROTOCOL MATRIX ]
                </span>
            </div>
            <h1 class="text-display-section-mobile md:text-headline-lg font-headline-lg font-extrabold uppercase tracking-tight text-text-primary">
                WORKOUT <span class="text-primary-container">PLANS</span>.
            </h1>
            <p class="font-body-base text-text-secondary text-sm md:text-base mt-2 max-w-2xl">
                Program latihan terstruktur berbasis biomekanika dan beban progresif untuk optimasi hipertrofi serta kapasitas metabolik Anda.
            </p>
        </div>

        <!-- Filter Sub-HUD Bar -->
        <form method="GET" class="bg-surface-vault border border-border-default p-5 mb-8 rounded backdrop-blur-md">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-end gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                        FILTER BY KATEGORI
                    </label>
                    <select name="kategori" onchange="this.form.submit()"
                            class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-2.5 text-text-primary font-label-code text-xs uppercase tracking-wider focus:border-primary-container focus:ring-1 focus:ring-primary-container">
                        <option value="">SEMUA KATEGORI</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                                {{ strtoupper($category) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block font-label-meta text-[11px] text-text-muted uppercase tracking-wider mb-2">
                        INTENSITY LEVEL
                    </label>
                    <select name="level" onchange="this.form.submit()"
                            class="w-full bg-surface-container-low border border-border-subtle rounded px-4 py-2.5 text-text-primary font-label-code text-xs uppercase tracking-wider focus:border-primary-container focus:ring-1 focus:ring-primary-container">
                        <option value="">SEMUA LEVEL</option>
                        @foreach($levels as $level)
                            <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>
                                {{ strtoupper($level) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if(request('kategori') || request('level'))
                    <div>
                        <a href="{{ route('member.workout-plans') }}" 
                           class="px-5 py-2.5 bg-surface-container hover:bg-surface-container-high border border-border-subtle hover:border-status-error text-text-muted hover:text-status-error font-label-code text-xs uppercase tracking-wider rounded transition-all flex items-center justify-center gap-1.5 h-[42px]">
                            <span class="material-symbols-outlined text-[16px]">restart_alt</span>
                            <span>RESET</span>
                        </a>
                    </div>
                @endif
            </div>
        </form>

        <!-- Workout Plans Grid -->
        @if($workoutPlans->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($workoutPlans as $plan)
                    <div class="bg-surface-card border border-border-default rounded overflow-hidden hover:border-primary-container transition-all group flex flex-col justify-between">
                        <!-- Media Preview Container -->
                        <div>
                            <div class="aspect-video bg-surface-container-lowest relative overflow-hidden border-b border-border-default">
                                @if($plan->media_url_full)
                                    @if(str_contains($plan->media_url_full, 'youtube'))
                                        <div class="absolute inset-0 flex items-center justify-center bg-surface-container-lowest/90">
                                            <span class="material-symbols-outlined text-primary-container text-5xl">smart_display</span>
                                        </div>
                                    @else
                                        <img src="{{ $plan->media_url_full }}" alt="{{ $plan->judul }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 opacity-80 group-hover:opacity-100">
                                    @endif
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center bg-surface-container-lowest">
                                        <span class="material-symbols-outlined text-text-tertiary text-6xl">fitness_center</span>
                                    </div>
                                @endif

                                <!-- Corner Badges -->
                                <div class="absolute top-3 left-3 flex gap-2">
                                    <span class="px-2 py-0.5 rounded font-label-meta text-[10px] font-bold tracking-wider uppercase
                                        {{ $plan->level === 'beginner' ? 'bg-primary-hover-subtle text-primary-container border border-primary-container/40' : 
                                           ($plan->level === 'intermediate' ? 'bg-status-warning-container text-status-warning border border-status-warning/40' : 'bg-status-error-container text-status-error border border-status-error/40') }}">
                                        {{ strtoupper($plan->level) }}
                                    </span>
                                    <span class="px-2 py-0.5 rounded font-label-meta text-[10px] font-bold tracking-wider uppercase bg-surface-vault text-text-secondary border border-border-default">
                                        {{ strtoupper($plan->kategori) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Plan Metadata & Body -->
                            <div class="p-5">
                                <div class="font-label-tag text-[10px] text-text-muted tracking-widest uppercase mb-1">
                                    PROGRAM // {{ str_pad($plan->id, 3, '0', STR_PAD_LEFT) }}
                                </div>
                                <h3 class="font-headline-sm font-bold text-base uppercase text-text-primary mb-2 group-hover:text-primary-container transition-colors">
                                    {{ $plan->judul }}
                                </h3>
                                <p class="font-body-base text-text-secondary text-xs line-clamp-2 leading-relaxed mb-4">
                                    {{ Str::limit($plan->deskripsi, 110) }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer Telemetry & Button -->
                        <div class="p-5 pt-0">
                            <div class="pt-3 border-t border-border-default flex items-center justify-between font-label-meta text-[11px] text-text-muted mb-4">
                                @if($plan->durasi_menit)
                                    <span class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[14px] text-primary-container">timer</span>
                                        <span>{{ $plan->durasi_menit }} MIN</span>
                                    </span>
                                @endif
                                @if($plan->kalori_estimasi)
                                    <span class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[14px] text-status-warning">local_fire_department</span>
                                        <span>{{ $plan->kalori_estimasi }} KCAL</span>
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('member.workout-plans.show', $plan) }}" 
                               class="w-full py-2.5 px-4 bg-surface-container hover:bg-primary-container hover:text-surface-container-lowest text-text-primary font-label-code text-xs uppercase tracking-wider font-bold rounded transition-all flex items-center justify-center gap-2 group/btn">
                                <span>EKSEKUSI PROTOKOL</span>
                                <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $workoutPlans->links() }}
            </div>
        @else
            <div class="bg-surface-vault border border-border-default rounded p-12 text-center backdrop-blur-md">
                <span class="material-symbols-outlined text-5xl text-text-muted mb-3">fitness_center</span>
                <h3 class="font-headline-sm font-bold text-lg text-text-primary uppercase mb-2">TIDAK ADA PROTOKOL LATIHAN</h3>
                <p class="font-body-base text-text-secondary text-sm max-w-md mx-auto">
                    Belum ada program workout yang sesuai dengan filter kategori atau level yang dipilih.
                </p>
            </div>
        @endif

    </div>
</x-app-layout>
