<x-app-layout>
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Telemetry Block -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-glass border border-border-default mb-3 backdrop-blur-md rounded">
                    <span class="w-1.5 h-1.5 bg-primary-container rounded-none pulse-volt"></span>
                    <span class="font-label-tag text-label-tag text-text-muted tracking-widest uppercase">
                        [ MODULE.04 // BIOMETRIC COMPOSITION VAULT ]
                    </span>
                </div>
                <h1 class="text-display-section-mobile md:text-headline-lg font-headline-lg font-extrabold uppercase tracking-tight text-text-primary">
                    BODY <span class="text-primary-container">METRICS</span>.
                </h1>
                <p class="font-body-base text-text-secondary text-sm md:text-base mt-2 max-w-2xl">
                    Log komposisi tubuh berkala untuk mengukur retensi massa otot hipertrofi, persentase visceral adiposa, dan status indeks massa tubuh (BMI).
                </p>
            </div>
            <div>
                <a href="{{ route('member.body-metrics.create') }}" 
                   class="h-[46px] px-6 bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-label-code text-xs uppercase tracking-wider font-extrabold rounded flex items-center justify-center gap-2 neon-glow-btn transition-all duration-200">
                    <span class="material-symbols-outlined text-base">add</span>
                    <span>INPUT METRIK BARU</span>
                </a>
            </div>
        </div>

        <!-- Latest Metrics Summary KPI Grid -->
        @if($metrics->count() > 0)
            @php $latest = $metrics->first(); @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Weight Card -->
                <div class="bg-surface-card border border-border-default p-5 rounded backdrop-blur-md relative overflow-hidden">
                    <div class="flex justify-between items-start mb-2">
                        <span class="font-label-meta text-[10px] text-text-muted tracking-widest uppercase">[ TOTAL MASS ]</span>
                        <span class="material-symbols-outlined text-primary-container text-lg">scale</span>
                    </div>
                    <div class="my-2">
                        <div class="font-headline-lg text-3xl font-extrabold text-text-primary">
                            {{ $latest->weight }} <span class="text-base text-text-muted font-normal">KG</span>
                        </div>
                    </div>
                    <div class="text-label-meta text-[11px] text-text-secondary pt-2 border-t border-border-default">
                        @if($latest->ideal_weight)
                            IDEAL TARGET: <span class="text-primary-container font-bold">{{ $latest->ideal_weight }} KG</span>
                        @else
                            TARGET: <span class="text-text-muted">NORMAL RANGE</span>
                        @endif
                    </div>
                </div>

                <!-- BMI Card -->
                <div class="bg-surface-card border border-border-default p-5 rounded backdrop-blur-md relative overflow-hidden">
                    <div class="flex justify-between items-start mb-2">
                        <span class="font-label-meta text-[10px] text-text-muted tracking-widest uppercase">[ BODY MASS INDEX ]</span>
                        <span class="material-symbols-outlined text-primary-container text-lg">straighten</span>
                    </div>
                    <div class="my-2 flex items-baseline gap-3">
                        <div class="font-headline-lg text-3xl font-extrabold text-primary-container">
                            {{ $latest->bmi }}
                        </div>
                        <span class="px-2 py-0.5 rounded font-label-meta text-[10px] uppercase font-bold
                            {{ $latest->bmi_color === 'green' ? 'bg-primary-hover-subtle text-primary-container border border-primary-container/40' : 
                               ($latest->bmi_color === 'yellow' ? 'bg-status-warning-container text-status-warning border border-status-warning/40' : 'bg-status-error-container text-status-error border border-status-error/40') }}">
                            {{ $latest->bmi_category }}
                        </span>
                    </div>
                    <div class="text-label-meta text-[11px] text-text-secondary pt-2 border-t border-border-default">
                        HEURISTIC: <span class="text-text-muted">WHO CALIBRATED</span>
                    </div>
                </div>

                <!-- Body Fat Card -->
                <div class="bg-surface-card border border-border-default p-5 rounded backdrop-blur-md relative overflow-hidden">
                    <div class="flex justify-between items-start mb-2">
                        <span class="font-label-meta text-[10px] text-text-muted tracking-widest uppercase">[ ADIPOSE RATIO ]</span>
                        <span class="material-symbols-outlined text-status-warning text-lg">water_drop</span>
                    </div>
                    <div class="my-2">
                        <div class="font-headline-lg text-3xl font-extrabold text-status-warning">
                            {{ $latest->body_fat_percentage ?? '--' }} <span class="text-base text-text-muted font-normal">%</span>
                        </div>
                    </div>
                    <div class="text-label-meta text-[11px] text-text-secondary pt-2 border-t border-border-default">
                        COMPOSITION: <span class="text-text-muted">FAT MASS PERCENT</span>
                    </div>
                </div>

                <!-- Muscle Mass Card -->
                <div class="bg-surface-card border border-border-default p-5 rounded backdrop-blur-md relative overflow-hidden">
                    <div class="flex justify-between items-start mb-2">
                        <span class="font-label-meta text-[10px] text-text-muted tracking-widest uppercase">[ SKELETAL MUSCLE ]</span>
                        <span class="material-symbols-outlined text-primary-container text-lg">fitness_center</span>
                    </div>
                    <div class="my-2">
                        <div class="font-headline-lg text-3xl font-extrabold text-primary-container">
                            {{ $latest->muscle_mass_percentage ?? '--' }} <span class="text-base text-text-muted font-normal">%</span>
                        </div>
                    </div>
                    <div class="text-label-meta text-[11px] text-text-secondary pt-2 border-t border-border-default">
                        STATUS: <span class="text-primary-container font-bold">{{ $latest->muscle_category ?? 'OPTIMAL HYPERTROPHY' }}</span>
                    </div>
                </div>
            </div>

            <!-- Historical Log Table -->
            <div class="bg-surface-vault border border-border-default rounded p-6 backdrop-blur-md">
                <div class="flex items-center justify-between pb-4 border-b border-border-default mb-4">
                    <div class="flex items-center gap-2">
                        <span class="font-label-tag text-label-tag text-primary-container tracking-widest uppercase">[ TELEMETRY LOG ARCHIVE ]</span>
                    </div>
                    <span class="font-label-meta text-[11px] text-text-muted">RECORD COUNT: {{ $metrics->total() }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse font-label-code text-xs">
                        <thead>
                            <tr class="border-b border-border-default text-label-tag font-label-tag text-text-muted">
                                <th class="py-3 px-4">TIMESTAMP</th>
                                <th class="py-3 px-4">WEIGHT (KG)</th>
                                <th class="py-3 px-4">HEIGHT (CM)</th>
                                <th class="py-3 px-4">BMI INDEX</th>
                                <th class="py-3 px-4">BODY FAT %</th>
                                <th class="py-3 px-4">MUSCLE %</th>
                                <th class="py-3 px-4">WATER %</th>
                                <th class="py-3 px-4">CLINICAL NOTES</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-default">
                            @foreach($metrics as $metric)
                                <tr class="hover:bg-surface-card transition-colors">
                                    <td class="py-3.5 px-4 text-text-primary whitespace-nowrap">
                                        <div class="font-bold">{{ $metric->recorded_at->format('d M Y') }}</div>
                                        <div class="font-label-meta text-[10px] text-text-muted">{{ $metric->recorded_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="py-3.5 px-4 text-text-primary font-bold">
                                        {{ $metric->weight }}
                                    </td>
                                    <td class="py-3.5 px-4 text-text-secondary">
                                        {{ $metric->height }}
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="text-primary-container font-bold">{{ $metric->bmi }}</span>
                                    </td>
                                    <td class="py-3.5 px-4 text-status-warning font-semibold">
                                        {{ $metric->body_fat_percentage ? $metric->body_fat_percentage . '%' : '--' }}
                                    </td>
                                    <td class="py-3.5 px-4 text-primary-container font-semibold">
                                        {{ $metric->muscle_mass_percentage ? $metric->muscle_mass_percentage . '%' : '--' }}
                                    </td>
                                    <td class="py-3.5 px-4 text-text-secondary">
                                        {{ $metric->water_percentage ? $metric->water_percentage . '%' : '--' }}
                                    </td>
                                    <td class="py-3.5 px-4 text-text-muted max-w-xs truncate">
                                        {{ $metric->notes ?? '—' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 pt-4 border-t border-border-default">
                    {{ $metrics->links() }}
                </div>
            </div>
        @else
            <div class="bg-surface-vault border border-border-default rounded p-12 text-center backdrop-blur-md">
                <span class="material-symbols-outlined text-5xl text-primary-container mb-3">straighten</span>
                <h3 class="font-headline-sm font-bold text-lg text-text-primary uppercase mb-2">BELUM ADA METRIK TERCATAT</h3>
                <p class="font-body-base text-text-secondary text-sm max-w-md mx-auto mb-6">
                    Mulai catat berat badan, tinggi badan, dan estimasi komposisi otot Anda untuk memulai pelacakan biometrik.
                </p>
                <a href="{{ route('member.body-metrics.create') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-label-code text-xs uppercase tracking-wider font-extrabold rounded neon-glow-btn transition-all">
                    <span class="material-symbols-outlined text-base">add</span>
                    <span>INPUT METRIK PERTAMA</span>
                </a>
            </div>
        @endif

    </div>
</x-app-layout>
