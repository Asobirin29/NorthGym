<x-app-layout>
    <div class="max-w-4xl mx-auto">
        
        <!-- Back Link -->
        <a href="{{ route('member.workout-plans') }}" 
           class="inline-flex items-center gap-2 font-label-code text-xs text-text-muted hover:text-primary-container uppercase tracking-wider mb-6 transition-all">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            <span>KEMBALI KE WORKOUT PLANS</span>
        </a>

        <!-- Main Protocol Card -->
        <div class="bg-surface-card border border-border-default rounded overflow-hidden backdrop-blur-md">
            
            <!-- Media Section -->
            <div class="aspect-video bg-surface-container-lowest relative border-b border-border-default">
                @if($workoutPlan->media_url_full)
                    @if(str_contains($workoutPlan->media_url_full, 'youtube') || str_contains($workoutPlan->media_url_full, 'youtu.be'))
                        @php
                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $workoutPlan->media_url_full, $matches);
                            $videoId = $matches[1] ?? '';
                        @endphp
                        @if($videoId)
                            <iframe class="w-full h-full" 
                                    src="https://www.youtube.com/embed/{{ $videoId }}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen></iframe>
                        @endif
                    @else
                        <img src="{{ $workoutPlan->media_url_full }}" alt="{{ $workoutPlan->judul }}" 
                             class="w-full h-full object-cover">
                    @endif
                @else
                    <div class="absolute inset-0 flex items-center justify-center bg-surface-container-lowest">
                        <span class="material-symbols-outlined text-text-tertiary text-7xl">fitness_center</span>
                    </div>
                @endif
            </div>

            <!-- Content Area -->
            <div class="p-6 sm:p-8">
                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-2.5 py-1 rounded font-label-meta text-xs uppercase font-bold
                        {{ $workoutPlan->level === 'beginner' ? 'bg-primary-hover-subtle text-primary-container border border-primary-container/40' : 
                           ($workoutPlan->level === 'intermediate' ? 'bg-status-warning-container text-status-warning border border-status-warning/40' : 'bg-status-error-container text-status-error border border-status-error/40') }}">
                        LEVEL: {{ strtoupper($workoutPlan->level) }}
                    </span>
                    <span class="px-2.5 py-1 rounded font-label-meta text-xs uppercase font-bold bg-surface-container text-text-secondary border border-border-default">
                        KATEGORI: {{ strtoupper($workoutPlan->kategori) }}
                    </span>
                    <span class="px-2.5 py-1 rounded font-label-meta text-xs uppercase font-bold bg-surface-container text-text-muted border border-border-default">
                        REF #{{ str_pad($workoutPlan->id, 4, '0', STR_PAD_LEFT) }}
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-2xl sm:text-3xl font-headline-lg font-extrabold uppercase text-text-primary tracking-tight mb-4">
                    {{ $workoutPlan->judul }}
                </h1>

                <!-- Meta Info Strip -->
                <div class="flex items-center gap-6 text-label-code text-xs text-text-muted pb-6 mb-6 border-b border-border-default">
                    @if($workoutPlan->durasi_menit)
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-primary-container text-base">timer</span>
                            <span>{{ $workoutPlan->durasi_menit }} MENIT</span>
                        </span>
                    @endif
                    @if($workoutPlan->kalori_estimasi)
                        <span class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-status-warning text-base">local_fire_department</span>
                            <span>{{ $workoutPlan->kalori_estimasi }} KCAL EST.</span>
                        </span>
                    @endif
                </div>

                <!-- Protocol Instruction / Description -->
                <div>
                    <h3 class="font-label-tag text-xs text-primary-container uppercase tracking-widest mb-3">
                        [ INSTRUKSI & PANDUAN EKSEKUSI ]
                    </h3>
                    <div class="font-body-base text-text-secondary text-sm sm:text-base leading-relaxed whitespace-pre-line bg-surface-container-lowest p-5 rounded border border-border-default">
                        {{ $workoutPlan->deskripsi }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Protocols -->
        @if($relatedPlans->count() > 0)
            <div class="mt-12">
                <div class="font-label-tag text-xs text-text-muted uppercase tracking-widest mb-4">
                    [ PROTOKOL TERKAIT // REKOMENDASI ]
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($relatedPlans as $related)
                        <div class="bg-surface-card border border-border-default rounded p-4 hover:border-primary-container transition-all flex flex-col justify-between">
                            <div class="flex gap-4">
                                <div class="w-16 h-16 bg-surface-container-lowest border border-border-default rounded flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-primary-container text-2xl">fitness_center</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-headline-sm font-bold text-sm text-text-primary uppercase truncate mb-1">
                                        {{ $related->judul }}
                                    </h4>
                                    <p class="font-body-base text-text-secondary text-xs line-clamp-2 mb-2">
                                        {{ Str::limit($related->deskripsi, 80) }}
                                    </p>
                                    <span class="font-label-meta text-[10px] text-primary-container uppercase">
                                        {{ strtoupper($related->level) }} &bull; {{ strtoupper($related->kategori) }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4 pt-3 border-t border-border-default flex justify-end">
                                <a href="{{ route('member.workout-plans.show', $related) }}" 
                                   class="font-label-code text-xs text-primary-container hover:underline uppercase tracking-wider flex items-center gap-1">
                                    <span>LIHAT DETAIL</span>
                                    <span class="material-symbols-outlined text-xs">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
