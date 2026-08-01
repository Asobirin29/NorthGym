<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-500">
                        📊 Progress Fitness
                    </h1>
                    <p class="text-gray-400 mt-2">Lihat perkembangan tubuh Anda</p>
                </div>
                <a href="{{ route('member.progress.create') }}" 
                   class="bg-gradient-to-r from-cyan-500 to-purple-500 text-white px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all">
                    + Input Progress
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-900/50 border border-green-700 text-green-400 px-6 py-4 rounded-xl">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- Progress List -->
            @if($progressRecords->count() > 0)
                <div class="space-y-4">
                    @foreach($progressRecords as $progress)
                        <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 hover:border-gray-600 transition-all">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold text-white">
                                    📅 {{ $progress->tanggal->format('d M Y') }}
                                </h3>
                                <div class="flex items-center gap-2">
                                    @if($progress->bmi_category)
                                        <span class="px-4 py-2 rounded-xl text-sm font-medium
                                            {{ $progress->bmi_category === 'Normal' ? 'bg-green-900/50 text-green-400' : 
                                               ($progress->bmi_category === 'Underweight' || $progress->bmi_category === 'Overweight' ? 'bg-yellow-900/50 text-yellow-400' : 'bg-red-900/50 text-red-400') }}">
                                            {{ $progress->bmi_category }}
                                        </span>
                                    @endif
                                    <a href="{{ route('member.progress.edit', $progress) }}" 
                                       class="p-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors" 
                                       title="Edit">
                                        ✏️
                                    </a>
                                    <form action="{{ route('member.progress.destroy', $progress) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus progress ini?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 bg-red-600 hover:bg-red-700 rounded-lg transition-colors" 
                                                title="Hapus">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @if($progress->workout_type_name)
                                <div class="mb-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-900/50 text-purple-400 border border-purple-700">
                                        🏋️ {{ $progress->workout_type_name }}
                                    </span>
                                </div>
                            @endif

                            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                                <div class="bg-gray-700 rounded-xl p-4">
                                    <p class="text-gray-400 text-sm">Berat</p>
                                    <p class="text-xl font-bold text-white">{{ $progress->berat_badan ?? '-' }} kg</p>
                                </div>
                                <div class="bg-gray-700 rounded-xl p-4">
                                    <p class="text-gray-400 text-sm">Tinggi</p>
                                    <p class="text-xl font-bold text-white">{{ $progress->tinggi_badan ?? '-' }} cm</p>
                                </div>
                                <div class="bg-gray-700 rounded-xl p-4">
                                    <p class="text-gray-400 text-sm">BMI</p>
                                    <p class="text-xl font-bold text-cyan-400">{{ $progress->bmi ?? '-' }}</p>
                                </div>
                                <div class="bg-gray-700 rounded-xl p-4">
                                    <p class="text-gray-400 text-sm">L. Perut</p>
                                    <p class="text-xl font-bold text-white">{{ $progress->lingkar_perut ?? '-' }} cm</p>
                                </div>
                                <div class="bg-gray-700 rounded-xl p-4">
                                    <p class="text-gray-400 text-sm">L. Lengan</p>
                                    <p class="text-xl font-bold text-white">{{ $progress->lingkar_lengan ?? '-' }} cm</p>
                                </div>
                            </div>

                            @if($progress->catatan)
                                <div class="mt-4 text-gray-400">
                                    <strong>Catatan:</strong> {{ $progress->catatan }}
                                </div>
                            @endif

                            @if($progress->foto_before_path || $progress->foto_after_path)
                                <div class="flex gap-4 mt-4">
                                    @if($progress->foto_before_path)
                                        <div class="relative group">
                                            <img src="{{ Storage::url($progress->foto_before_path) }}" 
                                                 alt="Before" class="w-32 h-32 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity">
                                            <div class="absolute bottom-2 left-2 bg-black/70 px-2 py-1 rounded text-xs text-white">Before</div>
                                        </div>
                                    @endif
                                    @if($progress->foto_after_path)
                                        <div class="relative group">
                                            <img src="{{ Storage::url($progress->foto_after_path) }}" 
                                                 alt="After" class="w-32 h-32 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity">
                                            <div class="absolute bottom-2 left-2 bg-black/70 px-2 py-1 rounded text-xs text-white">After</div>
                                        </div>
                                    @endif
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
                <div class="bg-gray-800 rounded-2xl p-12 text-center border border-gray-700">
                    <div class="text-6xl mb-4">📊</div>
                    <h3 class="text-xl font-bold text-white mb-2">Belum Ada Data Progress</h3>
                    <p class="text-gray-400 mb-6">Mulai catat perkembangan fisik Anda</p>
                    <a href="{{ route('member.progress.create') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-cyan-500 to-purple-500 text-white px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all">
                        + Input Progress Pertama
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
