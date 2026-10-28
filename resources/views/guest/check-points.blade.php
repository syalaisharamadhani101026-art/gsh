@extends('layouts.app')

@section('title', 'Senyum Stay Priority - Grand Senyum Hotel Yogyakarta')

@section('content')
<!-- ======================================================== -->
<!-- DRONE VIDEO CINEMATIC INTRO OVERLAY (BEFORE LOGIN/SEARCH) -->
<!-- ======================================================== -->
<div id="drone-intro-overlay" class="fixed inset-0 z-[100] bg-black hidden flex-col justify-between overflow-hidden transition-opacity duration-700">
    <!-- Video Player Background -->
    <div class="absolute inset-0 w-full h-full overflow-hidden">
        <video id="drone-video-player" 
               autoplay 
               muted 
               loop 
               playsinline 
               preload="auto"
               class="w-full h-full object-cover scale-105 transition-transform duration-1000 ease-out brightness-[0.98] contrast-[1.04] saturate-[1.06]">
            <source src="{{ asset('videos/Grand Senyum Hotel.mp4') }}" type="video/mp4">
            <source src="{{ asset('videos/compro.mp4') }}" type="video/mp4">
            <source src="{{ asset('videos/building.MP4') }}" type="video/mp4">
            <source src="{{ asset('videos/drone.mp4') }}" type="video/mp4">
        </video>

        <!-- Balanced Cinematic Tone: Jernih, Elegan, Tidak Gelap & Tidak Terlalu Terang -->
        <!-- Soft Top Bar Vignette -->
        <div class="absolute inset-x-0 top-0 h-36 bg-gradient-to-b from-black/60 via-black/20 to-transparent pointer-events-none"></div>

        <!-- Center Readability Soft Gradient (Agar Teks di Tengah Jelas & Video Tetap Hidup) -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(0,0,0,0.4)_0%,_transparent_75%)] pointer-events-none"></div>

        <!-- Subtle Warm Ambient Tint (Grand Senyum Warm Tone) -->
        <div class="absolute inset-0 bg-gradient-to-tr from-[#1A1206]/15 via-transparent to-[#2A1C06]/10 pointer-events-none"></div>

        <!-- Soft Bottom Vignette -->
        <div class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none"></div>

        <!-- Fallback Placeholder when video file is not yet uploaded -->
        <div id="drone-video-fallback" class="hidden absolute inset-0 bg-gradient-to-br from-slate-950 via-zinc-900 to-amber-950/40 flex items-center justify-center p-6 text-center">
            <div class="max-w-md p-6 rounded-3xl bg-black/60 backdrop-blur-md border border-amber-500/30 text-white space-y-3 shadow-2xl">
                <i data-lucide="video" class="w-12 h-12 text-amber-400 mx-auto animate-pulse"></i>
                <h3 class="font-sans font-normal text-lg text-amber-300 tracking-wider">Hotel Video File Ready to Display</h3>
                <p class="text-xs text-slate-300 leading-relaxed font-light">
                    Place the video file named <code class="px-2 py-0.5 rounded bg-black text-amber-400 font-mono text-xs">drone.mp4</code> atau <code class="px-2 py-0.5 rounded bg-black text-amber-400 font-mono text-xs">compro.mp4</code> in folder:
                    <br><strong class="text-white block mt-2 font-mono text-[11px] bg-white/10 p-2 rounded">public/videos/</strong>
                </p>
            </div>
        </div>
    </div>

    <!-- Top Floating Bar: Logo & Controls -->
    <div class="relative z-20 px-6 sm:px-10 py-6 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Grand Senyum Hotel" class="h-10 sm:h-12 w-auto object-contain drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]">
            <div class="hidden sm:block border-l border-white/20 pl-3">
                <span class="text-xs uppercase font-sans tracking-[0.25em] text-[#d6ac57] font-normal block drop-shadow">
                    Grand Senyum Hotel
                </span>
                <span class="text-[10px] tracking-[0.15em] text-white/80 block uppercase font-light">
                    Senyum Stay Priority
                </span>
            </div>
        </div>

        <div class="flex items-center space-x-3">
            <!-- Audio Toggle (Mute / Unmute) -->
            <button type="button" 
                    id="audio-toggle-btn" 
                    onclick="toggleDroneAudio()" 
                    class="p-2.5 rounded-full bg-black/50 hover:bg-black/80 border border-white/20 text-white transition-all backdrop-blur-md shadow-lg"
                    title="Toggle Video Sound">
                <i data-lucide="volume-x" id="audio-icon" class="w-4 h-4 text-[#d6ac57]"></i>
            </button>
        </div>
    </div>

    <!-- Exact Center Cinematic Callout & CTA (Estetis, Agak Bold Bernyawa, Tidak Kosong, Berjarak & Berkelas) -->
    <div class="relative z-20 my-auto px-6 sm:px-10 py-8 max-w-4xl mx-auto flex flex-col items-center justify-center text-center space-y-7">
        
        <!-- Badge Atas Mewah -->
        <div class="inline-flex items-center space-x-3 px-6 py-2.5 rounded-full text-xs font-sans font-medium tracking-[0.22em] uppercase bg-black/55 text-[#f5d78e] border border-[#d6ac57]/50 backdrop-blur-md shadow-2xl">
            <i data-lucide="crown" class="w-3.5 h-3.5 text-[#d6ac57]"></i>
            <span>Grand Senyum Hotel Yogyakarta</span>
            <span class="w-1.5 h-1.5 rounded-full bg-[#d6ac57]"></span>
            <span class="text-white/90">VIP Member Club</span>
        </div>

        <!-- Judul Utama (Dua Baris Presisi: SENYUM STAY di Atas, PRIORITY Turun di Bawahnya) -->
        <div class="space-y-5 max-w-4xl mx-auto flex flex-col items-center justify-center">
            <h2 class="flex flex-col items-center justify-center text-center font-sans font-bold text-white uppercase drop-shadow-[0_4px_24px_rgba(0,0,0,0.85)] w-full">
                <!-- Baris 1: SENYUM STAY -->
                <span class="block text-3xl sm:text-5xl lg:text-6xl tracking-[0.22em] sm:tracking-[0.28em] leading-none text-white">
                    SENYUM STAY
                </span>
                
                <!-- Baris 2: PRIORITY (Turun ke Bawah Secara Presisi dengan Jarak & Tracking Emas Berimbang) -->
                <span class="block mt-3.5 sm:mt-5 text-2xl sm:text-4xl lg:text-5xl tracking-[0.32em] sm:tracking-[0.4em] gold-shimmer font-bold leading-none">
                    PRIORITY
                </span>
            </h2>

            <!-- Hairline Luxury Divider with Diamond Crest (Presisi di Tengah) -->
            <div class="flex items-center justify-center space-x-4 w-full max-w-xs mx-auto pt-2 pb-1">
                <div class="h-px bg-gradient-to-r from-transparent via-[#d6ac57]/70 to-transparent flex-1"></div>
                <div class="w-2 h-2 rotate-45 bg-[#d6ac57] shadow-[0_0_10px_#d6ac57]"></div>
                <div class="h-px bg-gradient-to-r from-transparent via-[#d6ac57]/70 to-transparent flex-1"></div>
            </div>

            <p class="text-sm sm:text-base text-stone-100 max-w-2xl mx-auto font-sans font-normal tracking-[0.06em] leading-relaxed drop-shadow-[0_2px_12px_rgba(0,0,0,0.8)]">
                An extraordinary stay experience blending exclusive comfort, point accumulation from room reservations & banquet revenue, and prestigious VIP rewards.
            </p>
        </div>

        <!-- Tombol Masuk ke Portal (Montserrat Agak Bold, Bercahaya Emas & Berkelas) -->
        <div class="pt-1 flex flex-col sm:flex-row items-center justify-center gap-4 w-full">
            <button type="button" 
                    onclick="closeDroneIntro()" 
                    class="group w-full sm:w-auto px-10 py-4 rounded-full bg-gradient-to-r from-[#d6ac57] via-[#f5d78e] to-[#b38a36] hover:brightness-110 text-slate-950 font-sans font-semibold text-xs sm:text-sm tracking-[0.18em] uppercase shadow-[0_0_40px_rgba(214,172,87,0.6)] hover:shadow-[0_0_55px_rgba(214,172,87,0.85)] hover:scale-105 active:scale-95 transition-all duration-300 flex items-center justify-center space-x-3">
                <span>Enter Member Portal Priority</span>
                <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"></i>
            </button>
        </div>

        <!-- 3 Feature Badges (Agar Tidak Kosong & Lebih Estetik) -->
        <div class="flex flex-wrap items-center justify-center gap-2.5 pt-2 text-[11px] sm:text-xs text-white/90 font-sans font-medium tracking-wider">
            <span class="inline-flex items-center space-x-1.5 px-3.5 py-1.5 rounded-full bg-black/45 border border-white/20 backdrop-blur-md shadow-sm">
                <i data-lucide="award" class="w-3.5 h-3.5 text-[#d6ac57]"></i>
                <span>Tiers: Silver &bull; Gold &bull; Platinum</span>
            </span>
            <span class="inline-flex items-center space-x-1.5 px-3.5 py-1.5 rounded-full bg-black/45 border border-white/20 backdrop-blur-md shadow-sm">
                <i data-lucide="gift" class="w-3.5 h-3.5 text-[#d6ac57]"></i>
                <span>Exclusive Rewards & E-Vouchers</span>
            </span>
            <span class="inline-flex items-center space-x-1.5 px-3.5 py-1.5 rounded-full bg-black/45 border border-white/20 backdrop-blur-md shadow-sm">
                <i data-lucide="train" class="w-3.5 h-3.5 text-[#d6ac57]"></i>
                <span>Complimentary Tugu Station Pick-up</span>
            </span>
        </div>
    </div>

    <!-- Bottom Spacer to Guarantee Exact Centering -->
    <div class="relative z-20 pb-4"></div>
</div>

