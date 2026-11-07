@extends('layouts.app')

@section('title', 'Senyum Stay Priority - Grand Senyum Hotel Yogyakarta')

@section('content')
<!-- ======================================================== -->
<!-- DRONE VIDEO CINEMATIC INTRO OVERLAY (BEFORE LOGIN/SEARCH) -->
<!-- ======================================================== -->
<div id="drone-intro-overlay" class="fixed inset-0 z-[100] bg-black hidden flex-col justify-between overflow-hidden transition-opacity duration-700">
    <!-- Video Player Background -->
    <div class="absolute inset-0 w-full h-full overflow-hidden flex items-center justify-center bg-black">
        <video id="drone-video-player" 
               autoplay 
               muted 
               loop 
               playsinline 
               preload="auto"
               class="w-full h-full object-contain transition-all duration-700 ease-out brightness-[0.98] contrast-[1.04] saturate-[1.06]">
            <source src="{{ asset('videos/WhatsApp%20Video%202026-11-03%20at%2009.14.51.mp4') }}" type="video/mp4">
            <source src="{{ asset('videos/hotel-video.mp4') }}" type="video/mp4">
            <source src="{{ asset('videos/WhatsApp Video 2026-11-03 at 09.14.51.mp4') }}" type="video/mp4">
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

        <div class="flex items-center space-x-2.5">
            <!-- Video Scale Mode Toggle (Fit Utuh vs Fill Penuh) -->
            <button type="button" 
                    id="fit-toggle-btn" 
                    onclick="toggleDroneFit()" 
                    class="p-2.5 rounded-full bg-black/50 hover:bg-black/80 border border-white/20 text-white transition-all backdrop-blur-md shadow-lg"
                    title="Toggle Ukuran Video (Layar Utuh / Penuh)">
                <i data-lucide="maximize-2" id="fit-icon" class="w-4 h-4 text-[#d6ac57]"></i>
            </button>

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
            <span>{{ __('Grand Senyum Hotel Yogyakarta') }}</span>
            <span class="w-1.5 h-1.5 rounded-full bg-[#d6ac57]"></span>
            <span class="text-white/90">{{ __('VIP Member Club') }}</span>
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
                {{ __('An extraordinary stay experience blending exclusive comfort, point accumulation from room reservations & banquet revenue, and prestigious VIP rewards.') }}
            </p>
        </div>

        <!-- Tombol Masuk ke Portal (Montserrat Agak Bold, Bercahaya Emas & Berkelas) -->
        <div class="pt-1 flex flex-col sm:flex-row items-center justify-center gap-4 w-full">
            <button type="button" 
                    onclick="closeDroneIntro()" 
                    class="group w-full sm:w-auto px-10 py-4 rounded-full bg-gradient-to-r from-[#d6ac57] via-[#f5d78e] to-[#b38a36] hover:brightness-110 text-slate-950 font-sans font-semibold text-xs sm:text-sm tracking-[0.18em] uppercase shadow-[0_0_40px_rgba(214,172,87,0.6)] hover:shadow-[0_0_55px_rgba(214,172,87,0.85)] hover:scale-105 active:scale-95 transition-all duration-300 flex items-center justify-center space-x-3">
                <span>{{ __('Enter Member Portal Priority') }}</span>
                <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"></i>
            </button>
        </div>

        <!-- 3 Feature Badges (Agar Tidak Kosong & Lebih Estetik) -->
        <div class="flex flex-wrap items-center justify-center gap-2.5 pt-2 text-[11px] sm:text-xs text-white/90 font-sans font-medium tracking-wider">
            <span class="inline-flex items-center space-x-1.5 px-3.5 py-1.5 rounded-full bg-black/45 border border-white/20 backdrop-blur-md shadow-sm">
                <i data-lucide="award" class="w-3.5 h-3.5 text-[#d6ac57]"></i>
                <span>{{ __('Tiers: Silver • Gold • Platinum') }}</span>
            </span>
            <span class="inline-flex items-center space-x-1.5 px-3.5 py-1.5 rounded-full bg-black/45 border border-white/20 backdrop-blur-md shadow-sm">
                <i data-lucide="gift" class="w-3.5 h-3.5 text-[#d6ac57]"></i>
                <span>{{ __('Exclusive Rewards & E-Vouchers') }}</span>
            </span>
            <span class="inline-flex items-center space-x-1.5 px-3.5 py-1.5 rounded-full bg-black/45 border border-white/20 backdrop-blur-md shadow-sm">
                <i data-lucide="train" class="w-3.5 h-3.5 text-[#d6ac57]"></i>
                <span>{{ __('Complimentary Tugu Station Pick-up') }}</span>
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
                        <span>{{ __('Bespoke Loyalty Privilege') }}</span>
                    </span>
                    <button type="button" 
                            onclick="openDroneIntro(true)" 
                            class="inline-flex items-center space-x-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-white/10 hover:bg-white/20 text-white border border-white/20 transition backdrop-blur-md">
                        <i data-lucide="play" class="w-3 h-3 text-[#d6ac57] fill-[#d6ac57]"></i>
                        <span>{{ __('Play Hotel Video') }}</span>
                    </button>
                </div>

                <div class="space-y-4">
                    @if(app()->getLocale() === 'id')
                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-sans font-light tracking-[0.12em] sm:tracking-[0.16em] uppercase leading-snug text-white drop-shadow-[0_4px_20px_rgba(0,0,0,0.95)]">
                            Dunia Hak Istimewa <br class="hidden sm:inline">
                            <span class="gold-shimmer font-normal drop-shadow-[0_2px_12px_rgba(0,0,0,0.85)]">& Pengakuan Eksklusif</span>
                        </h1>
                        <p class="text-sm sm:text-base text-stone-100 max-w-xl mx-auto lg:mx-0 leading-relaxed font-sans font-normal tracking-[0.05em] drop-shadow-[0_2px_10px_rgba(0,0,0,0.9)]">
                            Selamat datang di <span class="text-white font-medium">Senyum Stay Priority</span>, program loyalitas bergengsi dari Grand Senyum Hotel Yogyakarta. Dapatkan reward nyata dari setiap reservasi kamar dan transaksi acara banquet, serta nikmati berbagai hak istimewa VIP eksklusif untuk kenyamanan Anda.
                        </p>
                    @else
                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-sans font-light tracking-[0.12em] sm:tracking-[0.16em] uppercase leading-snug text-white drop-shadow-[0_4px_20px_rgba(0,0,0,0.95)]">
                            A World of Bespoke <br class="hidden sm:inline">
                            <span class="gold-shimmer font-normal drop-shadow-[0_2px_12px_rgba(0,0,0,0.85)]">Privileges & Recognition</span>
                        </h1>
                        <p class="text-sm sm:text-base text-stone-100 max-w-xl mx-auto lg:mx-0 leading-relaxed font-sans font-normal tracking-[0.05em] drop-shadow-[0_2px_10px_rgba(0,0,0,0.9)]">
                            Welcome to <span class="text-white font-medium">Senyum Stay Priority</span>, the prestigious loyalty program by Grand Senyum Hotel Yogyakarta. Earn genuine rewards from every room stay and banquet event revenue, while enjoying bespoke VIP privileges crafted for your highest comfort.
                        </p>
                    @endif
                </div>

                <!-- Quick CTA Links -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-2">
                    <a href="#cek-poin" class="px-7 py-3.5 rounded-xl bg-gradient-to-r from-[#d6ac57] via-[#f5d78e] to-[#b38a36] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-lg hover:scale-105 transition-all duration-200 flex items-center space-x-2">
                        <i data-lucide="search" class="w-4 h-4 text-slate-950"></i>
                        <span>{{ __('Check Points') }}</span>
                    </a>
                </div>

                <!-- 3 Mini Highlights with Luxury Glass Card (Kontras Tinggi & Mudah Dibaca) -->
                <div class="mt-6 p-4 sm:p-5 rounded-2xl bg-black/65 backdrop-blur-md border border-amber-500/35 shadow-2xl">
                    <div class="grid grid-cols-3 gap-2 sm:gap-4 text-center lg:text-left divide-x divide-white/15">
                        <div class="px-1 sm:px-2">
                            <span class="font-serif font-black text-lg sm:text-2xl text-[#F5D78E] block tracking-tight drop-shadow-[0_2px_10px_rgba(0,0,0,0.9)]">Silver &bull; Gold</span>
                            <span class="text-[11px] sm:text-xs text-amber-100/90 font-medium tracking-wide block mt-1 drop-shadow">{{ app()->getLocale() === 'id' ? 'Hingga Tingkat Platinum' : 'Up to Platinum Tier' }}</span>
                        </div>
                        <div class="px-1 sm:px-2">
                            <span class="font-serif font-black text-lg sm:text-2xl text-[#F5D78E] block tracking-tight drop-shadow-[0_2px_10px_rgba(0,0,0,0.9)]">{{ app()->getLocale() === 'id' ? '+10 Poin' : '+10 Points' }}</span>
                            <span class="text-[11px] sm:text-xs text-amber-100/90 font-medium tracking-wide block mt-1 drop-shadow">{{ app()->getLocale() === 'id' ? 'Per Rp 1 Juta Revenue Acara' : 'Per IDR 1M Banquet Revenue' }}</span>
                        </div>
                        <div class="px-1 sm:px-2">
                            <span class="font-serif font-black text-lg sm:text-2xl text-[#F5D78E] block tracking-tight drop-shadow-[0_2px_10px_rgba(0,0,0,0.9)]">{{ app()->getLocale() === 'id' ? '10 – 30 Poin' : '10 – 30 Pts' }}</span>
                            <span class="text-[11px] sm:text-xs text-amber-100/90 font-medium tracking-wide block mt-1 drop-shadow">{{ app()->getLocale() === 'id' ? 'Per Malam Menginap Kamar' : 'Per Room Night Stay' }}</span>
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
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] block font-serif">{{ __('Registered Member Access') }}</span>
                                <h3 class="font-serif font-black text-lg text-stone-900">{{ __('Check Your Points & Privileges') }}</h3>
                            </div>
                        </div>

                        <form action="{{ route('guest.points') }}#member-hub" method="GET" class="space-y-3.5" id="heroSearchForm" onsubmit="return validateHeroSearchForm()">
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-stone-800 mb-1">
                                    <i data-lucide="user" class="w-3.5 h-3.5 inline mr-1 text-[#8A6319]"></i> {{ __('Guest Full Name') }}
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $searchName) }}" 
                                       placeholder="{{ __('Enter guest full name') }}" 
                                       class="w-full px-4 py-3 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] outline-none text-stone-900 text-sm transition font-medium">
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-stone-800 mb-1">
                                    <i data-lucide="phone" class="w-3.5 h-3.5 inline mr-1 text-[#8A6319]"></i> {{ __('Mobile Phone Number') }}
                                </label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', $searchPhone) }}" 
                                       placeholder="{{ __('e.g. 081234567890') }}" 
                                       class="w-full px-4 py-3 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] outline-none text-stone-900 text-sm transition font-medium">
                            </div>

                            <p id="hero-search-error-msg" class="hidden text-xs text-rose-600 font-semibold"></p>

                            <button type="submit" 
                                     class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#D4AF37] via-[#DFB85B] to-[#B8860B] hover:from-[#B8860B] hover:to-[#D4AF37] text-stone-950 font-serif font-bold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition-all flex items-center justify-center space-x-2">
                                <i data-lucide="search" class="w-4 h-4"></i>
                                <span>{{ __('Check Member Status & Points') }}</span>
                            </button>
                        </form>

                        @if($guest)
                            <div class="mt-3 p-3 rounded-xl bg-amber-50 border border-amber-200 text-xs flex items-center justify-between text-amber-900">
                                <div class="truncate">
                                    <span class="font-bold">{{ __('Active Member:') }}</span> {{ $guest->name }} ({{ $guest->tier }})
                                </div>
                                <a href="#member-hub" class="text-[11px] font-bold text-[#8A6319] hover:underline shrink-0 ml-2 flex items-center">
                                    <span>{{ __('View Details') }}</span>
                                    <i data-lucide="arrow-down" class="w-3 h-3 ml-0.5"></i>
                                </a>
                            </div>
                        @endif
                    </div>

                    @if($searched && $notFound)
                        <div class="mt-4 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-xs text-rose-800 space-y-1">
                            <p class="font-bold flex items-center"><i data-lucide="alert-circle" class="w-4 h-4 mr-1 text-rose-600"></i> {{ __('Guest Not Found') }}</p>
                            <p>{{ __('Name') }} "{{ $searchName }}" {{ __('or phone number') }} "{{ $searchPhone }}" {{ __('is not registered in our system. Please contact the Front Desk for new membership registration.') }}</p>
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
                    <span class="text-xs uppercase font-bold text-[#8A6319] tracking-wider font-serif">{{ __('Welcome Back') }}</span>
                    <h2 class="text-2xl sm:text-3xl font-serif font-black text-stone-900">
                        {{ $guest->name }}
                    </h2>
                    <p class="text-xs text-stone-600 mt-0.5">
                        {{ __('Member No:') }} <span class="font-mono font-bold text-[#8A6319]">{{ $guest->member_number }}</span> &bull; {{ __('Status:') }} <span class="font-bold text-stone-900">{{ $guest->tier }} {{ __('Member') }}</span>
                    </p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <a href="#cek-poin" class="px-4 py-2.5 rounded-xl bg-[#FAF6EE] hover:bg-[#F5ECD8] border border-[#D8C9AF] text-stone-700 text-xs font-bold transition flex items-center space-x-1.5">
                    <i data-lucide="search" class="w-3.5 h-3.5 text-[#8A6319]"></i>
                    <span>{{ __('Search Other Guest') }}</span>
                </a>
                <a href="{{ route('guest.catalog', ['lang' => app()->getLocale()]) }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 text-xs font-serif font-bold uppercase tracking-wider shadow-sm hover:brightness-105 transition flex items-center space-x-1.5">
                    <i data-lucide="gift" class="w-4 h-4"></i>
                    <span>{{ __('Redeem Points') }} ({{ number_format($guest->points) }} {{ app()->getLocale() === 'id' ? 'Poin' : 'Pts' }})</span>
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
                            {{ number_format($guest->points, 0, ',', '.') }} {{ app()->getLocale() === 'id' ? 'POIN' : 'PTS' }}
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
                            {{ app()->getLocale() === 'id' ? 'BERLAKU S/D' : 'VALID THRU' }} 11/27
                        </div>
                    </div>
                </div>

                <!-- Point Accumulation & Tier Cap Progress -->
                <div class="p-5 rounded-2xl bg-[#FAF6EE] border border-[#D8C9AF] text-xs space-y-3">
                    <div class="flex justify-between font-bold text-stone-900">
                        <span>{{ __('Accumulated Point Balance:') }}</span>
                        <span class="text-[#8A6319]">
                            {{ number_format($guest->points) }} / {{ number_format($guest->max_points) }} {{ app()->getLocale() === 'id' ? 'Poin' : 'Points' }}
                        </span>
                    </div>
                    <div class="w-full bg-[#E8DCC8] rounded-full h-3 p-0.5 overflow-hidden">
                        <div class="h-full rounded-full bg-gradient-to-r from-[#D4AF37] to-[#B8860B] transition-all duration-500" style="width: {{ $guest->points_percentage }}%"></div>
                    </div>
                    <p class="text-stone-700 text-xs">
                        {{ __('Tier range for') }} <strong>{{ $guest->tier }}</strong>: <strong>{{ app()->getLocale() === 'id' ? '( 0 – ' . number_format($guest->max_points, 0, ',', '.') . ' Poin )' : $guest->tier_config['range_label'] }}</strong> ({{ __('Maximum cap') }} {{ number_format($guest->max_points, 0, ',', '.') }} {{ app()->getLocale() === 'id' ? 'poin' : 'points' }}).
                    </p>
                    @if($guest->points >= $guest->max_points)
                        <div class="p-2.5 rounded-xl bg-amber-100 border border-amber-300 text-amber-950 font-semibold text-[11px] flex items-center space-x-2">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-amber-700 shrink-0"></i>
                            <span>{{ __('Maximum tier limit reached! Points will not increase further until upgraded to the next tier.') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: Active Benefits & Privileges Pass -->
            <div class="lg:col-span-7 space-y-6">
                <div class="p-6 rounded-3xl bg-gradient-to-br from-[#FAF3E3] via-[#FFFDF9] to-[#F5EAD4] border border-[#DEC8A4] shadow-sm">
                    <div class="flex items-center justify-between pb-3 border-b border-[#DEC8A4]">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] font-serif block">{{ __('Your Active Privileges') }}</span>
                            <h3 class="font-serif font-black text-xl text-stone-900">{{ __('Tier') }} {{ $guest->tier }} {{ __('Benefits') }}</h3>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#FAF6EE] text-[#7A5210] border border-[#DEC8A4]">
                            {{ count($guest->benefits) }} {{ __('Active Privileges') }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-4">
                        @foreach($guest->benefits as $benefit)
                            <div class="flex items-start space-x-2.5 p-2.5 rounded-xl bg-[#FFFDF9] border border-[#E8DFC8] text-xs font-medium text-stone-800">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
                                <span>{{ __($benefit) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- E-Voucher Wallet (Redemptions) -->
                @if($guest->redemptions->count() > 0)
                    <div class="p-6 rounded-3xl bg-[#FAF6EE] border border-[#D8C9AF]">
                        <div class="flex items-center justify-between mb-3 pb-2 border-b border-[#E8DFC8]">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] font-serif block">{{ __('E-Voucher Wallet') }}</span>
                                <h4 class="font-serif font-bold text-stone-900 text-base">{{ __('Your Reward Vouchers') }}</h4>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-[#EFE5D3] text-stone-800">
                                {{ $guest->redemptions->count() }} {{ __('Vouchers') }}
                            </span>
                        </div>

                        <div class="space-y-2.5">
                            @foreach($guest->redemptions as $rdm)
                                <div class="p-3.5 rounded-2xl bg-[#FFFDF9] border border-[#DEC8A4] flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <span class="font-mono font-bold text-sm text-[#8A6319]">{{ $rdm->voucher_code }}</span>
                                            @if($rdm->status === 'aktif')
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">{{ __('Active') }}</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-stone-200 text-stone-700">{{ __('Redeemed') }}</span>
                                            @endif
                                        </div>
                                        <p class="font-bold text-stone-900 mt-1">{{ __($rdm->item_title) }}</p>
                                        @if($rdm->selected_option)
                                            <p class="text-[11px] text-[#8A6319]">{{ __('Option:') }} {{ __($rdm->selected_option) }}</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-2 shrink-0">
                                        <button type="button" 
                                                onclick="viewVoucherModal('{{ $rdm->voucher_code }}', '{{ addslashes(__($rdm->item_title)) }}', '{{ addslashes($rdm->selected_option ? __($rdm->selected_option) : ($rdm->item_detail ? __($rdm->item_detail) : '')) }}', {{ $rdm->points_cost }}, '{{ $rdm->redeemed_at ? $rdm->redeemed_at->translatedFormat('d M Y, H:i') : $rdm->created_at->translatedFormat('d M Y') }}', '{{ $rdm->status }}')"
                                                class="px-3 py-1.5 rounded-xl bg-stone-950 text-amber-300 font-bold hover:bg-stone-800 transition flex items-center space-x-1.5 shadow-sm text-xs">
                                            <i data-lucide="ticket" class="w-3.5 h-3.5"></i>
                                            <span>{{ __('View E-Voucher') }}</span>
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
                    <span class="text-xs uppercase font-serif tracking-widest text-[#8A6319] font-bold">{{ __('Accumulation History') }}</span>
                    <h3 class="font-serif font-black text-stone-900 text-lg">{{ __('Your Reservation & Point Records') }}</h3>
                </div>
                <span class="text-xs text-stone-600 font-medium">
                    {{ __('Total:') }} {{ $guest->stays->count() }} {{ __('Transactions') }}
                </span>
            </div>

            @if($guest->stays->count() > 0)
                <div class="overflow-x-auto rounded-2xl border border-[#D8C9AF]">
                    <table class="w-full text-left text-xs sm:text-sm text-stone-700">
                        <thead class="bg-[#F5EDE0] text-xs uppercase tracking-wider text-stone-900 border-b border-[#D8C9AF] font-bold">
                            <tr>
                                <th class="px-5 py-3.5">{{ __('Date') }}</th>
                                <th class="px-5 py-3.5">{{ __('Booking Code') }}</th>
                                <th class="px-5 py-3.5">{{ __('Category') }}</th>
                                <th class="px-5 py-3.5">{{ __('Details') }}</th>
                                <th class="px-5 py-3.5 text-right">{{ __('Points Earned') }}</th>
                                <th class="px-5 py-3.5">{{ __('Notes') }}</th>
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
                                                {{ __('Banquet Revenue') }}
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
                                            {{ $stay->nights }} {{ __('Night(s)') }}
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-right font-bold text-[#8A6319] whitespace-nowrap">
                                        +{{ number_format($stay->points_added) }} Pts
                                    </td>
                                    <td class="px-5 py-4 text-xs text-stone-600">
                                        {{ $stay->notes ?: __('Recorded automatically') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-stone-600">
                    <p class="font-medium text-xs">{{ __('No transaction records found for this member account yet.') }}</p>
                </div>
            @endif
        </div>

    </div>
</section>
@endif

<!-- ======================================================== -->
<!-- 3. EXPLORE PROGRAM SECTIONS (DEDICATED PAGES HUB)       -->
<!-- ======================================================== -->
<section class="py-16 sm:py-24 border-b border-[#E8DFC8] bg-[#FAF7F2]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-[#F5EDDE] text-[#7A5210] border border-[#DEC8A4]">
                <i data-lucide="compass" class="w-3.5 h-3.5 text-[#B8860B]"></i>
                <span>{{ __('Explore Program Features') }}</span>
            </span>
            <h2 class="text-3xl sm:text-4xl font-serif font-black text-stone-900 tracking-tight">
                {{ __('Everything About Senyum Stay Priority') }}
            </h2>
            <p class="text-stone-700 text-sm sm:text-base leading-relaxed">
                {{ __('Select a section below to explore complete details for each loyalty privilege on its dedicated page.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- 1. About Priority Card -->
            <a href="{{ route('guest.about', ['lang' => app()->getLocale()]) }}" class="group p-7 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] hover:border-[#D4AF37] hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-5">
                <div class="space-y-4">
                    <div class="w-13 h-13 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md group-hover:scale-110 transition-transform">
                        <i data-lucide="gem" class="w-6 h-6"></i>
                    </div>
                    <span class="inline-block text-[10px] uppercase font-bold tracking-widest text-[#8A6319] font-serif">{{ __('Philosophy & Location') }}</span>
                    <h3 class="font-serif font-black text-xl text-stone-900 group-hover:text-[#8A6319] transition">{{ __('About Senyum Stay') }}</h3>
                    <p class="text-xs sm:text-sm text-stone-700 leading-relaxed">
                        {{ __('Three core pillars of refined Yogyakarta hospitality near Tugu & Malioboro. Discover our philosophy and privileges.') }}
                    </p>
                </div>
                <div class="pt-3 border-t border-[#E8DFC8] flex items-center justify-between text-xs font-bold text-[#8A6319]">
                    <span>{{ __('Explore About Page') }}</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                </div>
            </a>

            <!-- 2. Membership Tiers Card -->
            <a href="{{ route('guest.tiers', ['lang' => app()->getLocale()]) }}" class="group p-7 rounded-3xl bg-[#FFFDF9] border-2 border-[#D4AF37]/50 hover:border-[#D4AF37] hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-5 relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-gradient-to-l from-[#d6ac57] to-[#b38a36] text-slate-950 font-serif font-bold text-[9px] uppercase tracking-widest px-3.5 py-0.5 rounded-bl-xl shadow-sm">
                    {{ __('VIP Tiers') }}
                </div>
                <div class="space-y-4">
                    <div class="w-13 h-13 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md group-hover:scale-110 transition-transform">
                        <i data-lucide="award" class="w-6 h-6"></i>
                    </div>
                    <span class="inline-block text-[10px] uppercase font-bold tracking-widest text-[#8A6319] font-serif">{{ app()->getLocale() === 'id' ? 'Tingkatan VIP Silver • Gold • Platinum' : 'Silver • Gold • Platinum VIP' }}</span>
                    <h3 class="font-serif font-black text-xl text-stone-900 group-hover:text-[#8A6319] transition">{{ __('Membership Tiers & Privileges') }}</h3>
                    <p class="text-xs sm:text-sm text-stone-700 leading-relaxed">
                        {{ __('Digital VIP physical cards, up to IDR 100,000 stay discounts, Tugu Station transfers, free laundry, and 5g pure gold grand prize.') }}
                    </p>
                </div>
                <div class="pt-3 border-t border-[#DEC8A4] flex items-center justify-between text-xs font-bold text-[#8A6319]">
                    <span>{{ __('View Membership Tiers') }}</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                </div>
            </a>

            <!-- 3. How to Earn Points Card -->
            <a href="{{ route('guest.earn', ['lang' => app()->getLocale()]) }}" class="group p-7 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] hover:border-[#D4AF37] hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-5">
                <div class="space-y-4">
                    <div class="w-13 h-13 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md group-hover:scale-110 transition-transform">
                        <i data-lucide="calculator" class="w-6 h-6"></i>
                    </div>
                    <span class="inline-block text-[10px] uppercase font-bold tracking-widest text-[#8A6319] font-serif">{{ __('Room & Banquet Events') }}</span>
                    <h3 class="font-serif font-black text-xl text-stone-900 group-hover:text-[#8A6319] transition">{{ __('How to Earn Points') }}</h3>
                    <p class="text-xs sm:text-sm text-stone-700 leading-relaxed">
                        {{ __('Earn 10 to 30 points per room night and +10 points for every IDR 1,000,000 in meeting & banquet revenue.') }}
                    </p>
                </div>
                <div class="pt-3 border-t border-[#E8DFC8] flex items-center justify-between text-xs font-bold text-[#8A6319]">
                    <span>{{ __('View Earning Rules') }}</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                </div>
            </a>

            <!-- 4. Rewards Catalog Card -->
            <a href="{{ route('guest.catalog', ['lang' => app()->getLocale()]) }}" class="group p-7 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] hover:border-[#D4AF37] hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-5">
                <div class="space-y-4">
                    <div class="w-13 h-13 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md group-hover:scale-110 transition-transform">
                        <i data-lucide="gift" class="w-6 h-6"></i>
                    </div>
                    <span class="inline-block text-[10px] uppercase font-bold tracking-widest text-[#8A6319] font-serif">{{ app()->getLocale() === 'id' ? '100 • 500 • 1.000 Poin' : '100 • 500 • 1,000 Points' }}</span>
                    <h3 class="font-serif font-black text-xl text-stone-900 group-hover:text-[#8A6319] transition">{{ __('Rewards Catalog') }}</h3>
                    <p class="text-xs sm:text-sm text-stone-700 leading-relaxed">
                        {{ __('Redeem points for official GSH merchandise souvenirs, dining vouchers, electric bicycle rentals, or complimentary 1-night stays.') }}
                    </p>
                </div>
                <div class="pt-3 border-t border-[#E8DFC8] flex items-center justify-between text-xs font-bold text-[#8A6319]">
                    <span>{{ __('Browse Rewards Catalog') }}</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                </div>
            </a>

            <!-- 5. FAQ Card -->
            <a href="{{ route('guest.faq', ['lang' => app()->getLocale()]) }}" class="group p-7 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] hover:border-[#D4AF37] hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-5 md:col-span-2 lg:col-span-2">
                <div class="space-y-4">
                    <div class="w-13 h-13 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md group-hover:scale-110 transition-transform">
                        <i data-lucide="help-circle" class="w-6 h-6"></i>
                    </div>
                    <span class="inline-block text-[10px] uppercase font-bold tracking-widest text-[#8A6319] font-serif">{{ __('Guest Guide & Help') }}</span>
                    <h3 class="font-serif font-black text-xl text-stone-900 group-hover:text-[#8A6319] transition">{{ __('Frequently Asked Questions') }}</h3>
                    <p class="text-xs sm:text-sm text-stone-700 leading-relaxed">
                        {{ __('Frequently asked questions regarding membership enrollment, point validity, tier caps, station pick-up requests, and official e-vouchers.') }}
                    </p>
                </div>
                <div class="pt-3 border-t border-[#E8DFC8] flex items-center justify-between text-xs font-bold text-[#8A6319]">
                    <span>{{ __('Open FAQ & Help Center') }}</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                </div>
            </a>

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
                    <span>{{ __('24/7 Concierge Service') }}</span>
                </span>
                <h3 class="text-2xl sm:text-4xl font-serif font-black text-white">
                    {{ __('Need Assistance with Your Membership?') }}
                </h3>
                <p class="text-xs sm:text-sm text-stone-300 leading-relaxed">
                    {{ __('Grand Senyum Hotel reservation and Front Desk staff are at your service 24 hours a day for membership registration, station transfer bookings, and room reservations with tier discounts.') }}
                </p>
            </div>

            <div class="shrink-0 flex flex-col sm:flex-row items-center gap-3 relative z-10">
                <a href="https://wa.me/{{ config('hotel.whatsapp') }}?text={{ urlencode('Hello Concierge Grand Senyum Hotel, I would like to inquire about hotel services and Senyum Stay Priority membership.') }}" target="_blank" rel="noopener noreferrer" 
                   class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] hover:brightness-105 text-slate-950 font-serif font-bold text-xs uppercase tracking-wider shadow-lg flex items-center justify-center space-x-2 transition">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>{{ __('WhatsApp Concierge') }} ({{ config('hotel.whatsapp_display') }})</span>
                </a>
                <a href="#cek-poin" 
                   class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-serif font-bold text-xs uppercase tracking-wider flex items-center justify-center space-x-2 transition">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    <span>{{ __('Check Points Now') }}</span>
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
                <h3 class="font-serif font-black text-xl text-stone-900">{{ __('Confirm Reward Redemption') }}</h3>
            </div>
        </div>

        <form action="{{ route('guest.redeem') }}" method="POST" id="redeem-form" class="space-y-4">
            @csrf
            <input type="hidden" name="guest_id" value="{{ $guest->id ?? '' }}">
            <input type="hidden" name="item_id" id="modal-item-id" value="">

            <!-- Ringkasan Tamu & Saldo -->
            <div class="p-4 rounded-2xl bg-[#FAF6EE] border border-[#D8C9AF] text-xs space-y-2">
                <div class="flex justify-between">
                    <span class="text-stone-600">{{ __('Member Name:') }}</span>
                    <span class="font-bold text-stone-900">{{ $guest->name ?? '' }} ({{ $guest->member_number ?? '' }})</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">{{ __('Current Point Balance:') }}</span>
                    <span class="font-bold text-stone-900" id="modal-guest-points">{{ number_format($guest->points ?? 0) }} {{ app()->getLocale() === 'id' ? 'Poin' : 'Pts' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">{{ __('Redemption Cost:') }}</span>
                    <span class="font-bold text-rose-600" id="modal-cost-points">-0 {{ app()->getLocale() === 'id' ? 'Poin' : 'Pts' }}</span>
                </div>
                <div class="pt-2 border-t border-[#D8C9AF] flex justify-between font-bold text-sm">
                    <span class="text-stone-800">{{ __('Your Remaining Balance:') }}</span>
                    <span class="text-[#8A6319]" id="modal-remaining-points">0 {{ app()->getLocale() === 'id' ? 'Poin' : 'Pts' }}</span>
                </div>
            </div>

            <!-- Detail Hadiah yang Dipilih -->
            <div class="p-4 rounded-2xl bg-[#FBF3E2] border border-[#DEC8A4]">
                <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] block">{{ __('Selected Reward Item:') }}</span>
                <h4 class="font-serif font-bold text-stone-900 text-base mt-0.5" id="modal-item-title"></h4>
                <p class="text-xs text-stone-700 mt-1 leading-relaxed" id="modal-item-detail"></p>
            </div>

            <!-- Varian Pilihan (Jika ada pilihan options) -->
            <div id="modal-options-wrapper" class="hidden">
                <label for="modal-selected-option" class="block text-xs font-bold uppercase tracking-wider text-stone-800 mb-1.5">
                    {{ __('Select Merchandise / Reward Option:') }}
                </label>
                <select name="selected_option" id="modal-selected-option" class="w-full px-4 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] outline-none text-stone-900 text-xs font-semibold">
                </select>
            </div>

            <!-- Catatan opsional -->
            <div>
                <label for="modal-notes" class="block text-xs font-bold uppercase tracking-wider text-stone-800 mb-1.5">
                    {{ __('Additional Notes (Optional):') }}
                </label>
                <input type="text" name="notes" id="modal-notes" placeholder="{{ __('e.g. Pick up at hotel lobby in the afternoon') }}" class="w-full px-4 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] outline-none text-stone-900 text-xs font-medium">
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-2 flex items-center justify-end space-x-3">
                <button type="button" onclick="closeRedeemModal()" class="px-5 py-2.5 rounded-xl border border-[#D8C9AF] font-bold text-stone-700 hover:bg-[#F5ECD8] text-xs transition">
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] via-[#DFB85B] to-[#B8860B] hover:from-[#B8860B] hover:to-[#D4AF37] text-stone-950 font-serif font-bold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition flex items-center space-x-2">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>{{ __('Yes, Redeem Points') }}</span>
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
                <span class="text-[10px] uppercase font-bold tracking-widest text-[#8A6319]">{{ __('Official Reward Redemption E-Voucher') }}</span>
                <h3 class="font-serif font-black text-xl text-stone-900 mt-0.5">Senyum Stay Priority</h3>
            </div>

            <div class="py-3 px-4 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] shadow-sm">
                <span class="text-[10px] uppercase font-bold text-stone-600 block">{{ __('Voucher Code') }}</span>
                <span class="font-mono font-black text-2xl text-[#8A6319] tracking-wider block" id="preview-voucher-code"></span>
            </div>

            <div class="text-left space-y-2 text-xs py-2 border-y border-[#DEC8A4]">
                <div class="flex justify-between">
                    <span class="text-stone-600">{{ __('Guest Name:') }}</span>
                    <span class="font-bold text-stone-900">{{ $guest->name ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">{{ __('Member Number:') }}</span>
                    <span class="font-mono font-bold text-stone-900">{{ $guest->member_number ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">{{ __('Redeemed Item:') }}</span>
                    <span class="font-bold text-stone-900 text-right" id="preview-voucher-title"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">{{ __('Details / Option:') }}</span>
                    <span class="text-[#8A6319] font-semibold text-right" id="preview-voucher-detail"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">{{ __('Points Cost:') }}</span>
                    <span class="font-bold text-rose-600 text-right" id="preview-voucher-cost"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-600">{{ __('Redemption Date:') }}</span>
                    <span class="text-stone-800 text-right" id="preview-voucher-date"></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-stone-600">{{ __('Voucher Status:') }}</span>
                    <span class="font-bold text-[11px] px-2.5 py-0.5 rounded-full" id="preview-voucher-status"></span>
                </div>
            </div>

            <p class="text-[11px] text-stone-600 leading-relaxed">
                {{ __('Present this e-voucher to Grand Senyum Hotel Reception / F&B staff when claiming your physical reward.') }}
            </p>
        </div>

        <div class="mt-5 flex items-center justify-between gap-3">
            <button type="button" onclick="copyModalVoucherCode()" class="flex-1 py-2.5 px-4 rounded-xl bg-[#FAF6EE] hover:bg-[#F5ECD8] text-stone-800 font-bold text-xs transition flex items-center justify-center space-x-1.5 border border-[#D8C9AF]">
                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                <span>{{ __('Copy Code') }}</span>
            </button>
            <button type="button" onclick="window.print()" class="flex-1 py-2.5 px-4 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] hover:brightness-105 text-stone-950 font-bold text-xs uppercase tracking-wider transition flex items-center justify-center space-x-1.5 shadow-sm">
                <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                <span>{{ __('Print Voucher') }}</span>
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
            errMsg.innerText = "{{ __('Please enter guest full name OR mobile phone number to check points.') }}";
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
            statusEl.innerText = "{{ __('Active / Ready to Claim') }}";
            statusEl.className = 'font-bold text-[11px] px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300';
        } else if (status === 'selesai') {
            statusEl.innerText = "{{ __('Redeemed') }}";
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

    function toggleDroneFit() {
        const player = document.getElementById('drone-video-player');
        const btn = document.getElementById('fit-toggle-btn');
        if (!player || !btn) return;

        const isContain = player.classList.contains('object-contain');
        if (isContain) {
            player.classList.remove('object-contain');
            player.classList.add('object-cover');
            btn.innerHTML = '<i data-lucide="minimize-2" class="w-4 h-4 text-[#d6ac57]"></i>';
            btn.title = "Kembalikan ke Layar Utuh (Fit)";
        } else {
            player.classList.remove('object-cover');
            player.classList.add('object-contain');
            btn.innerHTML = '<i data-lucide="maximize-2" class="w-4 h-4 text-[#d6ac57]"></i>';
            btn.title = "Penuhi Layar (Fill)";
        }

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
