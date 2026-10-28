<!DOCTYPE html>
<html lang="id" class="h-full bg-[#f3eee7] text-stone-800">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Administrator & Front Desk - Grand Senyum Hotel</title>

    <!-- Google Fonts: Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Montserrat"', 'sans-serif'],
                        montserrat: ['"Montserrat"', 'sans-serif'],
                        serif: ['"Montserrat"', 'sans-serif'],
                    },
                    colors: {
                        gold: {
                            500: '#d6ac57',
                            600: '#B8860B',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body class="min-h-full flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 bg-[#f3eee7] text-stone-800 antialiased selection:bg-amber-500 selection:text-white">

    <div class="w-full max-w-md space-y-8">
        
        <!-- Header & Logo -->
        <div class="text-center space-y-3">
            <a href="{{ route('guest.points') }}" class="inline-block group">
                <img src="{{ asset('images/logo.png') }}" 
                     alt="Grand Senyum Hotel" 
                     class="h-14 sm:h-16 w-auto mx-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-sm">
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-serif font-extrabold text-stone-900 tracking-tight">
                    Portal Masuk Administrator
                </h1>
                <p class="text-xs text-stone-600 mt-1 uppercase tracking-widest font-semibold">
                    Grand Senyum Hotel Yogyakarta
                </p>
            </div>
            <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-[#FAF3E2] text-[#8A6319] border border-[#DEC8A4]">
                <i data-lucide="shield-check" class="w-3.5 h-3.5 text-[#d6ac57]"></i>
                <span>Akses Khusus Staf & Front Desk</span>
            </div>
        </div>

        <!-- Flash Alert Messages -->
        @if(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 flex items-start space-x-3 text-xs shadow-sm">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5"></i>
                <div class="flex-1 font-medium">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-start space-x-3 text-xs shadow-sm">
                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                <div class="flex-1 font-medium">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Login Card -->
        <div class="bg-[#FFFDF9] rounded-3xl border border-[#E6DAC3] p-8 sm:p-9 shadow-lg shadow-stone-300/40 space-y-6">
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Login Input (Email or Username) -->
                <div>
                    <label for="login" class="block text-xs font-bold text-stone-800 uppercase tracking-wider mb-2">
                        Email atau Username Staf
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="login" 
                               name="login" 
                               value="{{ old('login', 'admin@grandsenyum.com') }}" 
                               required 
                               autofocus
                               placeholder="Contoh: admin@grandsenyum.com" 
                               class="w-full pl-11 pr-4 py-3 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] text-stone-900 text-sm outline-none transition font-medium">
                        <i data-lucide="user" class="w-4 h-4 text-[#8A6319] absolute left-3.5 top-3.5"></i>
                    </div>
                    @error('login')
                        <p class="text-xs text-rose-600 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-bold text-stone-800 uppercase tracking-wider">
                            Kata Sandi
                        </label>
                    </div>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               value="admin123"
                               required 
                               placeholder="Masukkan kata sandi..." 
                               class="w-full pl-11 pr-4 py-3 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] text-stone-900 text-sm outline-none transition font-medium">
                        <i data-lucide="lock" class="w-4 h-4 text-[#8A6319] absolute left-3.5 top-3.5"></i>
                    </div>
                    @error('password')
                        <p class="text-xs text-rose-600 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center space-x-2 text-stone-700 cursor-pointer">
                        <input type="checkbox" name="remember" value="1" checked class="w-4 h-4 text-[#B8860B] rounded border-[#DEC8A4] focus:ring-[#C89B3C]">
                        <span>Ingat sesi di perangkat ini</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#d6ac57] to-[#B8860B] hover:brightness-105 active:scale-[0.99] text-stone-950 font-bold text-sm tracking-wider uppercase shadow-md shadow-[#d6ac57]/30 transition-all flex items-center justify-center space-x-2">
                    <i data-lucide="log-in" class="w-4 h-4 text-stone-950"></i>
                    <span>Masuk ke Dashboard Admin</span>
                </button>
            </form>

            <!-- Credential Helper for Staf / Front Desk -->
            <div class="pt-4 border-t border-[#EFE7DA] text-center">
                <div class="p-3.5 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] text-left text-xs space-y-1.5">
                    <div class="flex items-center space-x-1.5 text-[#8A6319] font-bold text-[11px] uppercase tracking-wider">
                        <i data-lucide="info" class="w-3.5 h-3.5"></i>
                        <span>Akun Default Staf Front Desk:</span>
                    </div>
                    <p class="text-stone-700 text-[11px]">
                        Email: <code class="font-mono font-bold text-stone-900 bg-white px-1.5 py-0.5 rounded border border-[#E6DAC3]">admin@grandsenyum.com</code> atau <code class="font-mono font-bold text-stone-900 bg-white px-1.5 py-0.5 rounded border border-[#E6DAC3]">admin</code>
                    </p>
                    <p class="text-stone-700 text-[11px]">
                        Password: <code class="font-mono font-bold text-stone-900 bg-white px-1.5 py-0.5 rounded border border-[#E6DAC3]">admin123</code>
                    </p>
                </div>
            </div>
        </div>

        <!-- Back to Customer Portal -->
        <div class="text-center">
            <a href="{{ route('guest.points') }}" class="inline-flex items-center space-x-1.5 text-xs text-stone-600 hover:text-stone-900 font-semibold transition">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Portal Tamu (Cek Poin Tamu)</span>
            </a>
        </div>

    </div>

    <!-- Init Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
