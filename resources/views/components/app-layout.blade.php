<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'North Gym' }} - North Gym</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        neon: {
                            cyan: '#00f5ff',
                            purple: '#bf00ff',
                            pink: '#ff00ff',
                            green: '#39ff14',
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        glow: {
                            'from': { boxShadow: '0 0 20px #00f5ff, 0 0 30px #00f5ff, 0 0 40px #00f5ff' },
                            'to': { boxShadow: '0 0 30px #bf00ff, 0 0 40px #bf00ff, 0 0 50px #bf00ff' }
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .neon-text {
            text-shadow: 0 0 10px currentColor, 0 0 20px currentColor, 0 0 30px currentColor;
        }
        
        .neon-border {
            box-shadow: 0 0 10px rgba(0, 245, 255, 0.5), inset 0 0 10px rgba(0, 245, 255, 0.1);
        }
        
        .neon-glow {
            box-shadow: 0 0 20px rgba(0, 245, 255, 0.3), 0 0 40px rgba(191, 0, 255, 0.2);
        }
        
        .glass {
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .gradient-neon {
            background: linear-gradient(135deg, #00f5ff 0%, #bf00ff 50%, #ff00ff 100%);
        }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('member.dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full gradient-neon flex items-center justify-center">
                        <span class="text-white font-bold text-xl">N</span>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent">
                        North Gym
                    </span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('member.dashboard') }}" 
                       class="px-4 py-2 rounded-lg transition-all hover:bg-gray-800 {{ request()->routeIs('member.dashboard') ? 'text-cyan-400' : 'text-gray-300' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('member.workout-plans') }}" 
                       class="px-4 py-2 rounded-lg transition-all hover:bg-gray-800 {{ request()->routeIs('member.workout-plans*') ? 'text-cyan-400' : 'text-gray-300' }}">
                        Program Latihan
                    </a>
                    <a href="{{ route('member.progress.index') }}" 
                       class="px-4 py-2 rounded-lg transition-all hover:bg-gray-800 {{ request()->routeIs('member.progress*') ? 'text-cyan-400' : 'text-gray-300' }}">
                        Progres
                    </a>
                    <a href="{{ route('member.transactions') }}" 
                       class="px-4 py-2 rounded-lg transition-all hover:bg-gray-800 {{ request()->routeIs('member.transactions') ? 'text-cyan-400' : 'text-gray-300' }}">
                        Transaksi
                    </a>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <span class="text-gray-400 hidden sm:block">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition-all text-sm font-medium">
                            Keluar
                        </button>
                    </form>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-800 pb-4">
            <div class="px-4 pt-4 space-y-2">
                <a href="{{ route('member.dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-800 text-gray-300">Dashboard</a>
                <a href="{{ route('member.workout-plans') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-800 text-gray-300">Program Latihan</a>
                <a href="{{ route('member.progress.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-800 text-gray-300">Progres</a>
                <a href="{{ route('member.transactions') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-800 text-gray-300">Transaksi</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 pb-8">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
                <div class="bg-green-900/50 border border-green-500 text-green-300 px-6 py-4 rounded-xl">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
                <div class="bg-red-900/50 border border-red-500 text-red-300 px-6 py-4 rounded-xl">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-800 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500">
            <p>&copy; {{ date('Y') }} North Gym. Hak cipta dilindungi.</p>
            <p class="mt-2 text-sm">Ubah Tubuh Anda, Ubah Hidup Anda 💪</p>
        </div>
    </footer>

    <!-- Page-specific scripts -->
    @stack('scripts')
</body>
</html>
