<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-500">
                        💪 Body Metrics
                    </h1>
                    <p class="text-gray-400 mt-2">Track your body composition over time</p>
                </div>
                <a href="{{ route('member.body-metrics.create') }}" 
                   class="bg-gradient-to-r from-cyan-500 to-purple-500 text-white px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all">
                    + Input Metrics
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-900/50 border border-green-700 text-green-400 px-6 py-4 rounded-xl">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- Latest Metrics Summary -->
            @if($metrics->count() > 0)
                @php $latest = $metrics->first(); @endphp
               <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <div class="text-gray-400 text-sm mb-1">Weight</div>
                        <div class="text-3xl font-bold text-white">{{ $latest->weight }} <span class="text-lg">kg</span></div>
                        @if($latest->ideal_weight)
                            <div class="text-sm text-gray-500 mt-1">Ideal: {{ $latest->ideal_weight }} kg</div>
                        @endif
                    </div>
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <div class="text-gray-400 text-sm mb-1">BMI</div>
                        <div class="text-3xl font-bold text-cyan-400">{{ $latest->bmi }}</div>
                        <div class="text-sm mt-1">
                            <span class="px-2 py-1 rounded text-xs
                                {{ $latest->bmi_color === 'green' ? 'bg-green-900/50 text-green-400' : 
                                   ($latest->bmi_color === 'yellow' ? 'bg-yellow-900/50 text-yellow-400' : 'bg-red-900/50 text-red-400') }}">
                                {{ $latest->bmi_category }}
                            </span>
                        </div>
                    </div>
                    @if($latest->body_fat_percentage)
                        <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                            <div class="text-gray-400 text-sm mb-1">Body Fat</div>
                            <div class="text-3xl font-bold text-orange-400">{{ $latest->body_fat_percentage }}<span class="text-lg">%</span></div>
                        </div>
                    @endif
                    @if($latest->muscle_mass_percentage)
                        <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                            <div class="text-gray-400 text-sm mb-1">Muscle Mass</div>
                            <div class="text-3xl font-bold text-red-400">{{ $latest->muscle_mass_percentage }}<span class="text-lg">%</span></div>
                            @if($latest->muscle_category)
                                <div class="text-sm text-gray-500 mt-1">{{ $latest->muscle_category }}</div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- History -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                    <h3 class="text-xl font-bold text-white mb-6">📊 History</h3>
                    
                    <div class="space-y-4">
                        @foreach($metrics as $metric)
                            <div class="bg-gray-700 rounded-xl p-4 hover:bg-gray-650 transition-all">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-white font-bold">{{ $metric->recorded_at->format('d M Y') }}</div>
                                    <div class="text-sm text-gray-400">{{ $metric->recorded_at->diffForHumans() }}</div>
                                </div>
                                
                                <div class="grid grid-cols-3 md:grid-cols-6 gap-3 text-center">
                                    <div>
                                        <div class="text-gray-400 text-xs">Weight</div>
                                        <div class="text-white font-bold">{{ $metric->weight }} kg</div>
                                    </div>
                                    <div>
                                        <div class="text-gray-400 text-xs">Height</div>
                                        <div class="text-white font-bold">{{ $metric->height }} cm</div>
                                    </div>
                                    <div>
                                        <div class="text-gray-400 text-xs">BMI</div>
                                        <div class="text-cyan-400 font-bold">{{ $metric->bmi }}</div>
                                    </div>
                                    @if($metric->body_fat_percentage)
                                        <div>
                                            <div class="text-gray-400 text-xs">Body Fat</div>
                                            <div class="text-orange-400 font-bold">{{ $metric->body_fat_percentage }}%</div>
                                        </div>
                                    @endif
                                    @if($metric->muscle_mass_percentage)
                                        <div>
                                            <div class="text-gray-400 text-xs">Muscle</div>
                                            <div class="text-red-400 font-bold">{{ $metric->muscle_mass_percentage }}%</div>
                                        </div>
                                    @endif
                                    @if($metric->water_percentage)
                                        <div>
                                            <div class="text-gray-400 text-xs">Water</div>
                                            <div class="text-blue-400 font-bold">{{ $metric->water_percentage }}%</div>
                                        </div>
                                    @endif
                                </div>

                                @if($metric->notes)
                                    <div class="mt-3 text-gray-400 text-sm">
                                        <strong>Notes:</strong> {{ $metric->notes }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $metrics->links() }}
                    </div>
                </div>
            @else
                <div class="bg-gray-800 rounded-2xl p-12 text-center border border-gray-700">
                    <div class="text-6xl mb-4">💪</div>
                    <h3 class="text-xl font-bold text-white mb-2">No Body Metrics Yet</h3>
                    <p class="text-gray-400 mb-6">Start tracking your body composition today</p>
                    <a href="{{ route('member.body-metrics.create') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-cyan-500 to-purple-500 text-white px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all">
                        + Input First Metric
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
