<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FAF7F2] text-stone-800 scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Grand Senyum Hotel - Senyum Stay Priority')</title>

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
        .luxury-card-border {
            border: 1px solid rgba(212, 175, 55, 0.35);
        }
    </style>
</head>
<body class="h-full flex flex-col font-sans bg-[#FAF7F2] text-stone-800 antialiased selection:bg-amber-500 selection:text-white">

    <!-- Top Luxury Utility / Concierge Bar (Inspired by Mulia Privilege) -->
    <div class="bg-[#1C1408] text-[#EBD195] text-[11px] sm:text-xs py-2 px-4 border-b border-[#3D2C12] tracking-wider z-50">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-1.5">
            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-x-3 gap-y-1">
                <span class="inline-flex items-center space-x-1.5 text-stone-300">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                    <span>Jl. Pangeran Diponegoro No.27, Gowongan, Jetis, Kota Yogyakarta (55232)</span>
                </span>
                <span class="hidden md:inline text-stone-600">|</span>
                <a href="tel:0274566306" class="inline-flex items-center space-x-1 text-stone-300 hover:text-white transition">
                    <i data-lucide="phone" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                    <span>Tel: 0274 566 306</span>
                </a>
            </div>
            <div class="flex flex-wrap items-center justify-center sm:justify-end gap-x-3 gap-y-1">
                <a href="https://wa.me/{{ config('hotel.whatsapp') }}?text={{ urlencode('Hello Concierge Grand Senyum Hotel, I would like to inquire about hotel services and Senyum Stay Priority membership.') }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition flex items-center space-x-1 font-semibold text-[#D4AF37]">
                    <i data-lucide="message-circle" class="w-3.5 h-3.5 text-emerald-400"></i>
                    <span>WA: {{ config('hotel.whatsapp_display') }}</span>
                </a>
                <span class="hidden sm:inline text-stone-600">|</span>
                <a href="mailto:grandsenyum@gmail.com" class="hover:text-white transition flex items-center space-x-1 text-stone-300">
                    <i data-lucide="mail" class="w-3 h-3 text-[#D4AF37]"></i>
                    <span>grandsenyum@gmail.com</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Header Navigation (Luxury Cream & Gold Palette) -->
    <header class="bg-[#FFFDF9]/95 border-b border-[#E8DFC8] sticky top-0 z-40 shadow-sm backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand Logo (Pure Transparent Floating Logo) -->
                <a href="{{ route('guest.points') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('images/logo.png') }}" 
                         alt="Grand Senyum Hotel" 
                         class="h-10 sm:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-sm">
                    <div class="border-l border-[#DECFAe] pl-3">
                        <span class="text-xs sm:text-sm tracking-[0.2em] font-serif font-bold text-[#8A6319] uppercase block">
                            Senyum Stay Priority
                        </span>
                        <span class="text-[9px] uppercase tracking-widest text-stone-700 font-medium hidden sm:block">
                            Grand Senyum Hotel Yogyakarta
                        </span>
                    </div>
                </a>

                <!-- Navigation Menu Links (Mulia Privilege Structure) -->
                <nav class="hidden lg:flex items-center space-x-1 text-xs font-bold uppercase tracking-wider text-stone-700">
                    <a href="{{ route('guest.points') }}#tentang" class="px-3 py-2 rounded-xl hover:text-stone-950 hover:bg-[#F2ECE1] transition">About</a>
                    <a href="{{ route('guest.points') }}#tier" class="px-3 py-2 rounded-xl hover:text-stone-950 hover:bg-[#F2ECE1] transition">Membership Tiers</a>
                    <a href="{{ route('guest.points') }}#perolehan" class="px-3 py-2 rounded-xl hover:text-stone-950 hover:bg-[#F2ECE1] transition">Earn Points</a>
                    <a href="{{ route('guest.points') }}#katalog" class="px-3 py-2 rounded-xl hover:text-stone-950 hover:bg-[#F2ECE1] transition">Rewards Catalog</a>
                    <a href="{{ route('guest.points') }}#faq" class="px-3 py-2 rounded-xl hover:text-stone-950 hover:bg-[#F2ECE1] transition">
                        FAQ
                    </a>
                </nav>

                <!-- Navigation Tabs / Action CTAs -->
                <div class="flex items-center space-x-2">
                    <!-- Mobile Menu Trigger -->
                    <button type="button" 
                            onclick="toggleMobileMenu()" 
                            class="lg:hidden p-2 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] text-stone-700 hover:text-stone-950">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Accordion -->
            <div id="mobile-nav-menu" class="hidden lg:hidden py-4 border-t border-[#E8DFC8] space-y-2 text-xs font-bold uppercase tracking-wider">
                <a href="{{ route('guest.points') }}#tentang" onclick="toggleMobileMenu()" class="block px-3 py-2 rounded-xl text-stone-800 hover:bg-[#F2ECE1]">About Priority</a>
                <a href="{{ route('guest.points') }}#tier" onclick="toggleMobileMenu()" class="block px-3 py-2 rounded-xl text-stone-800 hover:bg-[#F2ECE1]">Membership Tiers</a>
                <a href="{{ route('guest.points') }}#perolehan" onclick="toggleMobileMenu()" class="block px-3 py-2 rounded-xl text-stone-800 hover:bg-[#F2ECE1]">How to Earn Points</a>
                <a href="{{ route('guest.points') }}#katalog" onclick="toggleMobileMenu()" class="block px-3 py-2 rounded-xl text-stone-800 hover:bg-[#F2ECE1]">Rewards Catalog</a>
                <a href="{{ route('guest.points') }}#faq" onclick="toggleMobileMenu()" class="block px-3 py-2 rounded-xl text-stone-800 hover:bg-[#F2ECE1]">FAQ</a>
                <a href="{{ route('guest.points') }}#cek-poin" onclick="toggleMobileMenu()" class="block px-3 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 text-center font-bold">Check Points Now</a>
            </div>
        </div>
    </header>

    <!-- Main Content Area (Warm Cream-to-Gold Luxury Background) -->
    <main class="flex-1 pb-20 bg-gradient-to-b from-[#FAF7F2] via-[#F7F2E8] to-[#F1EAD9]">
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

    <!-- Footer (Warm Cream & Soft Gold Tone - Mulia Privilege Style Elegance) -->
    <footer class="bg-[#1C1408] border-t border-[#3D2C12] text-[#EFE8D8] py-14 text-xs sm:text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pb-10 border-b border-[#3D2C12]">
                
                <!-- Col 1: Brand & Philosophy -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Grand Senyum Hotel" class="h-11 w-auto object-contain brightness-110">
                        <div>
                            <p class="font-serif font-black text-lg text-white">GRAND SENYUM HOTEL</p>
                            <span class="text-xs text-[#D4AF37] font-serif tracking-widest uppercase block font-semibold">Senyum Stay Priority</span>
                        </div>
                    </div>
                    <p class="text-xs text-stone-300 max-w-md leading-relaxed">
                        The prestigious loyalty program of Grand Senyum Hotel Yogyakarta. Specially designed to express our highest appreciation to distinguished guests through stay points, banquet revenue rewards, and unmatched VIP privileges.
                    </p>
                    <div class="flex items-center space-x-3 pt-2">
                        <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-[11px] text-[#EBD195]">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                            <span>Bespoke Hospitality Yogyakarta</span>
                        </span>
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div class="space-y-3">
                    <h4 class="font-serif font-bold text-white text-sm uppercase tracking-wider text-[#D4AF37]">Program Navigation</h4>
                    <ul class="space-y-2 text-xs text-stone-300">
                        <li><a href="{{ route('guest.points') }}#tentang" class="hover:text-[#D4AF37] transition">About Senyum Stay Priority</a></li>
                        <li><a href="{{ route('guest.points') }}#tier" class="hover:text-[#D4AF37] transition">Membership Tiers</a></li>
                        <li><a href="{{ route('guest.points') }}#perolehan" class="hover:text-[#D4AF37] transition">Room & Banquet Earning</a></li>
                        <li><a href="{{ route('guest.points') }}#katalog" class="hover:text-[#D4AF37] transition">Rewards & Voucher Catalog</a></li>
                        <li><a href="{{ route('guest.points') }}#faq" class="hover:text-[#D4AF37] transition">Frequently Asked Questions (FAQ)</a></li>
                    </ul>
                </div>

                <!-- Col 3: Concierge & Kontak -->
                <div class="space-y-3">
                    <h4 class="font-serif font-bold text-white text-sm uppercase tracking-wider text-[#D4AF37]">Official Contact & Address</h4>
                    <div class="space-y-2.5 text-xs text-stone-300">
                        <p class="flex items-start space-x-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-[#D4AF37] shrink-0 mt-0.5"></i>
                            <span>Jalan Pangeran Diponegoro No.27, Gowongan, Kecamatan Jetis, Kota Yogyakarta, Daerah Istimewa Yogyakarta ( 55232 )</span>
                        </p>
                        <p class="flex items-center space-x-2">
                            <i data-lucide="phone" class="w-4 h-4 text-[#D4AF37] shrink-0"></i>
                            <span>Tel: <a href="tel:0274566306" class="hover:text-[#D4AF37] transition font-medium">0274 566 306</a></span>
                        </p>
                        <p class="flex items-center space-x-2">
                            <i data-lucide="message-circle" class="w-4 h-4 text-[#D4AF37] shrink-0"></i>
                            <span>Whatsapp: <a href="https://wa.me/{{ config('hotel.whatsapp') }}" target="_blank" class="hover:text-[#D4AF37] transition font-medium">{{ config('hotel.whatsapp_display') }}</a></span>
                        </p>
                        <p class="flex items-center space-x-2">
                            <i data-lucide="mail" class="w-4 h-4 text-[#D4AF37] shrink-0"></i>
                            <span>Email: <a href="mailto:grandsenyum@gmail.com" class="hover:text-[#D4AF37] transition font-medium">grandsenyum@gmail.com</a></span>
                        </p>
                    </div>
                </div>

            </div>

            <!-- Footer Bottom -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-stone-400">
                <p>
                    &copy; {{ date('Y') }} GRAND SENYUM HOTEL YOGYAKARTA. ALL RIGHTS RESERVED. &bull; 
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#D4AF37] transition font-semibold">Admin Staff Portal</a>
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3 text-xs font-semibold">
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-stone-300">
                        <span class="w-2 h-2 rounded-full bg-slate-400 mr-2"></span> Silver (Max 1,000 pts)
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-amber-500/30 text-amber-300">
                        <span class="w-2 h-2 rounded-full bg-[#D4AF37] mr-2"></span> Gold (Max 5,000 pts)
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-indigo-500/30 text-indigo-300">
                        <span class="w-2 h-2 rounded-full bg-indigo-400 mr-2"></span> Platinum (Max 10,000 pts)
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Initialize Lucide Icons & Scripts -->
    <script>
        lucide.createIcons();

        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-nav-menu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