<!-- ======================================================== -->
<!-- 1. HERO PRESENTATION (INSPIRED BY MULIA PRIVILEGE)       -->
<!-- ======================================================== -->
<section class="relative text-white pt-12 pb-20 sm:pt-16 sm:pb-28 overflow-hidden">
    <!-- Background Image with 80% Visibility & Balanced Luxury Gradient (Full HD, Tajam, Tidak Pecah) -->
    <div class="absolute inset-0 z-0 bg-[#140E06]">
        <!-- Hotel Aerial Building Image (Full HD 1080p, Tampil Jelas 80% Opacity) -->
        <img src="{{ asset('images/hero-building.jpg') }}" 
             alt="Grand Senyum Hotel Yogyakarta" 
             class="w-full h-full object-cover object-center scale-105 opacity-80 contrast-[1.06] saturate-[1.10]">

        <!-- Gradasi 80% Overlay: Melindungi Keterbacaan Teks Tanpa Menutupi Gambar Gedung HD -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#120D05]/92 via-[#1C1408]/60 via-55% to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#140E06]/60 via-transparent via-75% to-[#FAF7F2]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,_rgba(214,172,87,0.18)_0%,_transparent_70%)] pointer-events-none"></div>
    </div>

    <!-- Atmospheric Ambient Glows -->
    <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-[#D4AF37]/15 blur-3xl pointer-events-none z-0"></div>
    <div class="absolute top-1/2 -right-32 w-96 h-96 rounded-full bg-[#B8860B]/20 blur-3xl pointer-events-none z-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Left Column: Prestigious Copywriting -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex flex-wrap items-center justify-center lg:justify-start gap-2">
                    <span class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-amber-500/15 text-[#EBD195] border border-amber-500/30 backdrop-blur-md">
                        <i data-lucide="crown" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                        <span>Bespoke Loyalty Privilege</span>
                    </span>
                    <button type="button" 
                            onclick="openDroneIntro(true)" 
                            class="inline-flex items-center space-x-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-white/10 hover:bg-white/20 text-white border border-white/20 transition backdrop-blur-md">
                        <i data-lucide="play" class="w-3 h-3 text-[#d6ac57] fill-[#d6ac57]"></i>
                        <span>Play Hotel Video</span>
                    </button>
                </div>

                <div class="space-y-4">
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-sans font-light tracking-[0.12em] sm:tracking-[0.16em] uppercase leading-snug text-white drop-shadow-[0_4px_20px_rgba(0,0,0,0.95)]">
                        A World of Bespoke <br class="hidden sm:inline">
                        <span class="gold-shimmer font-normal drop-shadow-[0_2px_12px_rgba(0,0,0,0.85)]">Privileges & Recognition</span>
                    </h1>
                    <p class="text-sm sm:text-base text-stone-100 max-w-xl mx-auto lg:mx-0 leading-relaxed font-sans font-normal tracking-[0.05em] drop-shadow-[0_2px_10px_rgba(0,0,0,0.9)]">
                        Welcome to <span class="text-white font-medium">Senyum Stay Priority</span>, the prestigious loyalty program by Grand Senyum Hotel Yogyakarta. Earn genuine rewards from every room stay and banquet event revenue, while enjoying bespoke VIP privileges crafted for your highest comfort.
                    </p>
                </div>

                <!-- Quick CTA Links -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-2">
                    <a href="{{ route('guest.mobile') }}" class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-[#d6ac57] via-[#f5d78e] to-[#b38a36] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-lg hover:scale-105 transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="smartphone" class="w-4 h-4"></i>
                        <span>Open Mobile App</span>
                    </a>
                    <a href="#cek-poin" class="px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/25 text-white font-bold text-xs uppercase tracking-wider shadow-lg hover:scale-105 transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="search" class="w-4 h-4 text-[#d6ac57]"></i>
                        <span>Check Member Points</span>
                    </a>
                </div>

                <!-- 3 Mini Highlights with Luxury Glass Card (Kontras Tinggi & Mudah Dibaca) -->
                <div class="mt-6 p-4 sm:p-5 rounded-2xl bg-black/65 backdrop-blur-md border border-amber-500/35 shadow-2xl">
                    <div class="grid grid-cols-3 gap-2 sm:gap-4 text-center lg:text-left divide-x divide-white/15">
                        <div class="px-1 sm:px-2">
                            <span class="font-serif font-black text-lg sm:text-2xl text-[#F5D78E] block tracking-tight drop-shadow-[0_2px_10px_rgba(0,0,0,0.9)]">Silver &bull; Gold</span>
                            <span class="text-[11px] sm:text-xs text-amber-100/90 font-medium tracking-wide block mt-1 drop-shadow">Up to Platinum Tier</span>
                        </div>
                        <div class="px-1 sm:px-2">
                            <span class="font-serif font-black text-lg sm:text-2xl text-[#F5D78E] block tracking-tight drop-shadow-[0_2px_10px_rgba(0,0,0,0.9)]">+10 Points</span>
                            <span class="text-[11px] sm:text-xs text-amber-100/90 font-medium tracking-wide block mt-1 drop-shadow">Per IDR 1M Banquet Revenue</span>
                        </div>
                        <div class="px-1 sm:px-2">
                            <span class="font-serif font-black text-lg sm:text-2xl text-[#F5D78E] block tracking-tight drop-shadow-[0_2px_10px_rgba(0,0,0,0.9)]">10 &ndash; 30 Pts</span>
                            <span class="text-[11px] sm:text-xs text-amber-100/90 font-medium tracking-wide block mt-1 drop-shadow">Per Room Night Stay</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Floating Member Access Card -->
            <div class="lg:col-span-5" id="cek-poin">
                <div class="bg-[#FFFDF9] rounded-3xl border border-[#DEC8A4] p-6 sm:p-8 shadow-2xl text-stone-900 relative overflow-hidden">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 mb-4 pb-3 border-b border-[#E8DFC8]">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-sm">
                                <i data-lucide="shield-check" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] block font-serif">Registered Member Access</span>
                                <h3 class="font-serif font-black text-lg text-stone-900">Check Your Points & Privileges</h3>
                            </div>
                        </div>

                        <form action="{{ route('guest.points') }}#member-hub" method="GET" class="space-y-3.5" id="heroSearchForm" onsubmit="return validateHeroSearchForm()">
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-stone-800 mb-1">
                                    <i data-lucide="user" class="w-3.5 h-3.5 inline mr-1 text-[#8A6319]"></i> Guest Full Name
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $searchName) }}" 
                                       placeholder="Enter guest full name" 
                                       class="w-full px-4 py-3 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] outline-none text-stone-900 text-sm transition font-medium">
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-stone-800 mb-1">
                                    <i data-lucide="phone" class="w-3.5 h-3.5 inline mr-1 text-[#8A6319]"></i> Mobile Phone Number
                                </label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', $searchPhone) }}" 
                                       placeholder="e.g. 081234567890" 
                                       class="w-full px-4 py-3 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] outline-none text-stone-900 text-sm transition font-medium">
                            </div>

                            <p id="hero-search-error-msg" class="hidden text-xs text-rose-600 font-semibold"></p>

                            <button type="submit" 
                                    class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#D4AF37] via-[#DFB85B] to-[#B8860B] hover:from-[#B8860B] hover:to-[#D4AF37] text-stone-950 font-serif font-bold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition-all flex items-center justify-center space-x-2">
                                <i data-lucide="search" class="w-4 h-4"></i>
                                <span>Check Member Status & Points</span>
                            </button>
                        </form>

                        @if($guest)
                            <div class="mt-3 p-3 rounded-xl bg-amber-50 border border-amber-200 text-xs flex items-center justify-between text-amber-900">
                                <div class="truncate">
                                    <span class="font-bold">Active Member:</span> {{ $guest->name }} ({{ $guest->tier }})
                                </div>
                                <a href="#member-hub" class="text-[11px] font-bold text-[#8A6319] hover:underline shrink-0 ml-2 flex items-center">
                                    <span>View Details</span>
                                    <i data-lucide="arrow-down" class="w-3 h-3 ml-0.5"></i>
                                </a>
                            </div>
                        @endif
                    </div>

                    @if($searched && $notFound)
                        <div class="mt-4 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-xs text-rose-800 space-y-1">
                            <p class="font-bold flex items-center"><i data-lucide="alert-circle" class="w-4 h-4 mr-1 text-rose-600"></i> Guest Not Found</p>
                            <p>Name "{{ $searchName }}" or phone number "{{ $searchPhone }}" is not registered in our system. Please contact the Front Desk for new membership registration.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        </div>
    </div>
</section>

<!-- ======================================================== -->
<!-- 2. PERSONALIZED MEMBER HUB (WHEN GUEST IS SEARCHED)      -->
<!-- ======================================================== -->
@if($guest)
<section id="member-hub" class="scroll-mt-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 mb-16 relative z-30">
    <div class="bg-[#FFFDF9] rounded-3xl border-2 border-[#D4AF37] p-6 sm:p-10 shadow-2xl space-y-8">
        
        <!-- Welcome Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-[#E8DFC8]">
            <div class="flex items-center space-x-3.5">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md">
                    <i data-lucide="user-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <span class="text-xs uppercase font-bold text-[#8A6319] tracking-wider font-serif">Welcome Back</span>
                    <h2 class="text-2xl sm:text-3xl font-serif font-black text-stone-900">
                        {{ $guest->name }}
                    </h2>
                    <p class="text-xs text-stone-600 mt-0.5">
                        Member No: <span class="font-mono font-bold text-[#8A6319]">{{ $guest->member_number }}</span> &bull; Status: <span class="font-bold text-stone-900">{{ $guest->tier }} Member</span>
                    </p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <a href="#cek-poin" class="px-4 py-2.5 rounded-xl bg-[#FAF6EE] hover:bg-[#F5ECD8] border border-[#D8C9AF] text-stone-700 text-xs font-bold transition flex items-center space-x-1.5">
                    <i data-lucide="search" class="w-3.5 h-3.5 text-[#8A6319]"></i>
                    <span>Search Other Guest</span>
                </a>
                <a href="#katalog" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 text-xs font-serif font-bold uppercase tracking-wider shadow-sm hover:brightness-105 transition flex items-center space-x-1.5">
                    <i data-lucide="gift" class="w-4 h-4"></i>
                    <span>Redeem Points ({{ number_format($guest->points) }} Pts)</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left: VIP Digital Card -->
            <div class="lg:col-span-5 space-y-4">
                @php
                    $tier = $guest->tier;
                    $cardImage = match($tier) {
                        'Gold' => 'cards/card-gold.jpg',
                        'Platinum' => 'cards/card-platinum.jpg',
                        default => 'cards/card-silver.jpg',
                    };
                    $cardBorder = match($tier) {
                        'Gold' => 'border-2 border-[#d6ac57] shadow-amber-950/40',
                        'Platinum' => 'border-2 border-amber-400/40 shadow-stone-900/50',
                        default => 'border border-slate-400/40 shadow-slate-900/40',
                    };
                    $nameColor = match($tier) {
                        'Gold' => 'text-amber-100',
                        'Platinum' => 'text-stone-200',
                        default => 'text-stone-700',
                    };
                    $numColor = match($tier) {
                        'Gold' => 'text-white',
                        'Platinum' => 'text-[#d6ac57]',
                        default => 'text-stone-800',
                    };
                    $valColor = match($tier) {
                        'Gold' => 'text-amber-200/80',
                        'Platinum' => 'text-stone-400',
                        default => 'text-stone-500',
                    };
                @endphp

                <!-- Simple & Aesthetic Digital VIP Card (Direct from Customer's Official Card Asset) -->
                <div class="relative w-full rounded-3xl overflow-hidden aspect-[1011/639] shadow-2xl transition-all duration-300 hover:scale-[1.02] {{ $cardBorder }} group">
                    <img src="{{ asset('images/' . $cardImage) }}" alt="{{ $tier }} VIP Card" class="absolute inset-0 w-full h-full object-cover">

                    <!-- Top Right: Points Balance Pill Badge -->
                    <div class="absolute right-[4%] top-[5.5%] z-10">
                        <span class="px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold uppercase tracking-wider bg-black/60 backdrop-blur-md text-[#d6ac57] border border-[#d6ac57]/40 shadow-lg">
                            {{ number_format($guest->points, 0, ',', '.') }} PTS
                        </span>
                    </div>

                    <!-- Dynamic Customer Name & Member Number Overlay -->
                    <div class="absolute left-[5.5%] top-[65.2%] text-left pointer-events-none select-none z-10">
                        <div class="text-[11px] sm:text-[14px] md:text-[12px] lg:text-[14px] font-sans font-semibold tracking-[0.08em] uppercase {{ $nameColor }} leading-tight drop-shadow-sm truncate max-w-[240px]">
                            {{ $guest->name }}
                        </div>
                        <div class="text-[13px] sm:text-[17px] md:text-[14px] lg:text-[17px] font-sans font-semibold tracking-[0.14em] {{ $numColor }} mt-1 leading-tight drop-shadow-sm">
                            {{ $guest->member_number }}
                        </div>
                        <div class="text-[8px] sm:text-[10px] md:text-[8.5px] lg:text-[10px] font-sans font-light tracking-[0.06em] {{ $valColor }} mt-2 sm:mt-2.5 leading-tight">
                            VALID THRU 11/27
                        </div>
                    </div>
                </div>

                <!-- Point Accumulation & Tier Cap Progress -->
                <div class="p-5 rounded-2xl bg-[#FAF6EE] border border-[#D8C9AF] text-xs space-y-3">
                    <div class="flex justify-between font-bold text-stone-900">
                        <span>Accumulated Point Balance:</span>
                        <span class="text-[#8A6319]">
                            {{ number_format($guest->points) }} / {{ number_format($guest->max_points) }} Points
                        </span>
                    </div>
                    <div class="w-full bg-[#E8DCC8] rounded-full h-3 p-0.5 overflow-hidden">
                        <div class="h-full rounded-full bg-gradient-to-r from-[#D4AF37] to-[#B8860B] transition-all duration-500" style="width: {{ $guest->points_percentage }}%"></div>
                    </div>
                    <p class="text-stone-700 text-xs">
                        Tier range for <strong>{{ $guest->tier }}</strong>: <strong>{{ $guest->tier_config['range_label'] }}</strong> (Maximum cap {{ number_format($guest->max_points) }} points).
                    </p>
                    @if($guest->points >= $guest->max_points)
                        <div class="p-2.5 rounded-xl bg-amber-100 border border-amber-300 text-amber-950 font-semibold text-[11px] flex items-center space-x-2">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-amber-700 shrink-0"></i>
                            <span>Maximum tier limit reached! Points will not increase further until upgraded to the next tier.</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: Active Benefits & Privileges Pass -->
            <div class="lg:col-span-7 space-y-6">
                <div class="p-6 rounded-3xl bg-gradient-to-br from-[#FAF3E3] via-[#FFFDF9] to-[#F5EAD4] border border-[#DEC8A4] shadow-sm">
                    <div class="flex items-center justify-between pb-3 border-b border-[#DEC8A4]">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] font-serif block">Your Active Privileges</span>
                            <h3 class="font-serif font-black text-xl text-stone-900">Tier {{ $guest->tier }} Benefits</h3>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#FAF6EE] text-[#7A5210] border border-[#DEC8A4]">
                            {{ count($guest->benefits) }} Active Privileges
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">
                        @foreach($guest->benefits as $benefit)
                            <div class="flex items-start space-x-2.5 p-2.5 rounded-xl bg-[#FFFDF9] border border-[#E8DFC8] text-xs font-medium text-stone-800">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
                                <span>{{ $benefit }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- E-Voucher Wallet (Redemptions) -->
                @if($guest->redemptions->count() > 0)
                    <div class="p-6 rounded-3xl bg-[#FAF6EE] border border-[#D8C9AF]">
                        <div class="flex items-center justify-between mb-3 pb-2 border-b border-[#E8DFC8]">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] font-serif block">E-Voucher Wallet</span>
                                <h4 class="font-serif font-bold text-stone-900 text-base">Your Reward Vouchers</h4>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-[#EFE5D3] text-stone-800">
                                {{ $guest->redemptions->count() }} Vouchers
                            </span>
                        </div>

                        <div class="space-y-2.5">
                            @foreach($guest->redemptions as $rdm)
                                <div class="p-3.5 rounded-2xl bg-[#FFFDF9] border border-[#DEC8A4] flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <span class="font-mono font-bold text-sm text-[#8A6319]">{{ $rdm->voucher_code }}</span>
                                            @if($rdm->status === 'aktif')
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">Active</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-stone-200 text-stone-700">Redeemed</span>
                                            @endif
                                        </div>
                                        <p class="font-bold text-stone-900 mt-1">{{ $rdm->item_title }}</p>
                                        @if($rdm->selected_option)
                                            <p class="text-[11px] text-[#8A6319]">Option: {{ $rdm->selected_option }}</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-2 shrink-0">
                                        <button type="button" 
                                                onclick="viewVoucherModal('{{ $rdm->voucher_code }}', '{{ addslashes($rdm->item_title) }}', '{{ addslashes($rdm->selected_option ?: ($rdm->item_detail ?: '')) }}', {{ $rdm->points_cost }}, '{{ $rdm->redeemed_at ? $rdm->redeemed_at->translatedFormat('d M Y, H:i') : $rdm->created_at->translatedFormat('d M Y') }}', '{{ $rdm->status }}')"
                                                class="px-3 py-1.5 rounded-xl bg-stone-950 text-amber-300 font-bold hover:bg-stone-800 transition flex items-center space-x-1.5 shadow-sm text-xs">
                                            <i data-lucide="ticket" class="w-3.5 h-3.5"></i>
                                            <span>View E-Voucher</span>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

        </div>

        <!-- Riwayat Transaksi Tamu (Stays & Banquet Revenue) -->
        <div class="pt-6 border-t border-[#E8DFC8]">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <span class="text-xs uppercase font-serif tracking-widest text-[#8A6319] font-bold">Accumulation History</span>
                    <h3 class="font-serif font-black text-stone-900 text-lg">Your Reservation & Point Records</h3>
                </div>
                <span class="text-xs text-stone-600 font-medium">
                    Total: {{ $guest->stays->count() }} Transactions
                </span>
            </div>

            @if($guest->stays->count() > 0)
                <div class="overflow-x-auto rounded-2xl border border-[#D8C9AF]">
                    <table class="w-full text-left text-xs sm:text-sm text-stone-700">
                        <thead class="bg-[#F5EDE0] text-xs uppercase tracking-wider text-stone-900 border-b border-[#D8C9AF] font-bold">
                            <tr>
                                <th class="px-5 py-3.5">Date</th>
                                <th class="px-5 py-3.5">Booking Code</th>
                                <th class="px-5 py-3.5">Category</th>
                                <th class="px-5 py-3.5">Details</th>
                                <th class="px-5 py-3.5 text-right">Points Earned</th>
                                <th class="px-5 py-3.5">Notes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#EAE0CD]">
                            @foreach($guest->stays as $stay)
                                <tr class="hover:bg-[#FAF6EE] transition">
                                    <td class="px-5 py-4 font-medium text-stone-900 whitespace-nowrap">
                                        {{ $stay->stay_date ? $stay->stay_date->translatedFormat('d M Y') : $stay->created_at->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-5 py-4 font-mono font-bold text-stone-900 whitespace-nowrap">
                                        {{ $stay->booking_code }}
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        @if($stay->transaction_type === 'banquet')
                                            <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-[#F5EDDE] text-[#7A5210] border border-[#DEC8A4]">
                                                Banquet Revenue
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-[#FAF6EE] text-stone-800 border border-[#D8C9AF]">
                                                {{ $stay->room_type }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap text-stone-800 font-medium">
                                        @if($stay->transaction_type === 'banquet')
                                            Rp {{ number_format($stay->revenue_amount ?? 0, 0, ',', '.') }}
                                        @else
                                            {{ $stay->nights }} Night(s)
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-right font-bold text-[#8A6319] whitespace-nowrap">
                                        +{{ number_format($stay->points_added) }} Pts
                                    </td>
                                    <td class="px-5 py-4 text-xs text-stone-600">
                                        {{ $stay->notes ?: 'Recorded automatically' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-stone-600">
                    <p class="font-medium text-xs">No transaction records found for this member account yet.</p>
                </div>
            @endif
        </div>

    </div>
</section>
@endif

<!-- ======================================================== -->
<!-- 3. ABOUT SENYUM STAY PRIORITY                          -->
<!-- ======================================================== -->
<section id="tentang" class="py-16 sm:py-24 border-b border-[#E8DFC8] bg-[#FAF7F2]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-[#F5EDDE] text-[#7A5210] border border-[#DEC8A4]">
                <i data-lucide="gem" class="w-3.5 h-3.5 text-[#B8860B]"></i>
                <span>Bespoke Yogyakarta Hospitality</span>
            </span>
            <h2 class="text-3xl sm:text-4xl font-serif font-black text-stone-900 tracking-tight">
                About Senyum Stay Priority
            </h2>
            <p class="text-stone-700 text-sm sm:text-base leading-relaxed">
                Specially crafted for guests who appreciate refined hospitality in the heart of Yogyakarta. Our three pillars ensure every stay and event becomes a truly memorable experience.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Pillar 1 -->
            <div class="p-8 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-md hover:shadow-xl hover:border-[#D4AF37] transition-all space-y-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md">
                    <i data-lucide="hotel" class="w-7 h-7"></i>
                </div>
                <h3 class="font-serif font-black text-xl text-stone-900">Bespoke Hospitality</h3>
                <p class="text-xs sm:text-sm text-stone-700 leading-relaxed">
                    Prime location on Jalan Pangeran Diponegoro No.27, near Tugu Monument and Malioboro. Enjoy bespoke comfort with complimentary Tugu station pick-up, early check-in, and late check-out.
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="p-8 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-md hover:shadow-xl hover:border-[#D4AF37] transition-all space-y-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md">
                    <i data-lucide="coins" class="w-7 h-7"></i>
                </div>
                <h3 class="font-serif font-black text-xl text-stone-900">Genuine Point Rewards</h3>
                <p class="text-xs sm:text-sm text-stone-700 leading-relaxed">
                    Earn points from every room night across Grand Deluxe to President Suite, plus banquet revenue rewards (+10 Pts per IDR 1,000,000).
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="p-8 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-md hover:shadow-xl hover:border-[#D4AF37] transition-all space-y-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md">
                    <i data-lucide="gift" class="w-7 h-7"></i>
                </div>
                <h3 class="font-serif font-black text-xl text-stone-900">Exclusive Rewards Redemption</h3>
                <p class="text-xs sm:text-sm text-stone-700 leading-relaxed">
                    Redeem points for exclusive GSH souvenirs, gourmet dining vouchers, electric bicycle rentals, and complimentary free room stays.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- ======================================================== -->
<!-- 4. MEMBERSHIP TIERS & BENEFIT MATRIX             -->
<!-- ======================================================== -->
<section id="tier" class="py-16 sm:py-24 bg-[#FAF3E3]/50 border-b border-[#E8DFC8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-[#EFE5D3] text-[#7A5210] border border-[#DEC8A4]">
                <i data-lucide="award" class="w-3.5 h-3.5 text-[#B8860B]"></i>
                <span>Guest Membership Tiers</span>
            </span>
            <h2 class="text-3xl sm:text-4xl font-serif font-black text-stone-900 tracking-tight">
                Membership Tiers & Exclusive Privileges
            </h2>
            <p class="text-stone-700 text-sm sm:text-base leading-relaxed">
                The more frequently you stay and host events at Grand Senyum Hotel, the higher tier privileges and rewards you will enjoy.
            </p>
        </div>

        <!-- 3 Simple & Aesthetic VIP Cards Showcase -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-14">
            
            <!-- ============================================== -->
            <!-- 1. SILVER PRIORITY CARD & DETAILS              -->
            <!-- ============================================== -->
            <div class="space-y-5 flex flex-col justify-between">
                <!-- Physical-Style VIP Digital Card (Silver) -->
                <div class="relative w-full aspect-[1011/639] rounded-3xl overflow-hidden border border-slate-400/40 shadow-2xl shadow-slate-900/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-slate-900/50 group">
                    <img src="{{ asset('images/cards/card-silver.jpg') }}" alt="Silver Member Card" class="absolute inset-0 w-full h-full object-cover">

                    <!-- Dynamic Cardholder Overlay -->
                    <div class="absolute left-[5.5%] top-[65.2%] text-left pointer-events-none select-none z-10">
                        <div class="text-[11px] sm:text-[13px] font-sans font-semibold tracking-[0.08em] uppercase text-stone-700 leading-tight">
                            SILVER MEMBER
                        </div>
                        <div class="text-[13px] sm:text-[16px] font-sans font-semibold tracking-[0.14em] text-stone-800 mt-1 leading-tight">
                            GSH 2610 1088
                        </div>
                        <div class="text-[8px] sm:text-[9.5px] font-sans font-light tracking-[0.06em] text-stone-500 mt-2 leading-tight">
                            VALID THRU 11/27
                        </div>
                    </div>
                </div>

                <!-- Tier Benefit Card Box -->
                <div class="p-6 rounded-3xl bg-[#FFFDF9] border border-[#DEC8A4] shadow-md flex-1 flex flex-col justify-between space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between pb-2.5 border-b border-[#E8DFC8]">
                            <div>
                                <span class="text-[10px] uppercase font-serif font-bold text-stone-600 tracking-wider">Entry Tier</span>
                                <h3 class="text-xl font-serif font-black text-stone-900">Silver Member</h3>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-stone-200 text-stone-800">
                                ( 0 – 1000 Point )
                            </span>
                        </div>

                        <p class="text-xs text-stone-700 leading-relaxed">
                            Introductory membership for every registered guest. Enjoy instant dining discounts across all hotel restaurants.
                        </p>

                        <div class="space-y-1.5 pt-2 border-t border-[#E8DFC8] text-xs text-stone-800">
                            @foreach($tiers['Silver']['benefits'] as $b)
                                <div class="flex items-start space-x-2 font-medium">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
                                    <span>{{ $b }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-3 border-t border-[#E8DFC8]">
                        <span class="text-[11px] text-stone-600 block">Maximum Points Limit: <strong>1,000 Points</strong></span>
                    </div>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- 2. GOLD PRIORITY CARD & DETAILS                -->
            <!-- ============================================== -->
            <div class="space-y-5 flex flex-col justify-between">
                <!-- Physical-Style VIP Digital Card (Gold #d6ac57) -->
                <div class="relative w-full aspect-[1011/639] rounded-3xl overflow-hidden border-2 border-[#d6ac57] shadow-2xl shadow-amber-950/40 transition-all duration-300 hover:-translate-y-2 hover:shadow-amber-950/60 group">
                    <img src="{{ asset('images/cards/card-gold.jpg') }}" alt="Gold Member Card" class="absolute inset-0 w-full h-full object-cover">

                    <!-- Dynamic Cardholder Overlay -->
                    <div class="absolute left-[5.5%] top-[65.2%] text-left pointer-events-none select-none z-10">
                        <div class="text-[11px] sm:text-[13px] font-sans font-semibold tracking-[0.08em] uppercase text-amber-100 leading-tight drop-shadow-sm">
                            GOLD MEMBER
                        </div>
                        <div class="text-[13px] sm:text-[16px] font-sans font-semibold tracking-[0.14em] text-white mt-1 leading-tight drop-shadow-sm">
                            GSH 2610 5022
                        </div>
                        <div class="text-[8px] sm:text-[9.5px] font-sans font-light tracking-[0.06em] text-amber-200/80 mt-2 leading-tight">
                            VALID THRU 11/27
                        </div>
                    </div>
                </div>

                <!-- Tier Benefit Card Box -->
                <div class="p-6 rounded-3xl bg-[#FFFDF9] border-2 border-[#d6ac57] shadow-xl relative overflow-hidden flex-1 flex flex-col justify-between space-y-4">
                    <div class="absolute top-0 right-0 bg-gradient-to-l from-[#d6ac57] to-[#b38a36] text-slate-950 font-serif font-bold text-[9px] uppercase tracking-widest px-3.5 py-0.5 rounded-bl-xl shadow-sm">
                        Popular
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between pb-2.5 border-b border-[#DEC8A4]">
                            <div>
                                <span class="text-[10px] uppercase font-serif font-bold text-[#8A6319] tracking-wider">Mid Tier</span>
                                <h3 class="text-xl font-serif font-black text-stone-900">Gold Member</h3>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-[#d6ac57] to-[#b38a36] text-slate-950">
                                ( 1000 – 5000 Point )
                            </span>
                        </div>

                        <p class="text-xs text-stone-700 leading-relaxed">
                            Enjoy complimentary Tugu Station transfers, direct booking discounts, early check-in, and room upgrades.
                        </p>

                        <div class="space-y-1.5 pt-2 border-t border-[#DEC8A4] text-xs text-stone-800">
                            @foreach($tiers['Gold']['benefits'] as $b)
                                <div class="flex items-start space-x-2 font-medium">
                                    <i data-lucide="check" class="w-4 h-4 text-[#d6ac57] shrink-0 mt-0.5"></i>
                                    <span>{{ $b }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-3 border-t border-[#DEC8A4]">
                        <span class="text-[11px] text-amber-950 font-semibold block">Maximum Points Limit: <strong>5,000 Points</strong></span>
                    </div>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- 3. PLATINUM VIP PRIORITY CARD & DETAILS        -->
            <!-- ============================================== -->
            <div class="space-y-5 flex flex-col justify-between">
                <!-- Physical-Style VIP Digital Card (Platinum) -->
                <div class="relative w-full aspect-[1011/639] rounded-3xl overflow-hidden border-2 border-amber-400/40 shadow-2xl shadow-stone-950/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-stone-950/70 group">
                    <img src="{{ asset('images/cards/card-platinum.jpg') }}" alt="Platinum Member Card" class="absolute inset-0 w-full h-full object-cover">

                    <!-- Dynamic Cardholder Overlay -->
                    <div class="absolute left-[5.5%] top-[65.2%] text-left pointer-events-none select-none z-10">
                        <div class="text-[11px] sm:text-[13px] font-sans font-semibold tracking-[0.08em] uppercase text-stone-200 leading-tight">
                            PLATINUM VIP
                        </div>
                        <div class="text-[13px] sm:text-[16px] font-sans font-semibold tracking-[0.14em] text-[#d6ac57] mt-1 leading-tight">
                            GSH 2610 8888
                        </div>
                        <div class="text-[8px] sm:text-[9.5px] font-sans font-light tracking-[0.06em] text-stone-400 mt-2 leading-tight">
                            VALID THRU 11/27
                        </div>
                    </div>
                </div>

                <!-- Tier Benefit Card Box -->
                <div class="p-6 rounded-3xl bg-[#FFFDF9] border-2 border-[#A881D4] shadow-xl relative overflow-hidden flex-1 flex flex-col justify-between space-y-4">
                    <div class="absolute top-0 right-0 bg-indigo-600 text-white font-serif font-bold text-[9px] uppercase tracking-widest px-3.5 py-0.5 rounded-bl-xl shadow-sm">
                        Highest
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between pb-2.5 border-b border-[#DEC6F5]">
                            <div>
                                <span class="text-[10px] uppercase font-serif font-bold text-indigo-900 tracking-wider">Highest Tier</span>
                                <h3 class="text-xl font-serif font-black text-stone-900">Platinum VIP</h3>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-500 text-white">
                                ( 5000 – 10.000 Point )
                            </span>
                        </div>

                        <p class="text-xs text-stone-700 leading-relaxed">
                            The pinnacle of luxury appreciation featuring a complimentary annual 1-night stay, birthday cake, special gift, and premier benefits.
                        </p>

                        <div class="space-y-1.5 pt-2 border-t border-[#DEC6F5] text-xs text-stone-800">
                            @foreach($tiers['Platinum']['benefits'] as $b)
                                <div class="flex items-start space-x-2 font-medium">
                                    <i data-lucide="check" class="w-4 h-4 text-indigo-600 shrink-0 mt-0.5"></i>
                                    <span>{{ $b }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-3 border-t border-[#DEC6F5]">
                        <span class="text-[11px] text-indigo-950 font-semibold block">Maximum Accumulation Limit: <strong>10,000 Points</strong></span>
                    </div>
                </div>
            </div>

        </div>

        <!-- ============================================== -->
        <!-- WHEEL OF FORTUNE (LUCKY DRAW 5G GOLD PRIZE)    -->
        <!-- ============================================== -->
        <div class="mb-14 relative overflow-hidden rounded-3xl border-2 border-[#D4AF37] bg-gradient-to-br from-[#FFFDF9] via-[#FAF3E3] to-[#F3E5C8] p-6 sm:p-8 shadow-xl">
            <div class="absolute -right-12 -top-12 w-48 h-48 bg-[#D4AF37]/15 rounded-full blur-2xl pointer-events-none"></div>
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 relative z-10">
                <div class="flex items-center space-x-4 sm:space-x-6 text-center md:text-left">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-tr from-[#996515] via-[#D4AF37] to-[#FDF4CD] p-0.5 shadow-lg shrink-0 flex items-center justify-center">
                        <div class="w-full h-full bg-[#1e1709] rounded-2xl flex items-center justify-center">
                            <i data-lucide="sparkles" class="w-8 h-8 sm:w-10 sm:h-10 text-[#F5DE93] animate-pulse"></i>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <div class="inline-flex items-center space-x-1.5 px-3 py-0.5 rounded-full bg-[#E5B54F]/20 text-[#7A5210] border border-[#DEC8A4] text-[10px] sm:text-xs font-bold uppercase tracking-widest">
                            <i data-lucide="trophy" class="w-3.5 h-3.5 text-[#B8860B]"></i>
                            <span>Grand Annual Lucky Draw</span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-serif font-black text-stone-900 tracking-tight">
                            Wheel of Fortune
                        </h3>
                        <p class="text-sm sm:text-base text-stone-800 font-semibold">
                            Earn a minimum of 5,000 points for a chance to win a 5-gram gold prize!
                        </p>
                        <p class="text-xs text-stone-600 italic">
                            *The lucky draw takes place at the end of each year.
                        </p>
                    </div>
                </div>

                <div class="shrink-0">
                    <div class="px-5 py-3 rounded-2xl bg-[#1e1709] text-white border border-[#D4AF37]/50 shadow-md text-center">
                        <span class="text-[10px] uppercase tracking-widest text-[#D4AF37] font-bold block">Grand Prize</span>
                        <span class="text-lg font-serif font-black text-[#F5DE93]">5-Gram Pure Gold Bar</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comprehensive Side-by-Side Comparison Matrix (Mulia Privilege Style Table) -->
        <div class="bg-[#FFFDF9] rounded-3xl border border-[#DEC8A4] p-6 sm:p-8 shadow-lg">
            <h3 class="font-serif font-black text-xl text-stone-900 mb-4 pb-2 border-b border-[#E8DFC8] flex items-center">
                <i data-lucide="table-2" class="w-5 h-5 mr-2 text-[#8A6319]"></i>
                Complete Member Privileges & Benefits Comparison Matrix
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm text-stone-800">
                    <thead class="bg-[#F5EDE0] text-xs font-bold uppercase tracking-wider text-stone-900 border-b border-[#D8C9AF]">
                        <tr>
                            <th class="px-4 py-3.5">Member Benefits & Privileges</th>
                            <th class="px-4 py-3.5 text-center">Silver (0-1.000 Pts)</th>
                            <th class="px-4 py-3.5 text-center bg-[#FAF3E3]">Gold (1.000-5.000 Pts)</th>
                            <th class="px-4 py-3.5 text-center">Platinum (5.000-10.000 Pts)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EAE0CD]">
                        <tr>
                            <td class="px-4 py-3 font-semibold">Discount on F&B</td>
                            <td class="px-4 py-3 text-center font-bold text-stone-900">5%</td>
                            <td class="px-4 py-3 text-center font-bold text-amber-900 bg-[#FAF3E3]">10%</td>
                            <td class="px-4 py-3 text-center font-bold text-indigo-950">15%</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">Laundry Benefit / Discount</td>
                            <td class="px-4 py-3 text-center font-bold text-stone-900">IDR 10,000 Disc</td>
                            <td class="px-4 py-3 text-center font-bold text-amber-900 bg-[#FAF3E3]">Free 3 Pieces<div class="text-[10px] font-normal text-stone-600">(1 Top, 1 Bottom, 1 Undergarment)</div></td>
                            <td class="px-4 py-3 text-center font-bold text-indigo-950">Free 5 Pieces<div class="text-[10px] font-normal text-stone-600">(1 Top, 1 Bottom, 3 Undergarments)</div></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">Discount on Room Rates (Direct Booking)</td>
                            <td class="px-4 py-3 text-center font-bold text-stone-900">IDR 25,000</td>
                            <td class="px-4 py-3 text-center font-bold text-amber-900 bg-[#FAF3E3]">IDR 50,000</td>
                            <td class="px-4 py-3 text-center font-bold text-indigo-950">IDR 100,000</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">Early Check-in & Late Check-out Privileges</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600 bg-[#FAF3E3]"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">Complimentary Pick-up & Drop-off at Tugu Train Station</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600 bg-[#FAF3E3]"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">Complimentary Room Upgrade (Subject to Availability)</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600 bg-[#FAF3E3]"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">Complimentary E-Bike for 1 Hour</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center font-bold text-amber-900 bg-[#FAF3E3]">1 Person</td>
                            <td class="px-4 py-3 text-center font-bold text-indigo-950">Up to 2 Persons</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">VIP Treatment</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600 bg-[#FAF3E3]"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">Complimentary Birthday Cake</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-stone-400 bg-[#FAF3E3]">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">Special Gift</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-stone-400 bg-[#FAF3E3]">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">Complimentary Room for 1 Night Stay Annually</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-stone-400 bg-[#FAF3E3]">-</td>
                            <td class="px-4 py-3 text-center font-bold text-indigo-950 bg-indigo-50/50">1 Night Annually</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">Wheel of Fortune (Grand Lucky Draw 5g Gold)</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-stone-400 bg-[#FAF3E3]">-</td>
                            <td class="px-4 py-3 text-center font-bold text-amber-700 bg-amber-50/60"><i data-lucide="sparkles" class="w-4 h-4 mx-auto text-[#B8860B]"></i>Min. 5.000 Pts</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

<!-- ======================================================== -->
<!-- 5. HOW TO EARN POINTS (ROOM & BANQUET)                -->
<!-- ======================================================== -->
<section id="perolehan" class="py-16 sm:py-24 bg-[#FAF7F2] border-b border-[#E8DFC8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-[#F5EDDE] text-[#7A5210] border border-[#DEC8A4]">
                <i data-lucide="calculator" class="w-3.5 h-3.5 text-[#B8860B]"></i>
                <span>Point Accumulation Structure</span>
            </span>
            <h2 class="text-3xl sm:text-4xl font-serif font-black text-stone-900 tracking-tight">
                How to Earn Member Points
            </h2>
            <p class="text-stone-700 text-sm sm:text-base leading-relaxed">
                Points are earned automatically from room reservations per night as well as meetings and banquet events held at Grand Senyum Hotel.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch mb-12">
            
            <!-- Room Stays Point Rates -->
            <div class="p-6 sm:p-8 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-md flex flex-col justify-between space-y-6">
                <div>
                    <div class="flex items-center space-x-3 pb-3 border-b border-[#E8DFC8] mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-bold shadow-sm">
                            <i data-lucide="bed-double" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] block font-serif">Hotel Rooms</span>
                            <h3 class="font-serif font-bold text-stone-900 text-lg">Points Value from Rooms (Per Night)</h3>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($roomRates as $room => $pts)
                            <div class="p-4 rounded-2xl bg-[#FAF6EE] border border-[#D8C9AF] flex items-center justify-between">
                                <div>
                                    <span class="text-xs text-stone-600 block">Room Category</span>
                                    <h4 class="font-serif font-bold text-stone-900 text-sm">{{ $room }}</h4>
                                </div>
                                <div class="text-right">
                                    <span class="font-mono font-black text-lg text-[#8A6319]">+{{ $pts }}</span>
                                    <span class="text-[10px] text-stone-600 block uppercase font-bold">Points / Night</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-[#F5EDE0] text-xs text-stone-700 space-y-1">
                    <p class="font-bold text-stone-900 flex items-center"><i data-lucide="info" class="w-3.5 h-3.5 mr-1 text-[#8A6319]"></i> Room Reservation Terms:</p>
                    <p>Points are automatically credited to your member account upon check-out processing by the hotel reception.</p>
                </div>
            </div>

            <!-- Banquet Revenue Rate -->
            <div class="p-6 sm:p-8 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-md flex flex-col justify-between space-y-6">
                <div>
                    <div class="flex items-center space-x-3 pb-3 border-b border-[#E8DFC8] mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-bold shadow-sm">
                            <i data-lucide="sparkles" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] block font-serif">Banquet & Events</span>
                            <h3 class="font-serif font-bold text-stone-900 text-lg">Nilai Poin dari Banquet Revenue</h3>
                        </div>
                    </div>

                    <div class="p-6 rounded-3xl bg-gradient-to-br from-[#FAF3E3] via-[#FFFDF9] to-[#F5EAD4] border-2 border-[#D4AF37] space-y-4">
                        <div class="flex items-baseline justify-between">
                            <span class="text-xs uppercase font-serif font-bold text-[#8A6319]">Banquet Calculation</span>
                            <span class="font-mono font-black text-2xl text-[#8A6319]">+10 Points</span>
                        </div>
                        <p class="font-serif font-bold text-stone-900 text-base">
                            Earn 10 Points for every IDR 1,000,000 in qualifying banquet revenue
                        </p>
                        <p class="text-xs text-stone-700 leading-relaxed">
                            Applies in full multiples for ballroom bookings, meeting packages, weddings, and gala dinners.
                        </p>

                        <!-- Example Calculations -->
                        <div class="grid grid-cols-3 gap-2 pt-2 border-t border-[#DEC8A4] text-center text-xs">
                            <div class="p-2.5 rounded-xl bg-[#FFFDF9] border border-[#DEC8A4]">
                                <span class="text-[10px] text-stone-600 block">IDR 5 Million</span>
                                <span class="font-bold text-[#8A6319]">50 Pts</span>
                            </div>
                            <div class="p-2.5 rounded-xl bg-[#FFFDF9] border border-[#DEC8A4]">
                                <span class="text-[10px] text-stone-600 block">IDR 20 Million</span>
                                <span class="font-bold text-[#8A6319]">200 Pts</span>
                            </div>
                            <div class="p-2.5 rounded-xl bg-[#FFFDF9] border border-[#DEC8A4]">
                                <span class="text-[10px] text-stone-600 block">IDR 50 Million</span>
                                <span class="font-bold text-[#8A6319]">500 Pts</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-[#F5EDE0] text-xs text-stone-700 space-y-1">
                    <p class="font-bold text-stone-900 flex items-center"><i data-lucide="info" class="w-3.5 h-3.5 mr-1 text-[#8A6319]"></i> Banquet Event Terms:</p>
                    <p>Points are calculated based on official billing before tax and service charge, applicable for direct bookings with GSH banquet sales.</p>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ======================================================== -->
<!-- 6. REWARDS REDEMPTION CATALOG (REDEEM POINTS)             -->
<!-- ======================================================== -->
<section id="katalog" class="py-16 sm:py-24 bg-[#FAF3E3]/50 border-b border-[#E8DFC8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-10 space-y-3">
            <span class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-[#EFE5D3] text-[#7A5210] border border-[#DEC8A4]">
                <i data-lucide="gift" class="w-3.5 h-3.5 text-[#B8860B]"></i>
                <span>Exclusive Rewards Collection</span>
            </span>
            <h2 class="text-3xl sm:text-4xl font-serif font-black text-stone-900 tracking-tight">
                Rewards Redemption Catalog
            </h2>
            <p class="text-stone-700 text-sm sm:text-base leading-relaxed">
                Redeem your accumulated points for official Grand Senyum Hotel souvenirs, dining vouchers, E-bike rentals, or complimentary room stays.
            </p>
        </div>

        {{-- Alert Sukses Redeem Poin --}}
        @if(session('redeem_success'))
            <div class="mb-10 p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-[#FAF3E3] via-[#FFFDF9] to-[#F5EAD4] border-2 border-[#D4AF37] shadow-xl text-stone-900 space-y-4">
                <div class="flex items-center space-x-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md">
                        <i data-lucide="sparkles" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-[#8A6319]">Reward Redemption Successful!</span>
                        <h3 class="font-serif font-black text-2xl text-stone-900">Your E-Voucher is Ready to Use</h3>
                    </div>
                </div>

                <div class="p-5 rounded-2xl bg-[#FFFDF9] border border-[#DEC8A4] flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-sm">
                    <div>
                        <span class="text-[11px] uppercase tracking-wider text-stone-600 font-bold block">Official Voucher Code</span>
                        <div class="flex items-center space-x-2 mt-0.5">
                            <span class="font-mono font-black text-2xl sm:text-3xl text-[#8A6319] tracking-wider">{{ session('redeem_success.voucher_code') }}</span>
                            <button type="button" onclick="copyVoucherCode('{{ session('redeem_success.voucher_code') }}')" class="p-1.5 rounded-lg bg-[#FAF6EE] hover:bg-[#F5ECD8] text-stone-700 hover:text-stone-950 transition border border-[#D8C9AF]" title="Copy Code">
                                <i data-lucide="copy" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <p class="font-serif font-bold text-stone-900 text-base mt-2">
                            {{ session('redeem_success.item_title') }}
                            @if(session('redeem_success.selected_option'))
                                <span class="text-xs font-semibold text-[#8A6319] block sm:inline sm:ml-1">({{ session('redeem_success.selected_option') }})</span>
                            @endif
                        </p>
                        <p class="text-xs text-stone-700 mt-0.5">{{ session('redeem_success.item_detail') }}</p>
                    </div>
                    <div class="text-left sm:text-right sm:border-l sm:pl-6 border-[#DEC8A4]">
                        <span class="text-[11px] text-stone-600 font-bold uppercase tracking-wider block">Points Deducted</span>
                        <span class="font-mono font-bold text-rose-600 text-lg">-{{ number_format(session('redeem_success.points_cost')) }} Pts</span>
                        <span class="text-[11px] text-stone-600 font-bold uppercase tracking-wider block mt-1">Remaining Balance:</span>
                        <span class="font-serif font-black text-[#8A6319] text-xl">{{ number_format(session('redeem_success.points_after')) }} Pts</span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-stone-700 pt-1">
                    <span class="flex items-center">
                        <i data-lucide="info" class="w-4 h-4 mr-1.5 text-[#8A6319] shrink-0"></i>
                        Present this e-voucher code to the Front Desk or Restaurant staff upon physical redemption at Grand Senyum Hotel.
                    </span>
                    <button type="button" 
                            onclick="viewVoucherModal('{{ session('redeem_success.voucher_code') }}', '{{ addslashes(session('redeem_success.item_title')) }}', '{{ addslashes(session('redeem_success.selected_option') ?: (session('redeem_success.item_detail') ?: '')) }}', {{ session('redeem_success.points_cost') }}, '{{ now()->translatedFormat('d M Y, H:i') }}', 'aktif')"
                            class="px-5 py-2.5 rounded-xl bg-stone-950 text-amber-300 font-bold hover:bg-stone-800 transition flex items-center space-x-1.5 shadow-md">
                        <i data-lucide="ticket" class="w-4 h-4"></i>
                        <span>View & Print E-Voucher</span>
                    </button>
                </div>
            </div>
        @endif

        <!-- Filter Tabs: All Rewards / 100 Points / 500 Points / 1,000 Points -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
            <button type="button" onclick="filterCatalog('all')" id="catalog-tab-all" class="catalog-tab-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-stone-950 text-white shadow-md transition">
                All Rewards
            </button>
            <button type="button" onclick="filterCatalog(100)" id="catalog-tab-100" class="catalog-tab-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#FFFDF9] text-stone-700 hover:bg-[#F5ECD8] border border-[#DEC8A4] shadow-sm transition">
                100 Pointsts
            </button>
            <button type="button" onclick="filterCatalog(500)" id="catalog-tab-500" class="catalog-tab-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#FFFDF9] text-stone-700 hover:bg-[#F5ECD8] border border-[#DEC8A4] shadow-sm transition">
                500 Pointsts
            </button>
            <button type="button" onclick="filterCatalog(1000)" id="catalog-tab-1000" class="catalog-tab-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#FFFDF9] text-stone-700 hover:bg-[#F5ECD8] border border-[#DEC8A4] shadow-sm transition">
                1,000 Points (Free Stay)
            </button>
        </div>

        <!-- Catalog Items Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Category 100 Pts Items -->
            @foreach($redeemCatalog[100]['items'] as $item)
                <div class="catalog-card catalog-tier-100 p-6 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] hover:border-[#D4AF37] hover:shadow-xl transition-all flex flex-col justify-between space-y-5">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-[#E8DFC8]">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#F5EDDE] text-[#7A5210] border border-[#DEC8A4]">
                                {{ $item['badge'] }}
                            </span>
                            <span class="font-mono font-black text-sm text-[#8A6319]">100 Points</span>
                        </div>
                        <h4 class="font-serif font-black text-stone-900 text-lg mt-3">{{ $item['title'] }}</h4>
                        <p class="text-xs text-stone-700 mt-1.5 leading-relaxed">{{ $item['detail'] }}</p>
                    </div>

                    <div class="pt-4 border-t border-[#E8DFC8]">
                        @if($guest)
                            @if($guest->points >= 100)
                                <button type="button" 
                                        onclick="openRedeemModal('{{ $item['id'] }}', '{{ addslashes($item['title']) }}', 100, '{{ addslashes($item['detail']) }}', {{ json_encode($item['options'] ?? []) }})"
                                        class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#D4AF37] via-[#DFB85B] to-[#B8860B] hover:from-[#B8860B] hover:to-[#D4AF37] text-stone-950 font-serif font-bold text-xs uppercase tracking-wider shadow-sm hover:shadow transition flex items-center justify-center space-x-1.5">
                                    <i data-lucide="gift" class="w-4 h-4"></i>
                                    <span>Redeem 100 Pts</span>
                                </button>
                            @else
                                <button type="button" disabled 
                                        class="w-full py-3 px-4 rounded-xl bg-[#EAE3D5] text-stone-500 font-bold text-xs cursor-not-allowed border border-[#D8C9AF] flex items-center justify-center space-x-1.5">
                                    <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                                    <span>Need {{ number_format(100 - $guest->points) }} more Pts</span>
                                </button>
                            @endif
                        @else
                            <a href="#cek-poin" 
                               class="w-full py-3 px-4 rounded-xl bg-stone-900 hover:bg-stone-800 text-white font-bold text-xs uppercase tracking-wider transition flex items-center justify-center space-x-1.5">
                                <span>Check Points & Redeem</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach

            <!-- Category 500 Pts Items -->
            @foreach($redeemCatalog[500]['items'] as $item)
                <div class="catalog-card catalog-tier-500 p-6 rounded-3xl bg-[#FFFDF9] border border-[#DEC8A4] hover:border-[#D4AF37] hover:shadow-xl transition-all flex flex-col justify-between space-y-5">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-[#E8DFC8]">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#FAF3E3] text-[#7A5210] border border-[#D4AF37]">
                                {{ $item['badge'] }}
                            </span>
                            <span class="font-mono font-black text-sm text-[#8A6319]">500 Points</span>
                        </div>
                        <h4 class="font-serif font-black text-stone-900 text-lg mt-3">{{ $item['title'] }}</h4>
                        <p class="text-xs text-stone-700 mt-1.5 leading-relaxed">{{ $item['detail'] }}</p>
                        @if(!empty($item['options']))
                            <div class="mt-2.5 p-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] text-[11px] text-[#8A6319] font-medium">
                                <span class="font-bold block text-stone-900 mb-0.5">Merchandise Options:</span>
                                {{ implode(', ', $item['options']) }}
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-[#E8DFC8]">
                        @if($guest)
                            @if($guest->points >= 500)
                                <button type="button" 
                                        onclick="openRedeemModal('{{ $item['id'] }}', '{{ addslashes($item['title']) }}', 500, '{{ addslashes($item['detail']) }}', {{ json_encode($item['options'] ?? []) }})"
                                        class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#D4AF37] via-[#DFB85B] to-[#B8860B] hover:from-[#B8860B] hover:to-[#D4AF37] text-stone-950 font-serif font-bold text-xs uppercase tracking-wider shadow-sm hover:shadow transition flex items-center justify-center space-x-1.5">
                                    <i data-lucide="gift" class="w-4 h-4"></i>
                                    <span>Redeem 500 Pts</span>
                                </button>
                            @else
                                <button type="button" disabled 
                                        class="w-full py-3 px-4 rounded-xl bg-[#EAE3D5] text-stone-500 font-bold text-xs cursor-not-allowed border border-[#D8C9AF] flex items-center justify-center space-x-1.5">
                                    <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                                    <span>Need {{ number_format(500 - $guest->points) }} more Pts</span>
                                </button>
                            @endif
                        @else
                            <a href="#cek-poin" 
                               class="w-full py-3 px-4 rounded-xl bg-stone-900 hover:bg-stone-800 text-white font-bold text-xs uppercase tracking-wider transition flex items-center justify-center space-x-1.5">
                                <span>Check Points & Redeem</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach

            <!-- Category 1.000 Pts Item (Free Room Stay) -->
            @foreach($redeemCatalog[1000]['items'] as $item)
                <div class="catalog-card catalog-tier-1000 md:col-span-2 lg:col-span-3 p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-[#FAF3E3] via-[#FFFDF9] to-[#F5EAD4] border-2 border-[#D4AF37] shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-3">
                        <div class="flex items-center space-x-2">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 uppercase tracking-widest font-serif">
                                {{ $item['badge'] }}
                            </span>
                            <span class="font-mono font-black text-sm text-[#8A6319]">1,000 Points</span>
                        </div>
                        <h4 class="font-serif font-black text-2xl text-stone-900">{{ $item['title'] }}</h4>
                        <p class="text-xs sm:text-sm text-stone-700 max-w-2xl leading-relaxed">{{ $item['detail'] }}</p>
                    </div>

                    <div class="shrink-0 text-right">
                        @if($guest)
                            @if($guest->points >= 1000)
                                <button type="button" 
                                        onclick="openRedeemModal('{{ $item['id'] }}', '{{ addslashes($item['title']) }}', 1000, '{{ addslashes($item['detail']) }}', {{ json_encode($item['options'] ?? []) }})"
                                        class="w-full md:w-auto px-8 py-3.5 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-serif font-bold text-xs uppercase tracking-wider shadow-lg transition flex items-center justify-center space-x-2">
                                    <i data-lucide="gift" class="w-4 h-4"></i>
                                    <span>Redeem (Complimentary 1-Night Stay)</span>
                                </button>
                            @else
                                <button type="button" disabled 
                                        class="w-full md:w-auto px-6 py-3 rounded-xl bg-[#EAE3D5] text-stone-500 font-bold text-xs cursor-not-allowed border border-[#D8C9AF] flex items-center justify-center space-x-2">
                                    <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                                    <span>Need {{ number_format(1000 - $guest->points) }} more Pts</span>
                                </button>
                            @endif
                        @else
                            <a href="#cek-poin" 
                               class="w-full md:w-auto px-8 py-3.5 rounded-xl bg-stone-900 hover:bg-stone-800 text-white font-serif font-bold text-xs uppercase tracking-wider transition flex items-center justify-center space-x-2">
                                <span>Access Account & Redeem</span>
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</section>

<!-- ======================================================== -->
<!-- 7. FAQ ACCORDION (FREQUENTLY ASKED QUESTIONS)        -->
<!-- ======================================================== -->
<section id="faq" class="py-16 sm:py-24 bg-[#FAF7F2] border-b border-[#E8DFC8]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-14 space-y-3">
            <span class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-[#F5EDDE] text-[#7A5210] border border-[#DEC8A4]">
                <i data-lucide="help-circle" class="w-3.5 h-3.5 text-[#B8860B]"></i>
                <span>Help & Information</span>
            </span>
            <h2 class="text-3xl sm:text-4xl font-serif font-black text-stone-900 tracking-tight">
                Frequently Asked Questions
            </h2>
            <p class="text-stone-700 text-sm sm:text-base leading-relaxed">
                Learn more about point accumulation rules, member tier privileges, and voucher redemption procedures.
            </p>
        </div>

        <div class="space-y-4">
            
            <!-- FAQ 1 -->
            <div class="faq-item rounded-2xl bg-[#FFFDF9] border border-[#E6DAC3] overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full px-6 py-4.5 text-left flex items-center justify-between text-sm sm:text-base font-bold text-stone-900 hover:text-[#8A6319] transition">
                    <span>How do I enroll in Senyum Stay Priority membership?</span>
                    <i data-lucide="chevron-down" id="faq-icon-1" class="w-4 h-4 text-[#8A6319] transition-transform duration-300"></i>
                </button>
                <div id="faq-content-1" class="hidden px-6 pb-5 pt-1 text-xs sm:text-sm text-stone-700 border-t border-[#E8DFC8] leading-relaxed">
                    Every guest reserving a room or holding an event at Grand Senyum Hotel Yogyakarta is automatically enrolled into <strong>Senyum Stay Priority</strong> with a unique member number (GSH-xxxx format). Simply enter your full name or mobile phone number in the search form above to verify your points and tier status.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="faq-item rounded-2xl bg-[#FFFDF9] border border-[#E6DAC3] overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full px-6 py-4.5 text-left flex items-center justify-between text-sm sm:text-base font-bold text-stone-900 hover:text-[#8A6319] transition">
                    <span>How many points do I earn from room stays and banquet events?</span>
                    <i data-lucide="chevron-down" id="faq-icon-2" class="w-4 h-4 text-[#8A6319] transition-transform duration-300"></i>
                </button>
                <div id="faq-content-2" class="hidden px-6 pb-5 pt-1 text-xs sm:text-sm text-stone-700 border-t border-[#E8DFC8] leading-relaxed">
                    Untuk reservasi kamar: Grand Deluxe (10 pts/malam), Grand Executive (15 pts/malam), Royal Suite (20 pts/malam), dan President Suite (30 pts/malam). Untuk pengadaan acara Banquet/Ballroom: Anda memperoleh +10 Points untuk setiap total revenue Rp 1.000.000,- (berlaku kelipatan).
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="faq-item rounded-2xl bg-[#FFFDF9] border border-[#E6DAC3] overflow-hidden">
                <button type="button" onclick="toggleFaq(3)" class="w-full px-6 py-4.5 text-left flex items-center justify-between text-sm sm:text-base font-bold text-stone-900 hover:text-[#8A6319] transition">
                    <span>Is there a maximum point accumulation limit for each tier?</span>
                    <i data-lucide="chevron-down" id="faq-icon-3" class="w-4 h-4 text-[#8A6319] transition-transform duration-300"></i>
                </button>
                <div id="faq-content-3" class="hidden px-6 pb-5 pt-1 text-xs sm:text-sm text-stone-700 border-t border-[#E8DFC8] leading-relaxed">
                    Ya, untuk menjaga eksklusivitas program: Member <strong>Silver</strong> memiliki batas maksimal 1,000 Points, Member <strong>Gold</strong> memiliki batas maksimal 5.000 Poin, dan Member <strong>Platinum</strong> memiliki batas akumulasi maksimal 10.000 Poin. Poin yang telah mendekati atau mencapai batas dapat ditukarkan terlebih dahulu dengan hadiah di katalog.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="faq-item rounded-2xl bg-[#FFFDF9] border border-[#E6DAC3] overflow-hidden">
                <button type="button" onclick="toggleFaq(4)" class="w-full px-6 py-4.5 text-left flex items-center justify-between text-sm sm:text-base font-bold text-stone-900 hover:text-[#8A6319] transition">
                    <span>How do I claim Tugu Station pick-up & E-Bike privileges?</span>
                    <i data-lucide="chevron-down" id="faq-icon-4" class="w-4 h-4 text-[#8A6319] transition-transform duration-300"></i>
                </button>
                <div id="faq-content-4" class="hidden px-6 pb-5 pt-1 text-xs sm:text-sm text-stone-700 border-t border-[#E8DFC8] leading-relaxed">
                    Complimentary Tugu Station transfers and 1-hour free E-Bike privileges are reserved for Gold and Platinum members. You may confirm your train arrival schedule with our Concierge team via official WhatsApp (+62 812-2555-5555) at least 24 hours prior to arrival.
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="faq-item rounded-2xl bg-[#FFFDF9] border border-[#E6DAC3] overflow-hidden">
                <button type="button" onclick="toggleFaq(5)" class="w-full px-6 py-4.5 text-left flex items-center justify-between text-sm sm:text-base font-bold text-stone-900 hover:text-[#8A6319] transition">
                    <span>How do I use my reward redemption E-Voucher?</span>
                    <i data-lucide="chevron-down" id="faq-icon-5" class="w-4 h-4 text-[#8A6319] transition-transform duration-300"></i>
                </button>
                <div id="faq-content-5" class="hidden px-6 pb-5 pt-1 text-xs sm:text-sm text-stone-700 border-t border-[#E8DFC8] leading-relaxed">
                    After successfully redeeming points in the catalog, the system issues an official E-Voucher with a unique code. Simply display the code on your smartphone or print the voucher when visiting the Front Desk or Grand Senyum Hotel restaurant.
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ======================================================== -->
<!-- 8. CONCIERGE & GRAND SENYUM HOTEL LOCATION                 -->
<!-- ======================================================== -->
<section class="py-16 sm:py-20 bg-gradient-to-b from-[#FAF7F2] to-[#FAF3E3]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="p-8 sm:p-12 rounded-3xl bg-[#1C1408] text-white border border-[#3D2C12] shadow-2xl flex flex-col lg:flex-row items-center justify-between gap-8 relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-[#D4AF37]/10 blur-3xl pointer-events-none"></div>

            <div class="space-y-4 max-w-2xl relative z-10 text-center lg:text-left">
                <span class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-amber-500/20 text-[#EBD195] border border-amber-500/30">
                    <i data-lucide="phone-call" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                    <span>24/7 Concierge Service</span>
                </span>
                <h3 class="text-2xl sm:text-4xl font-serif font-black text-white">
                    Need Assistance with Your Membership?
                </h3>
                <p class="text-xs sm:text-sm text-stone-300 leading-relaxed">
                    Grand Senyum Hotel reservation and Front Desk staff are at your service 24 hours a day for membership registration, station transfer bookings, and room reservations with tier discounts.
                </p>
            </div>

            <div class="shrink-0 flex flex-col sm:flex-row items-center gap-3 relative z-10">
                <a href="https://wa.me/{{ config('hotel.whatsapp') }}?text={{ urlencode('Hello Concierge Grand Senyum Hotel, I would like to inquire about hotel services and Senyum Stay Priority membership.') }}" target="_blank" rel="noopener noreferrer" 
                   class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] hover:brightness-105 text-slate-950 font-serif font-bold text-xs uppercase tracking-wider shadow-lg flex items-center justify-center space-x-2 transition">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>WhatsApp Concierge ({{ config('hotel.whatsapp_display') }})</span>
                </a>
                <a href="#cek-poin" 
                   class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-serif font-bold text-xs uppercase tracking-wider flex items-center justify-center space-x-2 transition">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    <span>Check Points Now</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ======================================================== -->
<!-- MODAL REDEEM CONFIRMATION    -->
<!-- ======================================================== -->
<div id="redeem-modal" class="fixed inset-0 z-50 hidden bg-stone-950/70 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-[#FFFDF9] rounded-3xl max-w-lg w-full p-6 sm:p-8 border border-[#E6DAC3] shadow-2xl relative">
        <button type="button" onclick="closeRedeemModal()" class="absolute top-5 right-5 w-8 h-8 rounded-full bg-[#FAF6EE] hover:bg-[#F5ECD8] text-stone-600 hover:text-stone-900 flex items-center justify-center transition border border-[#D8C9AF]">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>

        <div class="flex items-center space-x-3 mb-5">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-sm">
                <i data-lucide="gift" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#8A6319]">Senyum Stay Priority</span>
                <h3 class="font-serif font-black text-xl text-stone-900">Confirm Reward Redemption</h3>
            </div>
        </div>

        <form action="{{ route('guest.redeem') }}" method="POST" id="redeem-form" class="space-y-4">
            @csrf
            <input type="hidden" name="guest_id" value="{{ $guest->id ?? '' }}">
            <input type="hidden" name="item_id" id="modal-item-id" value="">

            <!-- Ringkasan Tamu & Saldo -->
            <div class="p-4 rounded-2xl bg-[#FAF6EE] border border-[#D8C9AF] text-xs space-y-2">
                <div class="flex justify-between">
                    <span class="text-stone-600">Member Name:</span>
                    <span class="font-bold text-stone-900">{{ $guest->name ?? '' }} ({{ $guest->member_number ?? '' }})</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">Current Point Balance:</span>
                    <span class="font-bold text-stone-900" id="modal-guest-points">{{ number_format($guest->points ?? 0) }} Pts</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">Redemption Cost:</span>
                    <span class="font-bold text-rose-600" id="modal-cost-points">-0 Pts</span>
                </div>
                <div class="pt-2 border-t border-[#D8C9AF] flex justify-between font-bold text-sm">
                    <span class="text-stone-800">Your Remaining Balance:</span>
                    <span class="text-[#8A6319]" id="modal-remaining-points">0 Pts</span>
                </div>
            </div>

            <!-- Detail Hadiah yang Dipilih -->
            <div class="p-4 rounded-2xl bg-[#FBF3E2] border border-[#DEC8A4]">
                <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] block">Selected Reward Item:</span>
                <h4 class="font-serif font-bold text-stone-900 text-base mt-0.5" id="modal-item-title"></h4>
                <p class="text-xs text-stone-700 mt-1 leading-relaxed" id="modal-item-detail"></p>
            </div>

            <!-- Varian Pilihan (Jika ada pilihan options) -->
            <div id="modal-options-wrapper" class="hidden">
                <label for="modal-selected-option" class="block text-xs font-bold uppercase tracking-wider text-stone-800 mb-1.5">
                    Select Merchandise / Reward Option:
                </label>
                <select name="selected_option" id="modal-selected-option" class="w-full px-4 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] outline-none text-stone-900 text-xs font-semibold">
                </select>
            </div>

            <!-- Catatan opsional -->
            <div>
                <label for="modal-notes" class="block text-xs font-bold uppercase tracking-wider text-stone-800 mb-1.5">
                    Additional Notes (Optional):
                </label>
                <input type="text" name="notes" id="modal-notes" placeholder="e.g. Pick up at hotel lobby in the afternoon" class="w-full px-4 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] outline-none text-stone-900 text-xs font-medium">
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-2 flex items-center justify-end space-x-3">
                <button type="button" onclick="closeRedeemModal()" class="px-5 py-2.5 rounded-xl border border-[#D8C9AF] font-bold text-stone-700 hover:bg-[#F5ECD8] text-xs transition">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] via-[#DFB85B] to-[#B8860B] hover:from-[#B8860B] hover:to-[#D4AF37] text-stone-950 font-serif font-bold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition flex items-center space-x-2">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>Yes, Redeem Points</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ======================================================== -->
<!-- MODAL VIEW E-VOUCHER (VOUCHER PREVIEW & PRINT)          -->
<!-- ======================================================== -->
<div id="voucher-modal" class="fixed inset-0 z-50 hidden bg-stone-950/70 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-[#FFFDF9] rounded-3xl max-w-md w-full p-6 sm:p-8 border border-[#E6DAC3] shadow-2xl relative">
        <button type="button" onclick="closeVoucherModal()" class="absolute top-5 right-5 w-8 h-8 rounded-full bg-[#FAF6EE] hover:bg-[#F5ECD8] text-stone-600 hover:text-stone-900 flex items-center justify-center transition border border-[#D8C9AF]">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>

        <div id="printable-voucher" class="p-6 rounded-2xl bg-gradient-to-b from-[#FAF3E3]/80 via-[#FFFDF9] to-[#FAF3E3]/50 border-2 border-dashed border-[#D4AF37] space-y-4 text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Grand Senyum Hotel" class="h-9 w-auto mx-auto object-contain">
            <div>
                <span class="text-[10px] uppercase font-bold tracking-widest text-[#8A6319]">Official Reward Redemption E-Voucher</span>
                <h3 class="font-serif font-black text-xl text-stone-900 mt-0.5">Senyum Stay Priority</h3>
            </div>

            <div class="py-3 px-4 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] shadow-sm">
                <span class="text-[10px] uppercase font-bold text-stone-600 block">Voucher Code</span>
                <span class="font-mono font-black text-2xl text-[#8A6319] tracking-wider block" id="preview-voucher-code"></span>
            </div>

            <div class="text-left space-y-2 text-xs py-2 border-y border-[#DEC8A4]">
                <div class="flex justify-between">
                    <span class="text-stone-600">Guest Name:</span>
                    <span class="font-bold text-stone-900">{{ $guest->name ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">Member Number:</span>
                    <span class="font-mono font-bold text-stone-900">{{ $guest->member_number ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">Redeemed Item:</span>
                    <span class="font-bold text-stone-900 text-right" id="preview-voucher-title"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">Details / Option:</span>
                    <span class="text-[#8A6319] font-semibold text-right" id="preview-voucher-detail"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">Points Cost:</span>
                    <span class="font-bold text-rose-600 text-right" id="preview-voucher-cost"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">Redemption Date:</span>
                    <span class="text-stone-800 text-right" id="preview-voucher-date"></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-stone-600">Voucher Status:</span>
                    <span class="font-bold text-[11px] px-2.5 py-0.5 rounded-full" id="preview-voucher-status"></span>
                </div>
            </div>

            <p class="text-[11px] text-stone-600 leading-relaxed">
                Present this e-voucher to Grand Senyum Hotel Reception / F&B staff when claiming your physical reward.
            </p>
        </div>

        <div class="mt-5 flex items-center justify-between gap-3">
            <button type="button" onclick="copyModalVoucherCode()" class="flex-1 py-2.5 px-4 rounded-xl bg-[#FAF6EE] hover:bg-[#F5ECD8] text-stone-800 font-bold text-xs transition flex items-center justify-center space-x-1.5 border border-[#D8C9AF]">
                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                <span>Copy Code</span>
            </button>
            <button type="button" onclick="window.print()" class="flex-1 py-2.5 px-4 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] hover:brightness-105 text-stone-950 font-bold text-xs uppercase tracking-wider transition flex items-center justify-center space-x-1.5 shadow-sm">
                <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                <span>Print Voucher</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal Lihat Detail Voucher Selesai -->

@push('scripts')
<script>
    const guestBalance = {{ $guest->points ?? 0 }};

    function validateHeroSearchForm() {
        const name = document.getElementById('name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const errMsg = document.getElementById('hero-search-error-msg');

        if (!name && !phone) {
            errMsg.innerText = 'Please enter guest full name OR mobile phone number to check points.';
            errMsg.classList.remove('hidden');
            return false;
        }

        errMsg.classList.add('hidden');
        return true;
    }

    // Modal Konfirmasi Penukaran Poin
    function openRedeemModal(itemId, title, pointsCost, detail, options) {
        document.getElementById('modal-item-id').value = itemId;
        document.getElementById('modal-item-title').innerText = title;
        document.getElementById('modal-item-detail').innerText = detail || '';
        document.getElementById('modal-cost-points').innerText = '-' + Number(pointsCost).toLocaleString('id-ID') + ' Pts';
        
        const remaining = Math.max(0, guestBalance - pointsCost);
        document.getElementById('modal-remaining-points').innerText = remaining.toLocaleString('id-ID') + ' Pts';

        // Tangani pilihan dropdown varian (jika ada)
        const optionsWrapper = document.getElementById('modal-options-wrapper');
        const selectEl = document.getElementById('modal-selected-option');
        selectEl.innerHTML = '';

        if (options && options.length > 0) {
            options.forEach(opt => {
                const optEl = document.createElement('option');
                optEl.value = opt;
                optEl.textContent = opt;
                selectEl.appendChild(optEl);
            });
            optionsWrapper.classList.remove('hidden');
        } else {
            optionsWrapper.classList.add('hidden');
        }

        document.getElementById('modal-notes').value = '';
        document.getElementById('redeem-modal').classList.remove('hidden');

        if (window.lucide) {
            lucide.createIcons();
        }
    }

    function closeRedeemModal() {
        document.getElementById('redeem-modal').classList.add('hidden');
    }

    // Modal View E-Voucher
    let currentModalVoucherCode = '';
    function viewVoucherModal(code, title, detail, cost, date, status) {
        currentModalVoucherCode = code;
        document.getElementById('preview-voucher-code').innerText = code;
        document.getElementById('preview-voucher-title').innerText = title;
        document.getElementById('preview-voucher-detail').innerText = detail || '-';
        document.getElementById('preview-voucher-cost').innerText = '-' + Number(cost).toLocaleString('id-ID') + ' Pts';
        document.getElementById('preview-voucher-date').innerText = date || '-';
        
        const statusEl = document.getElementById('preview-voucher-status');
        if (status === 'aktif') {
            statusEl.innerText = 'Active / Ready to Claim';
            statusEl.className = 'font-bold text-[11px] px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300';
        } else if (status === 'selesai') {
            statusEl.innerText = 'Redeemed';
            statusEl.className = 'font-bold text-[11px] px-2.5 py-0.5 rounded-full bg-stone-200 text-stone-700 border border-stone-300';
        } else {
            statusEl.innerText = status ? status.toUpperCase() : '-';
            statusEl.className = 'font-bold text-[11px] px-2.5 py-0.5 rounded-full bg-[#FAF3E3] text-amber-900 border border-[#DEC8A4]';
        }

        document.getElementById('voucher-modal').classList.remove('hidden');

        if (window.lucide) {
            lucide.createIcons();
        }
    }

    function closeVoucherModal() {
        document.getElementById('voucher-modal').classList.add('hidden');
    }

    function copyVoucherCode(code) {
        if (!code) return;
        navigator.clipboard.writeText(code).then(() => {
            alert('Voucher code ' + code + ' successfully copied to clipboard!');
        }).catch(() => {
            prompt('Copy the following voucher code:', code);
        });
    }

    function copyModalVoucherCode() {
        copyVoucherCode(currentModalVoucherCode);
    }

    // Catalog Filter Tabs (All / 100 / 500 / 1000)
    function filterCatalog(category) {
        const cards = document.querySelectorAll('.catalog-card');
        const tabs = document.querySelectorAll('.catalog-tab-btn');

        tabs.forEach(tab => {
            tab.className = "catalog-tab-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#FFFDF9] text-stone-700 hover:bg-[#F5ECD8] border border-[#DEC8A4] shadow-sm transition";
        });

        const activeTab = document.getElementById('catalog-tab-' + category);
        if (activeTab) {
            activeTab.className = "catalog-tab-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-stone-950 text-white shadow-md transition";
        }

        cards.forEach(card => {
            if (category === 'all') {
                card.classList.remove('hidden');
            } else {
                if (card.classList.contains('catalog-tier-' + category)) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            }
        });
    }

    // FAQ Accordion Toggle
    function toggleFaq(n) {
        const content = document.getElementById('faq-content-' + n);
        const icon = document.getElementById('faq-icon-' + n);
        if (!content) return;

        const isHidden = content.classList.contains('hidden');
        content.classList.toggle('hidden');

        if (icon) {
            icon.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
        }
    }

    // Drone Video Intro Controls
    function openDroneIntro(force = false) {
        const overlay = document.getElementById('drone-intro-overlay');
        const player = document.getElementById('drone-video-player');
        const fallback = document.getElementById('drone-video-fallback');

        if (!overlay) return;

        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        overlay.style.opacity = '0';
        setTimeout(() => {
            overlay.style.opacity = '1';
        }, 10);

        if (player) {
            player.currentTime = 0;
            const playPromise = player.play();
            if (playPromise !== undefined) {
                playPromise.catch(() => {
                    if (fallback) fallback.classList.remove('hidden');
                });
            }

            player.onerror = function() {
                if (fallback) fallback.classList.remove('hidden');
            };
        }

        if (window.lucide) {
            lucide.createIcons();
        }
    }

    function closeDroneIntro() {
        const overlay = document.getElementById('drone-intro-overlay');
        const player = document.getElementById('drone-video-player');

        if (player) {
            player.pause();
        }

        if (overlay) {
            overlay.style.opacity = '0';
            setTimeout(() => {
                overlay.classList.remove('flex');
                overlay.classList.add('hidden');
            }, 500);
        }

        sessionStorage.setItem('gsh_drone_seen', 'true');
    }

    function toggleDroneAudio() {
        const player = document.getElementById('drone-video-player');
        const btn = document.getElementById('audio-toggle-btn');
        if (!player || !btn) return;

        player.muted = !player.muted;
        btn.innerHTML = player.muted 
            ? '<i data-lucide="volume-x" class="w-4 h-4 text-amber-400"></i>' 
            : '<i data-lucide="volume-2" class="w-4 h-4 text-amber-400"></i>';

        if (window.lucide) {
            lucide.createIcons();
        }
    }

    // Inisialisasi awal
    document.addEventListener('DOMContentLoaded', function() {
        // Otomatis scroll mulus langsung ke Personalized Member Hub saat tamu dicek
        @if($guest)
            const hub = document.getElementById('member-hub');
            if (hub) {
                setTimeout(() => {
                    hub.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 120);
            }
        @endif

        // Munculkan video drone intro otomatis saat pertama kali dibuka jika belum pernah dilihat
        const searched = {{ $searched ? 'true' : 'false' }};
        const seen = sessionStorage.getItem('gsh_drone_seen');
        if (!searched && !seen) {
            openDroneIntro(false);
        }
    });
</script>
@endpush
@endsection
