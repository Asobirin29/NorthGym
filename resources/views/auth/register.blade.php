<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - North Gym</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-r from-cyan-500 to-purple-500 flex items-center justify-center mb-4">
                <span class="text-white font-bold text-4xl">N</span>
            </div>
            <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-500">
                North Gym
            </h1>
            <p class="text-gray-400 mt-2">Mulai Perjalanan Fitness Anda Hari Ini</p>
        </div>

        <!-- Register Form -->
        <div class="bg-gray-800/80 backdrop-blur-lg rounded-2xl p-8 border border-gray-700 shadow-2xl">
            <h2 class="text-2xl font-bold text-white mb-6 text-center">Buat Akun Baru 🚀</h2>

            @if($errors->any())
                <div class="bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded-xl mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-gray-400 text-sm mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                           placeholder="John Doe">
                </div>

                <div>
                    <label class="block text-gray-400 text-sm mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                           placeholder="email@example.com">
                </div>

                <div>
                    <label class="block text-gray-400 text-sm mb-2">No. Telepon (Opsional)</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}"
                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                           placeholder="08123456789">
                </div>

                <div>
                    <label class="block text-gray-400 text-sm mb-2">Kata Sandi</label>
                    <input type="password" name="password" required
                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                           placeholder="Minimal 8 karakter">
                </div>

                <div>
                    <label class="block text-gray-400 text-sm mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 text-white 
                                  focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all"
                           placeholder="Ulangi password">
                </div>

                <button type="submit" 
                        class="w-full bg-gradient-to-r from-cyan-500 to-purple-500 text-white py-4 rounded-xl 
                               font-bold text-lg hover:opacity-90 transition-all hover:scale-[1.02] shadow-lg">
                    Daftar Sekarang
                </button>
            </form>

            <p class="text-center text-gray-400 mt-6">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 font-medium">
                    Masuk
                </a>
            </p>
        </div>

        <!-- Footer -->
        <p class="text-center text-gray-500 text-sm mt-8">
            &copy; {{ date('Y') }} North Gym. Hak cipta dilindungi.
        </p>
    </div>
</body>
</html>
