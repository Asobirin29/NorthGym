<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Back Button -->
            <a href="{{ route('member.workout-plans') }}" 
               class="inline-flex items-center text-gray-400 hover:text-white mb-6 transition-all">
                ← Kembali ke Workout Plans
            </a>

            <!-- Main Card -->
            <div class="bg-gray-800 rounded-2xl overflow-hidden border border-gray-700">
                
                <!-- Media Section -->
                <div class="aspect-video bg-gray-700 relative">
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
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-8xl">🏋️</span>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-8">
                    <!-- Badges -->
                    <div class="flex gap-3 mb-4">
                        <span class="px-4 py-2 rounded-xl text-sm font-bold
                            {{ $workoutPlan->level === 'beginner' ? 'bg-green-900/50 text-green-400' : 
                               ($workoutPlan->level === 'intermediate' ? 'bg-yellow-900/50 text-yellow-400' : 'bg-red-900/50 text-red-400') }}">
                            {{ ucfirst($workoutPlan->level) }}
                        </span>
                        <span class="px-4 py-2 rounded-xl text-sm font-bold bg-cyan-900/50 text-cyan-400">
                            {{ ucfirst($workoutPlan->kategori) }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl font-bold text-white mb-4">{{ $workoutPlan->judul }}</h1>

                    <!-- Meta Info -->
                    <div class="flex items-center gap-6 text-gray-400 mb-6">
                        @if($workoutPlan->durasi_menit)
                            <span class="flex items-center gap-2">
                                <span class="text-2xl">⏱️</span>
                                {{ $workoutPlan->durasi_menit }} menit
                            </span>
                        @endif
                        @if($workoutPlan->kalori_estimasi)
                            <span class="flex items-center gap-2">
                                <span class="text-2xl">🔥</span>
                                {{ $workoutPlan->kalori_estimasi }} kalori
                            </span>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="prose prose-invert max-w-none">
                        <h3 class="text-xl font-bold text-white mb-4">📋 Deskripsi</h3>
                        <div class="text-gray-300 leading-relaxed whitespace-pre-line">
                            {{ $workoutPlan->deskripsi }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Plans -->
            @if($relatedPlans->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-white mb-6">Program Serupa</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($relatedPlans as $related)
                            <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 hover:border-cyan-500 transition-all">
                                <div class="flex gap-4">
                                    <div class="w-20 h-20 bg-gray-700 rounded-xl flex items-center justify-center shrink-0">
                                        <span class="text-3xl">🏋️</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-white mb-1">{{ $related->judul }}</h3>
                                        <p class="text-gray-400 text-sm mb-2">{{ Str::limit($related->deskripsi, 60) }}</p>
                                        <span class="text-xs px-2 py-1 rounded-lg 
                                            {{ $related->level === 'beginner' ? 'bg-green-900/50 text-green-400' : 
                                               ($related->level === 'intermediate' ? 'bg-yellow-900/50 text-yellow-400' : 'bg-red-900/50 text-red-400') }}">
                                            {{ ucfirst($related->level) }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('member.workout-plans.show', $related) }}" 
                                   class="inline-flex items-center text-cyan-400 hover:text-cyan-300 font-semibold mt-4">
                                    Lihat Detail →
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
