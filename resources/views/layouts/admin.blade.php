<!DOCTYPE html>
<html lang="id" class="h-full bg-[#f3eee7] text-stone-800 scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Senyum Stay Priority | Grand Senyum Hotel')</title>

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
                        cream: {
                            50: '#FDFBF7',
                            100: '#FAF7F2',
                            200: '#F5EFE6',
                            300: '#EFE7DA',
                            400: '#E5DAC6',
                            500: '#D5C4A7',
                            600: '#BFA885',
                        },
                        gold: {
                            50: '#FDFCF7',
                            100: '#FAF3E3',
                            200: '#F4E5BF',
                            300: '#EBD195',
                            400: '#E0BC6B',
                            500: '#d6ac57',
                            600: '#B8860B',
                            700: '#94671C',
                            800: '#754F1A',
                            900: '#5C3D16',
                            950: '#2A1A06',
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
        [x-cloak] { display: none !important; }
        .gold-shimmer {
            background: linear-gradient(90deg, #d6ac57 0%, #FFF3D1 50%, #b38a36 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="h-full flex flex-col font-sans bg-[#f3eee7] text-stone-800 antialiased selection:bg-amber-500 selection:text-white">

    <!-- Top Admin Bar (Internal System Notice) -->
    <div class="bg-[#1C1408] text-[#EBD195] text-[11px] py-1.5 px-4 border-b border-[#3D2C12] tracking-wider z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-2.5">
                <span class="inline-flex items-center space-x-1.5 text-amber-300 font-semibold uppercase text-[10px] tracking-widest bg-amber-950/80 px-2 py-0.5 rounded border border-amber-800/60">
                    <i data-lucide="shield-check" class="w-3 h-3 text-[#d6ac57]"></i>
                    <span>Internal Staff Portal</span>
                </span>
                <span class="hidden sm:inline text-stone-500">|</span>
                <span class="hidden sm:inline text-stone-300 text-xs">
                    Grand Senyum Hotel &bull; Loyalty & Guest Revenue Control
                </span>
            </div>

            <div class="flex items-center space-x-4 text-xs">
                <span class="text-stone-300 flex items-center space-x-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="font-medium text-[11px]">{{ auth()->user()->name ?? 'Front Desk Admin' }}</span>
                </span>
                <span class="text-stone-600">|</span>
                <a href="{{ route('guest.points') }}" target="_blank" class="hover:text-white transition flex items-center space-x-1 text-[#d6ac57] text-[11px] font-semibold">
                    <span>Lihat Portal Tamu</span>
                    <i data-lucide="external-link" class="w-3 h-3"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Admin Header Navigation -->
    <header class="bg-[#FFFDF9]/95 border-b border-[#DEC8A4] sticky top-0 z-40 shadow-sm backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand Logo & Admin Identifier -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('images/logo.png') }}" 
                         alt="Grand Senyum Hotel" 
                         class="h-10 sm:h-11 w-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-sm">
                    <div class="border-l border-[#DECFAe] pl-3">
                        <span class="text-xs sm:text-sm tracking-[0.2em] font-serif font-bold text-[#8A6319] uppercase block">
                            Senyum Stay Priority
                        </span>
                        <div class="flex items-center space-x-1.5 mt-0.5">
                            <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-wider bg-[#241A0B] text-[#d6ac57] border border-[#d6ac57]/40">
                                Admin Dashboard
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Admin Action Controls -->
                <div class="flex items-center space-x-3">
                    <div class="hidden md:flex items-center space-x-2 text-xs font-semibold text-stone-600">
                        <span class="px-3 py-1.5 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] text-stone-800 flex items-center space-x-1.5">
                            <i data-lucide="user-check" class="w-3.5 h-3.5 text-[#8A6319]"></i>
                            <span>{{ auth()->user()->email ?? 'admin@grandsenyum.com' }}</span>
                        </span>
                    </div>

                    <!-- Logout Button -->
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari panel admin?');">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 shadow-sm transition">
                            <i data-lucide="log-out" class="w-3.5 h-3.5 mr-1.5 text-rose-600"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area with #f3eee7 Background -->
    <main class="flex-1 pb-20 bg-[#f3eee7]">
        <!-- Flash Notifications -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 shadow-sm flex items-start space-x-3 text-emerald-900">
                    <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600">
                        <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    </div>
                    <div class="flex-1 text-sm pt-1">
                        <p class="font-bold">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 shadow-sm flex items-start space-x-3 text-rose-900">
                    <div class="w-8 h-8 rounded-xl bg-rose-100 flex items-center justify-center shrink-0 text-rose-600">
                        <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                    </div>
                    <div class="flex-1 text-sm pt-1">
                        <p class="font-bold">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Clean Focused Admin Footer -->
    <footer class="bg-[#1C1408] border-t border-[#3D2C12] text-[#EFE8D8] py-8 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
            <div class="flex items-center space-x-2">
                <i data-lucide="shield" class="w-4 h-4 text-[#d6ac57]"></i>
                <span class="font-semibold text-stone-200">Grand Senyum Hotel Yogyakarta</span>
                <span class="text-stone-500">&bull;</span>
                <span class="text-stone-400">Sistem Manajemen Loyalitas & Poin Tamu</span>
            </div>
            <p class="text-stone-500 text-[11px]">
                Hak Cipta &copy; {{ date('Y') }} Grand Senyum Hotel. Akses terbatas khusus staf terdaftar.
            </p>
        </div>
    </footer>

    <!-- Init Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>

    @stack('scripts')
</body>
</html>
