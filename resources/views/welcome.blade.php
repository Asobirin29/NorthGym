<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>North Gym - Transform Your Body, Transform Your Life</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        .gradient-blur {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-900 text-white overflow-x-hidden">
    <!-- Background Effects -->
    <div class="gradient-blur bg-cyan-500 top-0 left-0"></div>
    <div class="gradient-blur bg-purple-500 bottom-0 right-0"></div>

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gray-900/80 backdrop-blur-lg border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-purple-500 flex items-center justify-center">
                        <span class="text-white font-bold text-xl">N</span>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent">
                        North Gym
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="px-6 py-2 rounded-lg border border-gray-600 hover:border-cyan-500 transition-all">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-purple-500 hover:opacity-90 transition-all font-medium">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-float">
                <span class="text-8xl md:text-9xl">🏋️</span>
            </div>
            
            <h1 class="mt-8 text-5xl md:text-7xl font-black">
                <span class="bg-gradient-to-r from-cyan-400 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                    Transform Your Body
                </span>
            </h1>
            <h2 class="mt-4 text-4xl md:text-5xl font-bold text-white">
                Transform Your Life
            </h2>
            
            <p class="mt-6 text-xl text-gray-400 max-w-2xl mx-auto">
                Platform membership gym modern dengan program latihan terstruktur, 
                tracking progress, dan pembayaran mudah via transfer.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" 
                   class="px-8 py-4 text-lg font-bold rounded-xl bg-gradient-to-r from-cyan-500 to-purple-500 
                          hover:opacity-90 transition-all hover:scale-105 shadow-2xl shadow-cyan-500/25">
                    🚀 Mulai Sekarang
                </a>
                <a href="{{ route('login') }}" 
                   class="px-8 py-4 text-lg font-bold rounded-xl border-2 border-gray-600 
                          hover:border-cyan-500 transition-all">
                    Sudah Punya Akun?
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-16">
                Kenapa Pilih <span class="text-cyan-400">North Gym</span>?
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-800/50 backdrop-blur-lg rounded-2xl p-8 border border-gray-700 hover:border-cyan-500 transition-all hover:scale-105">
                    <div class="text-5xl mb-6">🏋️</div>
                    <h3 class="text-2xl font-bold text-white mb-4">Workout Plans</h3>
                    <p class="text-gray-400">
                        Program latihan terstruktur dari level pemula hingga advanced, 
                        dilengkapi video panduan dan estimasi kalori.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray-800/50 backdrop-blur-lg rounded-2xl p-8 border border-gray-700 hover:border-purple-500 transition-all hover:scale-105">
                    <div class="text-5xl mb-6">📊</div>
                    <h3 class="text-2xl font-bold text-white mb-4">Progress Tracking</h3>
                    <p class="text-gray-400">
                        Catat perkembangan berat badan, BMI, dan ukuran tubuh. 
                        Lihat perubahan Anda dari waktu ke waktu.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray-800/50 backdrop-blur-lg rounded-2xl p-8 border border-gray-700 hover:border-pink-500 transition-all hover:scale-105">
                    <div class="text-5xl mb-6">💳</div>
                    <h3 class="text-2xl font-bold text-white mb-4">Pembayaran Mudah</h3>
                    <p class="text-gray-400">
                        Sistem pembayaran via transfer bank yang mudah. 
                        Pilih paket 1, 3, 6, atau 12 bulan dengan diskon menarik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-24 bg-gray-800/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-4">
                Pilih Paket <span class="text-purple-400">Membership</span>
            </h2>
            <p class="text-gray-400 text-center mb-16">Investasi terbaik untuk kesehatan Anda</p>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- 1 Month -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 hover:border-cyan-500 transition-all">
                    <h3 class="text-xl font-bold text-white mb-2">1 Bulan</h3>
                    <p class="text-4xl font-bold text-cyan-400 mb-4">Rp 300K</p>
                    <p class="text-gray-400 text-sm">Rp 300.000 / bulan</p>
                </div>

                <!-- 3 Months -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 hover:border-cyan-500 transition-all relative">
                    <span class="absolute -top-3 right-4 bg-cyan-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        HEMAT 11%
                    </span>
                    <h3 class="text-xl font-bold text-white mb-2">3 Bulan</h3>
                    <p class="text-4xl font-bold text-cyan-400 mb-4">Rp 800K</p>
                    <p class="text-gray-400 text-sm">Rp 266.667 / bulan</p>
                </div>

                <!-- 6 Months -->
                <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 hover:border-purple-500 transition-all relative">
                    <span class="absolute -top-3 right-4 bg-purple-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        HEMAT 17%
                    </span>
                    <h3 class="text-xl font-bold text-white mb-2">6 Bulan</h3>
                    <p class="text-4xl font-bold text-purple-400 mb-4">Rp 1.5JT</p>
                    <p class="text-gray-400 text-sm">Rp 250.000 / bulan</p>
                </div>

                <!-- 12 Months -->
                <div class="bg-gradient-to-br from-cyan-600 to-purple-600 rounded-2xl p-6 border-2 border-cyan-400 transition-all relative transform scale-105">
                    <span class="absolute -top-3 right-4 bg-yellow-400 text-gray-900 text-xs font-bold px-3 py-1 rounded-full">
                        BEST VALUE
                    </span>
                    <h3 class="text-xl font-bold text-white mb-2">12 Bulan</h3>
                    <p class="text-4xl font-bold text-white mb-4">Rp 2.8JT</p>
                    <p class="text-cyan-200 text-sm">Rp 233.333 / bulan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Siap Untuk <span class="text-cyan-400">Berubah</span>?
            </h2>
            <p class="text-xl text-gray-400 mb-10">
                Ribuan member sudah merasakan perubahan positif. Giliran Anda sekarang!
            </p>
            <a href="{{ route('register') }}" 
               class="inline-block px-10 py-5 text-xl font-bold rounded-xl bg-gradient-to-r from-cyan-500 to-purple-500 
                      hover:opacity-90 transition-all hover:scale-105 shadow-2xl shadow-purple-500/25">
                💪 Daftar Gratis Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-purple-500 flex items-center justify-center">
                        <span class="text-white font-bold text-xl">N</span>
                    </div>
                    <span class="text-xl font-bold text-white">North Gym</span>
                </div>
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} North Gym. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
