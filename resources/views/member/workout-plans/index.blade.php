<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-500">
                    🏋️ Workout Plans
                </h1>
                <p class="text-gray-400 mt-2">Program latihan terstruktur untuk mencapai tujuan fitness Anda</p>
            </div>

            <!-- Filters -->
            <form method="GET" class="bg-gray-800 rounded-2xl p-6 mb-8 border border-gray-700">
                <div class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-gray-400 text-sm mb-2">Kategori</label>
                        <select name="kategori" onchange="this.form.submit()"
                                class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                       focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                                    {{ ucfirst($category) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-gray-400 text-sm mb-2">Level</label>
                        <select name="level" onchange="this.form.submit()"
                                class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                       focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
                            <option value="">Semua Level</option>
                            @foreach($levels as $level)
                                <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>
                                    {{ ucfirst($level) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if(request('kategori') || request('level'))
                        <div class="flex items-end">
                            <a href="{{ route('member.workout-plans') }}" 
                               class="px-6 py-3 bg-gray-600 hover:bg-gray-500 rounded-xl text-white transition-all">
                                Reset
                            </a>
                        </div>
                    @endif
                </div>
            </form>

            <!-- Workout Plans Grid -->
            @if($workoutPlans->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($workoutPlans as $plan)
                        <div class="bg-gray-800 rounded-2xl overflow-hidden border border-gray-700 hover:border-cyan-500 
                                    transition-all hover:scale-[1.02] group">
                            <!-- Media Preview -->
                            <div class="aspect-video bg-gray-700 relative overflow-hidden">
                                @if($plan->media_url_full)
                                    @if(str_contains($plan->media_url_full, 'youtube'))
                                        <div class="absolute inset-0 flex items-center justify-center bg-gray-900">
                                            <span class="text-6xl">▶️</span>
                                        </div>
                                    @else
                                        <img src="{{ $plan->media_url_full }}" alt="{{ $plan->judul }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @endif
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-6xl">🏋️</span>
                                    </div>
                                @endif

                                <!-- Badges -->
                                <div class="absolute top-4 left-4 flex gap-2">
                                    <span class="px-3 py-1 rounded-lg text-xs font-bold
                                        {{ $plan->level === 'beginner' ? 'bg-green-600' : 
                                           ($plan->level === 'intermediate' ? 'bg-yellow-600' : 'bg-red-600') }} text-white">
                                        {{ ucfirst($plan->level) }}
                                    </span>
                                    <span class="px-3 py-1 rounded-lg text-xs font-bold bg-gray-900/80 text-cyan-400">
                                        {{ ucfirst($plan->kategori) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-cyan-400 transition-colors">
                                    {{ $plan->judul }}
                                </h3>
                                <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                                    {{ Str::limit($plan->deskripsi, 100) }}
                                </p>

                                <!-- Meta Info -->
                                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                                    @if($plan->durasi_menit)
                                        <span class="flex items-center gap-1">
                                            ⏱️ {{ $plan->durasi_menit }} menit
                                        </span>
                                    @endif
                                    @if($plan->kalori_estimasi)
                                        <span class="flex items-center gap-1">
                                            🔥 {{ $plan->kalori_estimasi }} kcal
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ route('member.workout-plans.show', $plan) }}" 
                                   class="inline-flex items-center text-cyan-400 hover:text-cyan-300 font-semibold">
                                    Lihat Detail →
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
                <div class="bg-gray-800 rounded-2xl p-12 text-center border border-gray-700">
                    <div class="text-6xl mb-4">🏋️</div>
                    <h3 class="text-xl font-bold text-white mb-2">Tidak Ada Program Latihan</h3>
                    <p class="text-gray-400">Belum ada workout plan yang tersedia untuk filter yang dipilih</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
