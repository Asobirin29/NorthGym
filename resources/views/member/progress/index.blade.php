<x-app-layout>
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Telemetry Block -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-glass border border-border-default mb-3 backdrop-blur-md rounded">
                    <span class="w-1.5 h-1.5 bg-primary-container rounded-none pulse-volt"></span>
                    <span class="font-label-tag text-label-tag text-text-muted tracking-widest uppercase">
                        [ MODULE.03 // PROGRESS LOG ARCHIVE ]
                    </span>
                </div>
                <h1 class="text-display-section-mobile md:text-headline-lg font-headline-lg font-extrabold uppercase tracking-tight text-text-primary">
                    PROGRESS <span class="text-primary-container">TRACKER</span>.
                </h1>
                <p class="font-body-base text-text-secondary text-sm md:text-base mt-2 max-w-2xl">
                    Dokumentasikan adaptasi fisik, lingkar tubuh, dan visual transformasi latihan Anda secara periodik.
                </p>
            </div>
            <div>
                <a href="{{ route('member.progress.create') }}" 
                   class="h-[46px] px-6 bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-label-code text-xs uppercase tracking-wider font-extrabold rounded flex items-center justify-center gap-2 neon-glow-btn transition-all duration-200">
                    <span class="material-symbols-outlined text-base">speed</span>
                    <span>LOG PROGRESS BARU</span>
                </a>
            </div>
        </div>

        <!-- Progress Records List -->
        @if($progressRecords->count() > 0)
            <div class="space-y-6">
                @foreach($progressRecords as $progress)
                    <div class="bg-surface-card border border-border-default rounded p-6 backdrop-blur-md hover:border-primary-container/40 transition-all">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-border-default gap-3 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-2.5 h-2.5 bg-primary-container rounded-none"></div>
                                <div>
                                    <h3 class="font-headline-sm font-bold text-base text-text-primary uppercase">
                                        LOG // {{ $progress->tanggal->format('d M Y') }}
                                    </h3>
                                    <span class="font-label-meta text-[10px] text-text-muted uppercase tracking-wider">
                                        {{ $progress->tanggal->diffForHumans() }}
                                    </span>
                                </div>
                                @if($progress->workout_type_name)
                                    <span class="ml-2 px-2 py-0.5 rounded font-label-meta text-[10px] uppercase font-bold bg-primary-hover-subtle text-primary-container border border-primary-container/30">
                                        {{ $progress->workout_type_name }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                @if($progress->bmi_category)
                                    <span class="px-2.5 py-1 rounded font-label-meta text-[10px] uppercase font-bold
                                        {{ $progress->bmi_category === 'Normal' ? 'bg-primary-hover-subtle text-primary-container border border-primary-container/30' : 
                                           ($progress->bmi_category === 'Underweight' || $progress->bmi_category === 'Overweight' ? 'bg-status-warning-container text-status-warning border border-status-warning/30' : 'bg-status-error-container text-status-error border border-status-error/30') }}">
                                        BMI: {{ $progress->bmi_category }}
                                    </span>
                                @endif
                                
                                <a href="{{ route('member.progress.edit', $progress) }}" 
                                   class="p-2 bg-surface-container hover:bg-surface-container-high border border-border-subtle text-text-primary rounded transition-colors" 
                                   title="Edit Log">
                                    <span class="material-symbols-outlined text-[16px]">edit</span>
                                </a>

                                <form action="{{ route('member.progress.destroy', $progress) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Hapus catatan progress ini?');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 bg-surface-container hover:bg-status-error-container border border-border-subtle hover:border-status-error text-text-muted hover:text-status-error rounded transition-colors" 
                                            title="Hapus Log">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Telemetry Measurements Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 font-label-code">
                            <div class="p-3 bg-surface-container-lowest border border-border-default rounded">
                                <span class="text-text-muted text-[10px] font-label-meta uppercase tracking-wider block">BERAT BADAN</span>
                                <span class="text-text-primary font-bold text-lg">{{ $progress->berat_badan ?? '--' }} <span class="text-xs text-text-muted font-normal">KG</span></span>
                            </div>
                            <div class="p-3 bg-surface-container-lowest border border-border-default rounded">
                                <span class="text-text-muted text-[10px] font-label-meta uppercase tracking-wider block">TINGGI BADAN</span>
                                <span class="text-text-primary font-bold text-lg">{{ $progress->tinggi_badan ?? '--' }} <span class="text-xs text-text-muted font-normal">CM</span></span>
                            </div>
                            <div class="p-3 bg-surface-container-lowest border border-border-default rounded">
                                <span class="text-text-muted text-[10px] font-label-meta uppercase tracking-wider block">BMI VALUE</span>
                                <span class="text-primary-container font-bold text-lg">{{ $progress->bmi ?? '--' }}</span>
                            </div>
                            <div class="p-3 bg-surface-container-lowest border border-border-default rounded">
                                <span class="text-text-muted text-[10px] font-label-meta uppercase tracking-wider block">LINGKAR PERUT</span>
                                <span class="text-text-primary font-bold text-lg">{{ $progress->lingkar_perut ?? '--' }} <span class="text-xs text-text-muted font-normal">CM</span></span>
                            </div>
                            <div class="p-3 bg-surface-container-lowest border border-border-default rounded">
                                <span class="text-text-muted text-[10px] font-label-meta uppercase tracking-wider block">LINGKAR LENGAN</span>
                                <span class="text-text-primary font-bold text-lg">{{ $progress->lingkar_lengan ?? '--' }} <span class="text-xs text-text-muted font-normal">CM</span></span>
                            </div>
                        </div>

                        @if($progress->catatan)
                            <div class="mt-4 p-3 bg-surface-vault border border-border-default rounded font-label-code text-xs text-text-secondary">
                                <span class="text-primary-container font-bold uppercase tracking-wider mr-2">[ CATATAN ]</span>
                                {{ $progress->catatan }}
                            </div>
                        @endif

                        <!-- Before & After Photo Comparison -->
                        @if($progress->foto_before_path || $progress->foto_after_path)
                            <div class="mt-5 pt-4 border-t border-border-default">
                                <div class="font-label-tag text-[10px] text-text-muted tracking-widest uppercase mb-3">
                                    [ VISUAL ADAPTATION ARCHIVE ]
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @if($progress->foto_before_path)
                                        <div class="bg-surface-container-lowest border border-border-default rounded p-2">
                                            <span class="font-label-meta text-[10px] text-text-muted uppercase tracking-wider mb-1 block">BEFORE PHOTO</span>
                                            <img src="{{ Storage::url($progress->foto_before_path) }}" alt="Before" class="w-full h-48 object-cover rounded">
                                        </div>
                                    @endif
                                    @if($progress->foto_after_path)
                                        <div class="bg-surface-container-lowest border border-border-default rounded p-2">
                                            <span class="font-label-meta text-[10px] text-primary-container uppercase tracking-wider mb-1 block">CURRENT / AFTER PHOTO</span>
                                            <img src="{{ Storage::url($progress->foto_after_path) }}" alt="After" class="w-full h-48 object-cover rounded">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $progressRecords->links() }}
            </div>
        @else
            <div class="bg-surface-vault border border-border-default rounded p-12 text-center backdrop-blur-md">
                <span class="material-symbols-outlined text-5xl text-primary-container mb-3">monitoring</span>
                <h3 class="font-headline-sm font-bold text-lg text-text-primary uppercase mb-2">BELUM ADA PROGRESS TERCATAT</h3>
                <p class="font-body-base text-text-secondary text-sm max-w-md mx-auto mb-6">
                    Catat perubahan berat badan, lingkar otot, serta foto perkembangan fisik Anda untuk memantau transformasi tubuh.
                </p>
                <a href="{{ route('member.progress.create') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-label-code text-xs uppercase tracking-wider font-extrabold rounded neon-glow-btn transition-all">
                    <span class="material-symbols-outlined text-base">speed</span>
                    <span>LOG PROGRESS PERTAMA</span>
                </a>
            </div>
        @endif

    </div>
</x-app-layout>
