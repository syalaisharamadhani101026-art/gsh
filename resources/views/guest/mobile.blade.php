<!DOCTYPE html>
<html lang="id" class="h-full bg-[#FAF7F2] text-stone-800 antialiased selection:bg-amber-500 selection:text-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#FAF7F2">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <title>{{ $guest ? $guest->name . ' - ' : '' }}Senyum Stay Priority Mobile | Grand Senyum Hotel</title>

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

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- QRCode.js CDN for live QR generation on VIP card -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <style>
        * {
            font-family: 'Montserrat', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        /* Custom subtle scrollbar */
        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }
        ::-webkit-scrollbar-track {
            background: #FAF7F2;
        }
        ::-webkit-scrollbar-thumb {
            background: #d6ac57;
            border-radius: 4px;
        }

        .gold-shimmer {
            background: linear-gradient(90deg, #d6ac57 0%, #FFF3D1 50%, #b38a36 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .gold-shimmer-light {
            background: linear-gradient(90deg, #d6ac57 0%, #FFF3D1 50%, #b38a36 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* 3D Metallic Cards on Cream Background */
        .gold-metal-card {
            background: linear-gradient(135deg, #1C1408 0%, #2F210C 35%, #423013 70%, #150E04 100%);
            box-shadow: 0 15px 35px -5px rgba(184, 134, 11, 0.3), 0 0 1px 1px rgba(214, 172, 87, 0.5);
        }

        .silver-metal-card {
            background: linear-gradient(135deg, #15181E 0%, #232833 35%, #353B49 70%, #0F1217 100%);
            box-shadow: 0 15px 35px -5px rgba(160, 174, 192, 0.3), 0 0 1px 1px rgba(203, 213, 225, 0.5);
        }

        .platinum-metal-card {
            background: linear-gradient(135deg, #0D0E1A 0%, #1A1C30 35%, #2B2E4E 70%, #080911 100%);
            box-shadow: 0 15px 35px -5px rgba(147, 112, 219, 0.35), 0 0 1px 1px rgba(199, 170, 255, 0.5);
        }

        /* Refined Warm Luxury Cream Panels */
        .luxury-panel {
            background: #FFFDF9;
            border: 1px solid #E8DFC8;
            box-shadow: 0 4px 20px -2px rgba(138, 99, 25, 0.05);
        }

        .luxury-panel-warm {
            background: #FAF6EE;
            border: 1px solid #DEC8A4;
        }

        .luxury-tab-bar {
            background: rgba(255, 253, 249, 0.96);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-top: 1px solid #E8DFC8;
            box-shadow: 0 -4px 20px rgba(138, 99, 25, 0.06);
        }

        /* Desktop outer background (matches web gradient) */
        @media (min-width: 768px) {
            body {
                background: linear-gradient(180deg, #FAF7F2 0%, #F7F2E8 50%, #F1EAD9 100%);
            }
        }

        /* ======================================================== */
        /* IPHONE 17 PRO SIMULATOR STYLING (Desert Titanium)        */
        /* ======================================================== */
        @media (min-width: 768px) {
            .iphone-17-pro-wrapper {
                position: relative;
                max-width: 428px;
                margin: 24px auto 40px;
                filter: drop-shadow(0 25px 50px rgba(28, 20, 8, 0.45)) drop-shadow(0 0 35px rgba(214, 172, 87, 0.15));
            }

            /* iPhone 17 Pro Titanium Hardware Buttons */
            .iphone-hw-btn {
                position: absolute;
                background: linear-gradient(180deg, #6B5B4E, #3D332A, #251F19);
                border: 1px solid rgba(214, 172, 87, 0.35);
                border-radius: 4px;
                z-index: 5;
            }
            /* Action Button (Left Top) */
            .iphone-hw-action {
                left: -4px;
                top: 110px;
                width: 4px;
                height: 28px;
            }
            /* Volume Up (Left Mid-Top) */
            .iphone-hw-vol-up {
                left: -4px;
                top: 155px;
                width: 4px;
                height: 52px;
            }
            /* Volume Down (Left Mid-Bottom) */
            .iphone-hw-vol-down {
                left: -4px;
                top: 220px;
                width: 4px;
                height: 52px;
            }
            /* Power / Side Button (Right Top) */
            .iphone-hw-power {
                right: -4px;
                top: 170px;
                width: 4px;
                height: 75px;
            }
            /* Camera Control Button (Right Lower - Capacitive Sensor) */
            .iphone-hw-camera-control {
                right: -3px;
                top: 480px;
                width: 3px;
                height: 60px;
                border-radius: 3px;
                background: linear-gradient(180deg, #52463B, #2A231C);
                border: 1px solid rgba(214, 172, 87, 0.3);
            }

            /* Main iPhone 17 Pro Body */
            .mobile-frame-mode {
                max-width: 428px;
                height: 890px;
                max-height: 90vh;
                border-radius: 54px;
                /* Natural/Desert Titanium Ultra-Slim Bezel */
                border: 11px solid #000000;
                outline: 3.5px solid #5A4C3E;
                box-shadow: 0 0 0 1px #9A8A78, inset 0 0 0 1px rgba(255, 255, 255, 0.15);
                overflow: hidden;
                position: relative;
                display: flex;
                flex-direction: column;
                background: #FAF7F2;
            }

            /* Scoped tab bar inside the iPhone 17 Pro frame */
            .mobile-frame-mode .luxury-tab-bar {
                position: absolute !important;
                bottom: 0;
                left: 0;
                right: 0;
            }

            /* Scoped bottom sheet modals inside the iPhone frame */
            .mobile-frame-mode .mobile-modal-sheet {
                position: absolute !important;
                border-radius: 44px 44px 0 0;
            }
        }

        /* Dynamic Island Pill */
        .dynamic-island {
            width: 122px;
            height: 32px;
            background: #000000;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 60;
            pointer-events: none;
            user-select: none;
        }
        .di-camera {
            width: 11px;
            height: 11px;
            border-radius: 9999px;
            background: radial-gradient(circle at 35% 35%, #182638 0%, #06090f 70%);
            border: 1px solid #1c2738;
            box-shadow: inset 0 0 2px rgba(0, 150, 255, 0.35);
        }
        .di-sensor {
            width: 7px;
            height: 7px;
            border-radius: 9999px;
            background: #0d0a08;
        }
    
    </style>
</head>
<body class="bg-[#FAF7F2] text-stone-800 flex flex-col min-h-screen">

    <!-- TOP LUXURY UTILITY BAR (Identik dengan versi Web Desktop) -->
    <div class="hidden md:block bg-[#1C1408] text-[#EBD195] text-[11px] py-2 px-4 border-b border-[#3D2C12] tracking-wider z-50">
        <div class="max-w-full mx-auto flex flex-col sm:flex-row items-center justify-between gap-1.5">
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
                <a href="https://wa.me/{{ config('hotel.whatsapp') }}?text={{ urlencode('Halo Concierge Grand Senyum Hotel, saya ingin bertanya tentang layanan hotel dan member Senyum Stay Priority.') }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition flex items-center space-x-1 font-semibold text-[#D4AF37]">
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

    <!-- DESKTOP TOP BAR (Only visible on wide desktop viewports) -->
    <aside class="hidden md:flex items-center justify-between px-6 py-2.5 bg-[#FFFDF9] border-b border-[#E8DFC8] text-xs text-stone-700 z-50">
        <div class="flex items-center space-x-3">
            <span class="inline-flex items-center space-x-1.5 text-[#8A6319] font-bold">
                <i data-lucide="smartphone" class="w-4 h-4 text-[#D4AF37]"></i>
                <span>iPhone 17 Pro Simulator</span>
            </span>
            <span class="text-stone-300">|</span>
            <span class="text-[11px] text-stone-500">Matching Grand Senyum Luxury Web Theme</span>
        </div>
        <div class="flex items-center space-x-3">
            <button type="button" onclick="openMobileIntro(true)" class="px-3 py-1 rounded-lg bg-amber-50 hover:bg-amber-100 text-[#8A6319] border border-amber-300 transition flex items-center space-x-1.5 font-semibold">
                <i data-lucide="play" class="w-3.5 h-3.5 text-[#D4AF37] fill-[#D4AF37]"></i>
                <span>Play Hotel Video</span>
            </button>
            <button type="button" onclick="toggleDesktopDeviceFrame()" id="frameToggleBtn" class="px-3 py-1 rounded-lg bg-[#FAF6EE] hover:bg-[#F2ECE1] text-stone-700 border border-[#DEC8A4] transition flex items-center space-x-1.5 font-medium">
                <i data-lucide="monitor" class="w-3.5 h-3.5"></i>
                <span id="frameToggleLabel">Full Width Screen</span>
            </button>
            <a href="{{ route('guest.points') }}" class="px-3 py-1 rounded-lg bg-[#FAF6EE] hover:bg-[#F2ECE1] text-stone-700 border border-[#DEC8A4] transition flex items-center space-x-1.5 font-medium">
                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                <span>Desktop Web View</span>
            </a>
        </div>
    </aside>

    <!-- IPHONE 17 PRO WRAPPER & SHELL (Desktop Frame Mode) -->
    <div id="phoneDeviceShell" class="iphone-17-pro-wrapper flex-1 md:flex-initial">
        <!-- iPhone 17 Pro Hardware Buttons (Desktop Only) -->
        <div class="hidden md:block iphone-hw-btn iphone-hw-action" title="Action Button"></div>
        <div class="hidden md:block iphone-hw-btn iphone-hw-vol-up" title="Volume Up"></div>
        <div class="hidden md:block iphone-hw-btn iphone-hw-vol-down" title="Volume Down"></div>
        <div class="hidden md:block iphone-hw-btn iphone-hw-power" title="Side Button"></div>
        <div class="hidden md:block iphone-hw-btn iphone-hw-camera-control" title="Camera Control (Capacitive)"></div>

        <!-- MAIN MOBILE APP CONTAINER (Screen of iPhone 17 Pro) -->
        <div id="mobileAppContainer" class="mobile-frame-mode flex-1 flex flex-col bg-[#FAF7F2] relative">

            <!-- DYNAMIC ISLAND (iPhone 17 Pro Signature) -->
            <div class="dynamic-island">
                <div class="di-sensor"></div>
                <div class="di-camera"></div>
            </div>

            <!-- ======================================================== -->
            <!-- CINEMATIC VIDEO INTRO OVERLAY (INSIDE IPHONE 17 PRO SCREEN) -->
            <!-- Ukuran FULL se-HP saja, tidak se-layar web desktop         -->
            <!-- ======================================================== -->
            <div id="mobile-drone-overlay" class="absolute inset-0 z-50 bg-black hidden flex-col justify-between overflow-hidden transition-opacity duration-700 md:rounded-[44px]" style="opacity:0">
                <!-- Video Player Background -->
                <div class="absolute inset-0 w-full h-full overflow-hidden">
                    <video id="mobile-drone-player" 
                           autoplay 
                           muted 
                           loop 
                           playsinline 
                           preload="auto"
                           class="w-full h-full object-cover scale-105 transition-transform duration-1000 ease-out brightness-[0.98] contrast-[1.04] saturate-[1.06]">
                        <source src="{{ asset('videos/TV PROMO - Tanpa Wording.mp4') }}" type="video/mp4">
                        <source src="{{ asset('videos/Grand Senyum Hotel.mp4') }}" type="video/mp4">
                        <source src="{{ asset('videos/compro.mp4') }}" type="video/mp4">
                        <source src="{{ asset('videos/building.MP4') }}" type="video/mp4">
                        <source src="{{ asset('videos/drone.mp4') }}" type="video/mp4">
                    </video>

                    <!-- Vignette & Luxury Gradient Overlays -->
                    <div class="absolute inset-x-0 top-0 h-36 bg-gradient-to-b from-black/80 via-black/30 to-transparent pointer-events-none"></div>
                    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(0,0,0,0.35)_0%,_transparent_75%)] pointer-events-none"></div>
                    <div class="absolute inset-0 bg-gradient-to-tr from-[#1A1206]/15 via-transparent to-[#2A1C06]/10 pointer-events-none"></div>
                    <div class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-t from-black/80 via-transparent to-transparent pointer-events-none"></div>

                    <!-- Fallback saat video tidak tersedia -->
                    <div id="mobile-drone-fallback" class="hidden absolute inset-0 bg-gradient-to-br from-slate-950 via-zinc-900 to-amber-950/40 flex items-center justify-center p-6 text-center">
                        <div class="max-w-xs p-5 rounded-3xl bg-black/60 backdrop-blur-md border border-amber-500/30 text-white space-y-3 shadow-2xl">
                            <i data-lucide="video" class="w-10 h-10 text-amber-400 mx-auto animate-pulse"></i>
                            <h3 class="font-sans font-semibold text-base text-amber-300 tracking-wider">Grand Senyum Hotel</h3>
                            <p class="text-xs text-slate-300 leading-relaxed font-light">Senyum Stay Priority — Program Loyalitas VIP</p>
                        </div>
                    </div>
                </div>

                <!-- Top Floating Bar: Logo & Controls (Padded down under Dynamic Island) -->
                <div class="relative z-20 px-4 pt-12 pb-3 flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Grand Senyum Hotel" class="h-9 w-auto object-contain drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]">
                        <div class="border-l border-white/20 pl-2">
                            <span class="text-[9px] uppercase font-sans font-bold tracking-[0.2em] text-[#d6ac57] block drop-shadow">
                                Grand Senyum
                            </span>
                            <span class="text-[7.5px] tracking-[0.14em] text-white/80 block uppercase font-light">
                                Senyum Stay Priority
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button type="button"
                                onclick="toggleIntroAudio()" 
                                id="intro-audio-btn" 
                                class="p-2 rounded-full bg-black/50 hover:bg-black/80 border border-white/20 text-white transition-all backdrop-blur-md shadow-lg"
                                title="Nyalakan / Matikan Suara Video">
                            <i data-lucide="volume-x" id="intro-audio-icon" class="w-3.5 h-3.5 text-[#d6ac57]"></i>
                        </button>
                    </div>
                </div>

                <!-- Exact Center Cinematic Callout & CTA (Form Factor iPhone) -->
                <div class="relative z-20 my-auto px-5 py-2 max-w-sm mx-auto flex flex-col items-center justify-center text-center space-y-4">
                    <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full text-[9px] font-sans font-medium tracking-[0.2em] uppercase bg-black/60 text-[#f5d78e] border border-[#d6ac57]/50 backdrop-blur-md shadow-2xl">
                        <i data-lucide="crown" class="w-3 h-3 text-[#d6ac57]"></i>
                        <span>Grand Senyum Yogyakarta</span>
                        <span class="w-1 h-1 rounded-full bg-[#d6ac57]"></span>
                        <span class="text-white/90">VIP Member</span>
                    </div>

                    <div class="space-y-3 w-full flex flex-col items-center">
                        <h2 class="flex flex-col items-center justify-center text-center font-sans font-bold text-white uppercase drop-shadow-[0_4px_24px_rgba(0,0,0,0.85)] w-full">
                            <span class="block text-2xl tracking-[0.22em] leading-none text-white">SENYUM STAY</span>
                            <span class="block mt-2 text-xl tracking-[0.34em] gold-shimmer font-bold leading-none">PRIORITY</span>
                        </h2>

                        <div class="flex items-center justify-center space-x-3 w-full max-w-[200px] mx-auto">
                            <div class="h-px bg-gradient-to-r from-transparent via-[#d6ac57]/70 to-transparent flex-1"></div>
                            <div class="w-1.5 h-1.5 rotate-45 bg-[#d6ac57] shadow-[0_0_8px_#d6ac57]"></div>
                            <div class="h-px bg-gradient-to-r from-transparent via-[#d6ac57]/70 to-transparent flex-1"></div>
                        </div>

                        <p class="text-[11px] text-stone-200 max-w-[280px] mx-auto font-sans font-normal tracking-[0.04em] leading-relaxed drop-shadow">
                            Exclusive experiences, room &amp; banquet points accumulation, and premier VIP rewards.
                        </p>
                    </div>

                    <button type="button"
                            onclick="closeMobileIntro()" 
                            class="group w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-[#d6ac57] via-[#f5d78e] to-[#b38a36] hover:brightness-110 text-slate-950 font-sans font-bold text-xs tracking-[0.16em] uppercase shadow-[0_0_35px_rgba(214,172,87,0.55)] active:scale-95 transition-all duration-300 flex items-center justify-center space-x-2">
                        <span>Enter Member Portal</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1"></i>
                    </button>

                    <div class="flex flex-wrap items-center justify-center gap-1.5 text-[9px] text-white/90 font-medium">
                        <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full bg-black/50 border border-white/20 backdrop-blur-md">
                            <i data-lucide="award" class="w-2.5 h-2.5 text-[#d6ac57]"></i>
                            <span>Tiers: Silver &bull; Gold &bull; Platinum</span>
                        </span>
                        <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full bg-black/50 border border-white/20 backdrop-blur-md">
                            <i data-lucide="train" class="w-2.5 h-2.5 text-[#d6ac57]"></i>
                            <span>Complimentary Tugu Shuttle</span>
                        </span>
                    </div>
                </div>

                <!-- Bottom Home Bar Indicator inside Video -->
                <div class="relative z-20 pb-3 flex justify-center">
                    <div class="w-32 h-1 bg-white/70 rounded-full"></div>
                </div>
            </div>

            <!-- IPHONE 17 PRO STATUS BAR (Flanking Dynamic Island) -->
            <div class="pt-3 px-7 pb-2.5 flex items-center justify-between text-[11px] font-semibold select-none bg-[#FFFDF9] border-b border-[#E8DFC8] z-30 relative">
                <span id="mobileClock" class="font-bold tracking-tight text-stone-900 text-xs">09:41</span>
                <!-- Spacer for Dynamic Island -->
                <div class="w-28 h-6"></div>
                <div class="flex items-center space-x-1.5 text-stone-800">
                    <span class="text-[8.5px] font-extrabold tracking-tighter text-stone-700 mr-0.5">5G</span>
                    <i data-lucide="signal" class="w-3.5 h-3.5 text-stone-900"></i>
                    <i data-lucide="wifi" class="w-3.5 h-3.5 text-stone-900"></i>
                    <div class="w-5 h-2.5 rounded-[4px] border border-stone-800 p-0.5 flex items-center">
                        <div class="h-full w-full bg-stone-900 rounded-[2px]"></div>
                    </div>
                </div>
            </div>

            <!-- TOP LUXURY MOBILE APP HEADER (Matches Web Nav) -->
        <header class="sticky top-0 z-40 px-4 py-3 bg-[#FFFDF9]/95 border-b border-[#E8DFC8] backdrop-blur-md flex items-center justify-between shadow-sm">
            <!-- Brand Logo & Hotel Crest -->
            <a href="{{ route('guest.mobile') }}" class="flex items-center space-x-2.5 group">
                <img src="{{ asset('images/logo.png') }}" alt="Grand Senyum" class="h-9 w-auto object-contain drop-shadow-sm">
                <div class="border-l border-[#DECFAe] pl-2.5">
                    <span class="text-[11px] font-bold tracking-[0.2em] text-[#8A6319] uppercase block leading-none font-serif">
                        SENYUM STAY
                    </span>
                    <span class="text-[8px] tracking-[0.22em] text-stone-500 uppercase block font-semibold">
                        PRIORITY MOBILE
                    </span>
                </div>
            </a>

            <!-- Quick Header Actions -->
            <div class="flex items-center space-x-1.5">
                <!-- Play Intro Video Button -->
                <button type="button"
                        onclick="openMobileIntro(true)" 
                        class="p-2 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] hover:bg-[#F2ECE1] text-[#8A6319] transition shadow-sm"
                        title="Play Hotel Video">
                    <i data-lucide="play" class="w-4 h-4 text-[#D4AF37] fill-[#D4AF37]"></i>
                </button>

                <!-- Search / Switch Profile Button -->
                <button type="button"
                        onclick="openSearchModal()" 
                        class="p-2 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] hover:bg-[#F2ECE1] text-[#8A6319] transition shadow-sm"
                        title="Search Guest / Switch Profile">
                    <i data-lucide="user-check" class="w-4 h-4"></i>
                </button>

                <!-- WhatsApp Concierge Direct -->
                <a href="https://wa.me/{{ config('hotel.whatsapp') }}?text={{ urlencode('Halo Concierge Grand Senyum Hotel, saya member Senyum Stay Priority.') }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="p-2 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-700 hover:bg-emerald-100 transition shadow-sm"
                   title="WhatsApp Concierge {{ config('hotel.whatsapp_display') }}">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                </a>
            </div>
        </header>

        <!-- FLASH NOTIFICATIONS -->
        @if(session('success') || session('redeem_success'))
            <div class="mx-4 mt-3 p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 shadow-sm text-emerald-900 text-xs flex items-start space-x-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                <div class="flex-1">
                    @if(session('redeem_success'))
                        <p class="font-bold text-stone-900 text-sm">Reward Redeemed Successfully!</p>
                        <p class="mt-0.5 text-stone-700">E-Voucher Code: <span class="font-mono font-bold text-[#8A6319] bg-amber-100 px-1.5 py-0.5 rounded">{{ session('redeem_success')['voucher_code'] }}</span></p>
                        <p class="text-[11px] text-emerald-700 mt-1">Item: {{ session('redeem_success')['item_title'] }}</p>
                    @else
                        <p class="font-medium">{{ session('success') }}</p>
                    @endif
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-stone-400 hover:text-stone-700">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-4 mt-3 p-3.5 rounded-2xl bg-rose-50 border border-rose-200 shadow-sm text-rose-900 text-xs flex items-start space-x-3">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5"></i>
                <div class="flex-1">
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-stone-400 hover:text-stone-700">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        <!-- SCROLLABLE MOBILE CONTENT AREA -->
        <main class="flex-1 overflow-y-auto px-4 py-4 pb-28 space-y-5">

            <!-- ============================================== -->
            <!-- TAB 1: BERANDA / HOME                          -->
            <!-- ============================================== -->
            <section id="tab-home" class="tab-pane space-y-5">

                <!-- 1. DASHBOARD OPENING VIDEO BANNER (CINEMATIC HOTEL REEL) -->
                <div class="relative rounded-3xl overflow-hidden border border-[#DEC8A4] shadow-md bg-[#1C1408] text-white">
                    <!-- Embedded Looping Video Element -->
                    <div class="relative w-full aspect-[16/9] sm:aspect-[21/9] overflow-hidden bg-black">
                        <video id="dashboardOpeningVideo" 
                               autoplay 
                               muted 
                               loop 
                               playsinline 
                               preload="auto"
                               poster="{{ asset('images/hero-building.jpg') }}"
                               class="w-full h-full object-cover scale-105 brightness-[0.95] contrast-[1.05]">
                            <source src="{{ asset('videos/TV PROMO - Tanpa Wording.mp4') }}" type="video/mp4">
                            <source src="{{ asset('videos/Grand Senyum Hotel.mp4') }}" type="video/mp4">
                            <source src="{{ asset('videos/compro.mp4') }}" type="video/mp4">
                            <source src="{{ asset('videos/building.MP4') }}" type="video/mp4">
                            <source src="{{ asset('videos/drone.mp4') }}" type="video/mp4">
                        </video>

                        <!-- Subtle Vignette & Gradient for High Text Readability -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-black/40 pointer-events-none"></div>

                        <!-- Video Interactive Floating Controls -->
                        <div class="absolute top-2.5 right-2.5 z-20 flex items-center space-x-1.5">
                            <!-- Audio Toggle -->
                            <button type="button"
                                    onclick="toggleDashboardVideoAudio()" 
                                    id="dashVideoAudioBtn" 
                                    class="p-1.5 rounded-full bg-black/60 hover:bg-black/80 text-amber-300 border border-white/20 backdrop-blur-sm transition"
                                    title="Video Audio">
                                <i data-lucide="volume-x" id="dashVideoAudioIcon" class="w-3.5 h-3.5"></i>
                            </button>
                            <!-- Fullscreen / Open Overlay -->
                            <button type="button"
                                    onclick="openMobileIntro(true)" 
                                    class="p-1.5 rounded-full bg-black/60 hover:bg-black/80 text-white border border-white/20 backdrop-blur-sm transition"
                                    title="Open Fullscreen">
                                <i data-lucide="maximize-2" class="w-3.5 h-3.5 text-[#d6ac57]"></i>
                            </button>
                        </div>

                        <!-- Live Video Badge on Top Left -->
                        <div class="absolute top-2.5 left-2.5 z-20 flex items-center space-x-1.5 px-2.5 py-1 rounded-full bg-black/60 border border-white/20 backdrop-blur-sm text-[9px] uppercase tracking-wider font-bold text-[#f5d78e]">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span>
                            <span>Hotel Reel</span>
                        </div>

                        <!-- Video Overlay Caption / Callout -->
                        <div class="absolute inset-x-0 bottom-0 p-3.5 z-20 space-y-1">
                            <span class="text-[9px] uppercase font-bold tracking-[0.2em] text-[#f5d78e] block font-serif">
                                VIP MEMBER CLUB
                            </span>
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-bold tracking-wide text-white uppercase drop-shadow font-serif">
                                    Senyum Stay Priority
                                </h3>
                                <button type="button" 
                                        onclick="openMobileIntro(true)" 
                                        class="text-[10px] text-amber-200 hover:text-white flex items-center space-x-1 font-semibold underline">
                                    <span>Full Video</span>
                                    <i data-lucide="chevron-right" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @if($guest)
                    <!-- VIP GUEST GREETING (Matches Web Styling) -->
                    <div class="flex items-center justify-between pt-1">
                        <div>
                            <span class="text-[10px] uppercase font-bold tracking-widest text-[#8A6319] block font-serif">
                                Verified Membership Status
                            </span>
                            <h2 class="text-lg font-bold text-stone-900 tracking-wide flex items-center space-x-2">
                                <span>Welcome, {{ $guest->name }}</span>
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                            </h2>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $guest->tier === 'Platinum' ? 'bg-indigo-50 text-indigo-900 border-indigo-200' : ($guest->tier === 'Gold' ? 'bg-amber-100 text-[#8A6319] border-amber-300' : 'bg-slate-100 text-slate-800 border-slate-300') }}">
                            Tier {{ $guest->tier }}
                        </span>
                    </div>

                    @php
                        $tier = $guest->tier;
                        $cardImage = match($tier) {
                            'Gold' => 'cards/card-gold.jpg',
                            'Platinum' => 'cards/card-platinum.jpg',
                            default => 'cards/card-silver.jpg',
                        };
                        $cardBorder = match($tier) {
                            'Gold' => 'border-2 border-[#d6ac57] shadow-amber-950/30',
                            'Platinum' => 'border-2 border-amber-400/40 shadow-stone-900/40',
                            default => 'border border-slate-300 shadow-slate-900/20',
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

                    <!-- Official Physical-Style VIP Digital Card (Matches Desktop Web) -->
                    <div class="relative w-full rounded-3xl overflow-hidden aspect-[1011/639] shadow-2xl transition-all duration-300 hover:scale-[1.01] active:scale-[0.99] {{ $cardBorder }} group select-none">
                        <img src="{{ asset('images/' . $cardImage) }}" alt="{{ $tier }} VIP Card" class="absolute inset-0 w-full h-full object-cover">

                        <!-- Top Right: Points Balance Pill Badge -->
                        <div class="absolute right-[4%] top-[5.5%] z-10">
                            <span class="px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold uppercase tracking-wider bg-black/60 backdrop-blur-md text-[#d6ac57] border border-[#d6ac57]/40 shadow-lg">
                                {{ number_format($guest->points, 0, ',', '.') }} PTS
                            </span>
                        </div>

                        <!-- Dynamic Customer Name & Member Number Overlay -->
                        <div class="absolute left-[5.5%] top-[65.2%] text-left pointer-events-none select-none z-10">
                            <div class="text-[12px] sm:text-[14px] font-sans font-semibold tracking-[0.08em] uppercase {{ $nameColor }} leading-tight drop-shadow-sm truncate max-w-[240px]">
                                {{ $guest->name }}
                            </div>
                            <div class="text-[14px] sm:text-[17px] font-sans font-semibold tracking-[0.14em] {{ $numColor }} mt-1 leading-tight drop-shadow-sm">
                                {{ $guest->member_number }}
                            </div>
                            <div class="text-[9px] sm:text-[10px] font-sans font-light tracking-[0.06em] {{ $valColor }} mt-1.5 sm:mt-2 leading-tight">
                                VALID THRU 11/27
                            </div>
                        </div>
                    </div>

                    <!-- Point Accumulation & Tier Cap Progress (Matches Desktop Web) -->
                    <div class="p-4 rounded-2xl bg-[#FAF6EE] border border-[#D8C9AF] text-xs space-y-2.5">
                        <div class="flex justify-between font-bold text-stone-900">
                            <span>Accumulated Points Balance:</span>
                            <span class="text-[#8A6319]">
                                {{ number_format($guest->points, 0, ',', '.') }} / {{ number_format($guest->max_points, 0, ',', '.') }} Points
                            </span>
                        </div>
                        <div class="w-full bg-[#E8DCC8] rounded-full h-2.5 p-0.5 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-[#D4AF37] to-[#B8860B] transition-all duration-500" style="width: {{ $guest->points_percentage }}%"></div>
                        </div>
                        <p class="text-stone-700 text-[11px]">
                            Tier range for <strong>{{ $guest->tier }}</strong>: <strong>{{ $guest->tier_config['range_label'] }}</strong> (Maximum limit {{ number_format($guest->max_points) }} points).
                        </p>
                        @if($guest->points >= $guest->max_points)
                            <div class="p-2 rounded-xl bg-amber-100 border border-amber-300 text-amber-950 font-semibold text-[10px] flex items-center space-x-1.5">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 text-amber-700 shrink-0"></i>
                                <span>Tier point limit reached! Upgrade your tier to accumulate more points.</span>
                            </div>
                        @endif
                    </div>

                    <!-- 4 QUICK ACTION BUTTONS (Warm Cream Luxury) -->
                    <div class="grid grid-cols-4 gap-2 text-center select-none">
                        <!-- Redeem -->
                        <button type="button" onclick="switchTab('katalog')" class="p-2.5 rounded-2xl bg-[#FFFDF9] border border-[#DEC8A4] hover:border-[#8A6319] active:scale-95 transition flex flex-col items-center space-y-1.5 shadow-sm">
                            <div class="w-9 h-9 rounded-xl bg-amber-100/80 text-[#8A6319] flex items-center justify-center">
                                <i data-lucide="gift" class="w-4 h-4"></i>
                            </div>
                            <span class="text-[10px] font-bold text-stone-800">Redeem</span>
                        </button>

                        <!-- History -->
                        <button type="button" onclick="switchTab('riwayat')" class="p-2.5 rounded-2xl bg-[#FFFDF9] border border-[#DEC8A4] hover:border-[#8A6319] active:scale-95 transition flex flex-col items-center space-y-1.5 shadow-sm">
                            <div class="w-9 h-9 rounded-xl bg-amber-100/80 text-[#8A6319] flex items-center justify-center">
                                <i data-lucide="receipt" class="w-4 h-4"></i>
                            </div>
                            <span class="text-[10px] font-bold text-stone-800">Historyts</span>
                        </button>

                        <!-- Shuttle Tugu -->
                        <button type="button" onclick="openTuguBookingModal()" class="p-2.5 rounded-2xl bg-[#FFFDF9] border border-[#DEC8A4] hover:border-[#8A6319] active:scale-95 transition flex flex-col items-center space-y-1.5 shadow-sm">
                            <div class="w-9 h-9 rounded-xl bg-amber-100/80 text-[#8A6319] flex items-center justify-center">
                                <i data-lucide="train" class="w-4 h-4"></i>
                            </div>
                            <span class="text-[10px] font-bold text-stone-800">Shuttle</span>
                        </button>

                        <!-- Simulator -->
                        <button type="button" onclick="switchTab('simulasi')" class="p-2.5 rounded-2xl bg-[#FFFDF9] border border-[#DEC8A4] hover:border-[#8A6319] active:scale-95 transition flex flex-col items-center space-y-1.5 shadow-sm">
                            <div class="w-9 h-9 rounded-xl bg-amber-100/80 text-[#8A6319] flex items-center justify-center">
                                <i data-lucide="calculator" class="w-4 h-4"></i>
                            </div>
                            <span class="text-[10px] font-bold text-stone-800">Calculatorts</span>
                        </button>
                    </div>

                    <!-- ACTIVE VOUCHERS PREVIEW (If Any) -->
                    @php
                        $activeVouchers = $guest->redemptions->where('status', 'aktif');
                    @endphp
                    @if($activeVouchers->count() > 0)
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold text-[#8A6319] uppercase tracking-wider text-[11px] flex items-center space-x-1.5">
                                    <i data-lucide="ticket" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                                    <span>Active Reward Vouchers ({{ $activeVouchers->count() }})</span>
                                </span>
                                <button type="button" onclick="switchTab('riwayat', 'vouchers')" class="text-[10px] text-stone-600 hover:text-stone-900 font-semibold">View All</button>
                            </div>

                            @foreach($activeVouchers->take(2) as $voucher)
                                <div class="p-3.5 rounded-2xl bg-gradient-to-r from-[#FFFDF9] to-[#FAF3E3] border border-amber-300 text-stone-900 flex items-center justify-between space-x-3 shadow-sm">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-xl bg-amber-200/80 text-[#8A6319] flex items-center justify-center shrink-0 font-bold">
                                            <i data-lucide="gift" class="w-5 h-5"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-xs font-bold text-stone-900">{{ $voucher->item_title }}</h4>
                                            <p class="text-[10px] text-stone-600 font-mono mt-0.5">Code: <strong class="text-[#8A6319]">{{ $voucher->voucher_code }}</strong></p>
                                        </div>
                                    </div>
                                    <button type="button" onclick="copyText('{{ $voucher->voucher_code }}', 'Voucher code copied!')" class="px-3 py-1.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-[10px] shrink-0 shadow-sm">
                                        Copy
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- TIER BENEFITS HIGHLIGHT -->
                    <div class="luxury-panel rounded-2xl p-4 space-y-3">
                        <div class="flex items-center justify-between border-b border-[#E8DFC8] pb-2">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-stone-900 flex items-center space-x-2 font-serif">
                                <i data-lucide="sparkles" class="w-4 h-4 text-[#D4AF37]"></i>
                                <span>{{ $guest->tier }} Tier Privileges</span>
                            </h3>
                            <button type="button" onclick="switchTab('kartu')" class="text-[10px] text-[#8A6319] font-bold hover:underline">Details</button>
                        </div>
                        <ul class="space-y-2 text-xs text-stone-700">
                            @foreach(array_slice($tiers[$guest->tier]['benefits'], 0, 4) as $benefit)
                                <li class="flex items-center space-x-2.5">
                                    <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600 shrink-0"></i>
                                    <span class="text-[11px] font-medium">{{ $benefit }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                @else
                    <!-- UNSEARCHED / GUEST WELCOME STATE (Cream & Gold) -->
                    <div class="text-center py-4 px-2 space-y-3">
                        <div class="flex items-center justify-center mx-auto">
                            <img src="{{ asset('images/logo.png') }}" alt="Grand Senyum Hotel" class="h-16 w-auto object-contain drop-shadow-sm">
                        </div>
                        <div class="space-y-1">
                            <h2 class="text-xl font-bold text-stone-900 tracking-wide uppercase font-serif">
                                Senyum Stay Priority
                            </h2>
                            <p class="text-xs text-stone-600 max-w-xs mx-auto leading-relaxed">
                                Access your digital VIP card, track points from room & banquet stays, and redeem exclusive reward e-vouchers.
                            </p>
                        </div>

                                            <!-- WHEEL OF FORTUNE BANNER (Annual Lucky Draw 5g Gold) -->
                    <div class="luxury-panel rounded-2xl p-4 bg-gradient-to-br from-[#FFFDF9] via-[#FAF3E3] to-[#F3E5C8] border-2 border-[#D4AF37] space-y-2 relative overflow-hidden shadow-sm">
                        <div class="flex items-center space-x-2.5">
                            <div class="w-8 h-8 rounded-xl bg-[#1e1709] text-[#F5DE93] flex items-center justify-center shrink-0">
                                <i data-lucide="sparkles" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <span class="text-[9px] uppercase font-bold tracking-widest text-[#7A5210] block font-serif">Annual Lucky Draw</span>
                                <h4 class="text-xs font-serif font-black text-stone-900 leading-tight">Wheel of Fortune</h4>
                            </div>
                        </div>
                        <p class="text-[11px] font-semibold text-stone-800 leading-snug">
                            Earn a minimum of 5,000 points for a chance to win a 5-gram gold prize!
                        </p>
                        <p class="text-[9px] italic text-stone-600">
                            *The lucky draw takes place at the end of each year.
                        </p>
                    </div>

                        <!-- FAST LOOKUP FORM -->
                        <div class="luxury-panel rounded-3xl p-5 text-left space-y-3.5 shadow-sm">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-[#8A6319] flex items-center space-x-1.5 font-serif">
                                <i data-lucide="search" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                                <span>Check Your Points & Privileges</span>
                            </h3>

                            <form action="{{ route('guest.mobile') }}" method="GET" class="space-y-3">
                                <div>
                                    <label class="block text-[10px] uppercase font-bold text-stone-700 mb-1">Mobile Phone Number</label>
                                    <input type="tel" 
                                           name="phone" 
                                           value="{{ old('phone', $searchPhone) }}" 
                                           placeholder="e.g. 081234567890" 
                                           class="w-full px-3.5 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] focus:bg-white focus:border-[#8A6319] text-stone-900 text-xs outline-none transition font-medium">
                                </div>
                                <div>
                                    <label class="block text-[10px] uppercase font-bold text-stone-700 mb-1">Or Guest Full Name</label>
                                    <input type="text" 
                                           name="name" 
                                           value="{{ old('name', $searchName) }}" 
                                           placeholder="Enter guest full name" 
                                           class="w-full px-3.5 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] focus:bg-white focus:border-[#8A6319] text-stone-900 text-xs outline-none transition font-medium">
                                </div>

                                <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-md hover:brightness-105 active:scale-95 transition flex items-center justify-center space-x-2">
                                    <i data-lucide="sparkles" class="w-3.5 h-3.5 text-amber-950"></i>
                                    <span>Access Member Portal</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- HOTEL PRIVILEGES (Harmonious with Web) -->
                <div class="space-y-3 pt-1">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-stone-800 flex items-center space-x-2 font-serif">
                        <i data-lucide="award" class="w-4 h-4 text-[#D4AF37]"></i>
                        <span>Grand Senyum Stay Privileges</span>
                    </h3>

                    <div class="space-y-2.5">
                        <div class="p-3.5 rounded-2xl luxury-panel flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-[#8A6319] flex items-center justify-center shrink-0">
                                <i data-lucide="train" class="w-5 h-5"></i>
                            </div>
                            <div class="text-xs">
                                <h4 class="font-bold text-stone-900">Complimentary Tugu Station Shuttle</h4>
                                <p class="text-[10px] text-stone-600">Free pick-up & drop-off service for Gold & Platinum members.</p>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl luxury-panel flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-[#8A6319] flex items-center justify-center shrink-0">
                                <i data-lucide="utensils" class="w-5 h-5"></i>
                            </div>
                            <div class="text-xs">
                                <h4 class="font-bold text-stone-900">Up to 15% Dining & F&B Discount</h4>
                                <p class="text-[10px] text-stone-600">Direct savings on all food & beverage menus across hotel restaurants.</p>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl luxury-panel flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-[#8A6319] flex items-center justify-center shrink-0">
                                <i data-lucide="bed-double" class="w-5 h-5"></i>
                            </div>
                            <div class="text-xs">
                                <h4 class="font-bold text-stone-900">Complimentary Room Upgrade & Late Check-out</h4>
                                <p class="text-[10px] text-stone-600">Extra comfort and flexibility for a seamless stay.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ============================================== -->
            <!-- TAB 2: KARTU VIP & DIGITAL BARCODE             -->
            <!-- ============================================== -->
            <section id="tab-kartu" class="tab-pane hidden space-y-5">
                <div class="text-center space-y-1">
                    <span class="text-[10px] uppercase font-bold tracking-widest text-[#8A6319] block font-serif">DIGITAL MEMBER PASS</span>
                    <h2 class="text-lg font-bold text-stone-900 tracking-wide font-serif">VIP Membership Card</h2>
                </div>

                @if($guest)
                    <!-- Official Physical-Style VIP Digital Card (Matches Desktop Web) -->
                    <div class="relative w-full rounded-3xl overflow-hidden aspect-[1011/639] shadow-2xl transition-all duration-300 hover:scale-[1.01] active:scale-[0.99] {{ $cardBorder }} group select-none">
                        <img src="{{ asset('images/' . $cardImage) }}" alt="{{ $tier }} VIP Card" class="absolute inset-0 w-full h-full object-cover">

                        <!-- Top Right: Points Balance Pill Badge -->
                        <div class="absolute right-[4%] top-[5.5%] z-10">
                            <span class="px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold uppercase tracking-wider bg-black/60 backdrop-blur-md text-[#d6ac57] border border-[#d6ac57]/40 shadow-lg">
                                {{ number_format($guest->points, 0, ',', '.') }} PTS
                            </span>
                        </div>

                        <!-- Dynamic Customer Name & Member Number Overlay -->
                        <div class="absolute left-[5.5%] top-[65.2%] text-left pointer-events-none select-none z-10">
                            <div class="text-[12px] sm:text-[14px] font-sans font-semibold tracking-[0.08em] uppercase {{ $nameColor }} leading-tight drop-shadow-sm truncate max-w-[240px]">
                                {{ $guest->name }}
                            </div>
                            <div class="text-[14px] sm:text-[17px] font-sans font-semibold tracking-[0.14em] {{ $numColor }} mt-1 leading-tight drop-shadow-sm">
                                {{ $guest->member_number }}
                            </div>
                            <div class="text-[9px] sm:text-[10px] font-sans font-light tracking-[0.06em] {{ $valColor }} mt-1.5 sm:mt-2 leading-tight">
                                VALID THRU 11/27
                            </div>
                        </div>
                    </div>

                    <!-- QR Code & Barcode Scanner Panel -->
                    <div class="luxury-panel rounded-3xl p-5 text-center space-y-3.5 shadow-sm">
                        <div class="flex items-center justify-between border-b border-[#E8DFC8] pb-2">
                            <div class="flex items-center space-x-2">
                                <i data-lucide="qr-code" class="w-4 h-4 text-[#8A6319]"></i>
                                <span class="text-xs font-bold uppercase tracking-wider text-stone-900 font-serif">Scan at Front Desk</span>
                            </div>
                            <span class="text-[10px] text-stone-500 font-mono">{{ $guest->member_number }}</span>
                        </div>

                        <div class="bg-white p-3.5 rounded-2xl max-w-[170px] mx-auto text-center shadow-sm border border-[#E8DFC8]">
                            <div id="qrcodeCanvas" class="flex justify-center"></div>
                            <p class="text-[9px] font-mono text-stone-700 font-bold mt-2 tracking-widest">
                                {{ $guest->member_number }}
                            </p>
                        </div>

                        <!-- Barcode Simulation Lines -->
                        <div class="space-y-1 text-center max-w-xs mx-auto">
                            <div class="h-8 bg-stone-900 rounded-lg flex items-center justify-center px-4 space-x-1 overflow-hidden opacity-90 shadow-sm">
                                <div class="w-1 h-full bg-white"></div>
                                <div class="w-2 h-full bg-white"></div>
                                <div class="w-0.5 h-full bg-white"></div>
                                <div class="w-3 h-full bg-white"></div>
                                <div class="w-1 h-full bg-white"></div>
                                <div class="w-2 h-full bg-white"></div>
                                <div class="w-0.5 h-full bg-white"></div>
                                <div class="w-1.5 h-full bg-white"></div>
                                <div class="w-3 h-full bg-white"></div>
                                <div class="w-0.5 h-full bg-white"></div>
                                <div class="w-2 h-full bg-white"></div>
                                <div class="w-1 h-full bg-white"></div>
                            </div>
                            <p class="text-[9px] text-stone-500 font-mono tracking-widest">Scan at Front Desk atau Kasir Outlet F&B</p>
                        </div>
                    </div>

                                        <!-- WHEEL OF FORTUNE BANNER (Annual Lucky Draw 5g Gold) -->
                    <div class="luxury-panel rounded-2xl p-4 bg-gradient-to-br from-[#FFFDF9] via-[#FAF3E3] to-[#F3E5C8] border-2 border-[#D4AF37] space-y-2 relative overflow-hidden shadow-sm">
                        <div class="flex items-center space-x-2.5">
                            <div class="w-8 h-8 rounded-xl bg-[#1e1709] text-[#F5DE93] flex items-center justify-center shrink-0">
                                <i data-lucide="sparkles" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <span class="text-[9px] uppercase font-bold tracking-widest text-[#7A5210] block font-serif">Annual Lucky Draw</span>
                                <h4 class="text-xs font-serif font-black text-stone-900 leading-tight">Wheel of Fortune</h4>
                            </div>
                        </div>
                        <p class="text-[11px] font-semibold text-stone-800 leading-snug">
                            Earn a minimum of 5,000 points for a chance to win a 5-gram gold prize!
                        </p>
                        <p class="text-[9px] italic text-stone-600">
                            *The lucky draw takes place at the end of each year.
                        </p>
                    </div>

                    <!-- COMPLETE BENEFITS FOR THIS TIER -->
                    <div class="luxury-panel rounded-2xl p-5 space-y-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[#8A6319] flex items-center space-x-2 font-serif border-b border-[#E8DFC8] pb-2">
                            <i data-lucide="shield-check" class="w-4 h-4 text-[#D4AF37]"></i>
                            <span>Complete {{ $guest->tier }} Benefits & Privileges</span>
                        </h3>
                        <ul class="space-y-2.5 text-xs text-stone-700">
                            @foreach($tiers[$guest->tier]['benefits'] as $benefit)
                                <li class="flex items-start space-x-2.5">
                                    <div class="w-4 h-4 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5 font-bold">
                                        <i data-lucide="check" class="w-3 h-3"></i>
                                    </div>
                                    <span class="text-[11px] leading-relaxed font-medium">{{ $benefit }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                @else
                    <div class="p-6 text-center space-y-3 luxury-panel rounded-3xl">
                        <i data-lucide="lock" class="w-10 h-10 text-stone-400 mx-auto"></i>
                        <h3 class="text-sm font-bold text-stone-900">No Guest Selected Yet</h3>
                        <p class="text-xs text-stone-600">Please enter your name or mobile number to display your digital VIP card.</p>
                        <button type="button" onclick="openSearchModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-sm">
                            Search Guest Now
                        </button>
                    </div>
                @endif
            </section>

            <!-- ============================================== -->
            <!-- TAB 3: KATALOG HADIAH & PENUKARAN (REDEEM)    -->
            <!-- ============================================== -->
            <section id="tab-katalog" class="tab-pane hidden space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-[#8A6319] block font-serif">REDEEM REWARDS</span>
                        <h2 class="text-lg font-bold text-stone-900 tracking-wide font-serif">Rewards Catalog</h2>
                    </div>
                    @if($guest)
                        <div class="px-3 py-1 rounded-full bg-amber-100 border border-amber-300 text-[#8A6319] text-xs font-bold">
                            Balance: {{ number_format($guest->points, 0, ',', '.') }} Pts
                        </div>
                    @endif
                </div>

                <!-- CATEGORY FILTER PILLS (Matching Web Cream & Gold) -->
                <div class="flex items-center space-x-2 overflow-x-auto pb-1 text-xs select-none">
                    <button type="button" onclick="filterCatalog('all')" id="cat-pill-all" class="cat-pill px-3.5 py-1.5 rounded-full bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold shrink-0 shadow-sm">
                        All Rewards
                    </button>
                    <button type="button" onclick="filterCatalog('100')" id="cat-pill-100" class="cat-pill px-3.5 py-1.5 rounded-full bg-[#FFFDF9] border border-[#DEC8A4] text-stone-700 font-semibold shrink-0">
                        100 Points
                    </button>
                    <button type="button" onclick="filterCatalog('500')" id="cat-pill-500" class="cat-pill px-3.5 py-1.5 rounded-full bg-[#FFFDF9] border border-[#DEC8A4] text-stone-700 font-semibold shrink-0">
                        500 Points
                    </button>
                    <button type="button" onclick="filterCatalog('1000')" id="cat-pill-1000" class="cat-pill px-3.5 py-1.5 rounded-full bg-[#FFFDF9] border border-[#DEC8A4] text-stone-700 font-semibold shrink-0">
                        1,000 Points
                    </button>
                </div>

                <!-- REWARDS CARDS LIST -->
                <div class="space-y-3" id="catalogCardsContainer">
                    @foreach($redeemCatalog as $cost => $category)
                        @foreach($category['items'] as $item)
                            @php
                                $canAfford = $guest && ($guest->points >= $cost);
                                $shortage = $guest ? max(0, $cost - $guest->points) : $cost;
                            @endphp
                            <div class="catalog-item p-4 rounded-3xl luxury-panel space-y-3 transition" data-category="{{ $cost }}">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 rounded-2xl bg-amber-100 text-[#8A6319] border border-amber-200 flex items-center justify-center shrink-0">
                                            <i data-lucide="{{ $item['icon'] }}" class="w-6 h-6"></i>
                                        </div>
                                        <div>
                                            <span class="text-[9px] uppercase tracking-wider font-bold px-2 py-0.5 rounded-full bg-amber-100 text-[#8A6319] border border-amber-200 inline-block mb-1">
                                                {{ $item['badge'] }}
                                            </span>
                                            <h3 class="text-xs font-bold text-stone-900">{{ $item['title'] }}</h3>
                                            <p class="text-[10px] text-stone-600 mt-0.5 leading-relaxed">{{ $item['detail'] }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-2 border-t border-[#E8DFC8] flex items-center justify-between">
                                    <div>
                                        <span class="text-[9px] uppercase text-stone-500 font-semibold block">POINTSTS COST</span>
                                        <span class="text-sm font-black text-[#8A6319] font-mono">{{ number_format($cost, 0, ',', '.') }} Points</span>
                                    </div>

                                    @if($guest)
                                        @if($canAfford)
                                            <button type="button"
                                                    onclick="openRedeemModal('{{ $item['id'] }}', '{{ addslashes($item['title']) }}', {{ $cost }}, {{ json_encode($item['options']) }})" 
                                                    class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider hover:brightness-105 active:scale-95 transition shadow-sm">
                                                Redeem Now
                                            </button>
                                        @else
                                            <span class="text-[10px] font-bold text-stone-500 px-3 py-1.5 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4]">
                                                Need {{ number_format($shortage, 0, ',', '.') }} Pts
                                            </span>
                                        @endif
                                    @else
                                        <button type="button" onclick="openSearchModal()" class="px-3.5 py-1.5 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] text-stone-700 font-bold text-[10px] uppercase">
                                            Cek Points Dulu
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </section>

            <!-- ============================================== -->
            <!-- TAB 4: RIWAYAT POINTS & VOUCHER SAYA             -->
            <!-- ============================================== -->
            <section id="tab-riwayat" class="tab-pane hidden space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-[#8A6319] block font-serif">MY ACTIVITY</span>
                        <h2 class="text-lg font-bold text-stone-900 tracking-wide font-serif">History & Vouchers</h2>
                    </div>
                </div>

                @if($guest)
                    <!-- SUB-TABS: RIWAYAT VS VOUCHER -->
                    <div class="grid grid-cols-2 p-1 rounded-2xl bg-[#FAF6EE] border border-[#DEC8A4] text-xs text-center select-none">
                        <button type="button" onclick="switchHistorySubTab('stays')" id="btnSubStays" class="py-2 rounded-xl bg-[#FFFDF9] border border-amber-300 text-[#8A6319] font-bold transition shadow-sm">
                            Historyts ({{ $guest->stays->count() }})
                        </button>
                        <button type="button" onclick="switchHistorySubTab('vouchers')" id="btnSubVouchers" class="py-2 rounded-xl text-stone-600 font-semibold hover:text-stone-900 transition">
                            My Vouchers ({{ $guest->redemptions->count() }})
                        </button>
                    </div>

                    <!-- 1. RIWAYAT PEROLEHAN POINTS -->
                    <div id="subTabStays" class="space-y-2.5">
                        @forelse($guest->stays as $stay)
                            <div class="p-3.5 rounded-2xl luxury-panel space-y-2">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-2.5">
                                        <div class="w-8 h-8 rounded-xl {{ $stay->transaction_type === 'banquet' ? 'bg-purple-100 text-purple-800' : 'bg-amber-100 text-[#8A6319]' }} flex items-center justify-center shrink-0">
                                            <i data-lucide="{{ $stay->transaction_type === 'banquet' ? 'calendar-days' : 'bed-double' }}" class="w-4 h-4"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-xs font-bold text-stone-900">
                                                {{ $stay->transaction_type === 'banquet' ? 'Banquet Event Revenue' : 'Room ' . $stay->room_type }}
                                            </h4>
                                            <span class="text-[10px] text-stone-500 font-mono">{{ $stay->booking_code }}</span>
                                        </div>
                                    </div>
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200 font-bold text-xs">
                                        +{{ number_format($stay->points_added, 0, ',', '.') }} PTS
                                    </span>
                                </div>
                                <div class="pt-1.5 border-t border-[#E8DFC8] flex items-center justify-between text-[10px] text-stone-600">
                                    <span>
                                        @if($stay->transaction_type === 'banquet')
                                            Rev: Rp {{ number_format($stay->revenue_amount, 0, ',', '.') }}
                                        @else
                                            {{ $stay->nights }} Night(s) ({{ $stay->points_per_night }} pts/night)
                                        @endif
                                    </span>
                                    <span>{{ $stay->stay_date ? $stay->stay_date->format('d M Y') : '-' }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-stone-500 text-xs luxury-panel rounded-2xl">
                                No points accumulation history recorded yet.
                            </div>
                        @endforelse
                    </div>

                    <!-- 2. DAFTAR VOUCHER REDEEM -->
                    <div id="subTabVouchers" class="space-y-2.5 hidden">
                        @forelse($guest->redemptions as $redemption)
                            <div class="p-3.5 rounded-2xl luxury-panel {{ $redemption->status === 'aktif' ? 'border-amber-300 bg-gradient-to-r from-[#FFFDF9] to-[#FAF3E3]' : '' }} space-y-2.5">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <span class="text-[9px] uppercase font-bold px-2 py-0.5 rounded-full {{ $redemption->status === 'aktif' ? 'bg-amber-100 text-[#8A6319] border border-amber-300' : 'bg-stone-200 text-stone-700' }} inline-block mb-1">
                                            Status: {{ strtoupper($redemption->status) }}
                                        </span>
                                        <h4 class="text-xs font-bold text-stone-900">{{ $redemption->item_title }}</h4>
                                        <p class="text-[10px] text-stone-600 mt-0.5">{{ $redemption->item_detail }}</p>
                                    </div>
                                    <span class="text-xs font-bold text-rose-600 font-mono">
                                        -{{ $redemption->points_cost }} PTS
                                    </span>
                                </div>

                                <div class="p-2 rounded-xl bg-white border border-[#DEC8A4] flex items-center justify-between">
                                    <span class="text-xs font-mono font-bold text-[#8A6319] tracking-wider">
                                        {{ $redemption->voucher_code }}
                                    </span>
                                    <button type="button" onclick="copyText('{{ $redemption->voucher_code }}', 'Voucher code copied!')" class="text-xs text-stone-700 hover:text-stone-900 flex items-center space-x-1 font-semibold">
                                        <i data-lucide="copy" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                                        <span>Copy</span>
                                    </button>
                                </div>

                                <div class="flex items-center justify-between text-[10px] text-stone-600 pt-1">
                                    <span>Redeemed: {{ $redemption->redeemed_at ? $redemption->redeemed_at->format('d M Y H:i') : $redemption->created_at->format('d M Y') }}</span>
                                    <span>Remaining balance: {{ number_format($redemption->points_after, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-stone-500 text-xs luxury-panel rounded-2xl">
                                No rewards redeemed yet.
                            </div>
                        @endforelse
                    </div>

                @else
                    <div class="p-6 text-center space-y-3 luxury-panel rounded-3xl">
                        <i data-lucide="user-x" class="w-10 h-10 text-stone-400 mx-auto"></i>
                        <h3 class="text-sm font-bold text-stone-900">No Guest Selected Yet</h3>
                        <p class="text-xs text-stone-600">Please search for your guest account to view stay and voucher history.</p>
                        <button type="button" onclick="openSearchModal()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-sm">
                            Search Guest
                        </button>
                    </div>
                @endif
            </section>

            <!-- ============================================== -->
            <!-- TAB 5: SIMULATOR POINTS & CONCIERGE             -->
            <!-- ============================================== -->
            <section id="tab-simulasi" class="tab-pane hidden space-y-5">
                <div class="text-center space-y-1">
                    <span class="text-[10px] uppercase font-bold tracking-widest text-[#8A6319] block font-serif">CALCULATOR & SUPPORT</span>
                    <h2 class="text-lg font-bold text-stone-900 tracking-wide font-serif">Simulasi Points & Concierge</h2>
                </div>

                <!-- SIMULATOR CARD -->
                <div class="luxury-panel rounded-3xl p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-[#E8DFC8] pb-2">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[#8A6319] flex items-center space-x-1.5 font-serif">
                            <i data-lucide="calculator" class="w-4 h-4 text-[#D4AF37]"></i>
                            <span>Points Earning Calculatorts</span>
                        </h3>
                    </div>

                    <!-- Room Simulator -->
                    <div class="space-y-3">
                        <div>
                            <label class="block text-[10px] uppercase font-bold text-stone-700 mb-1">Room Type</label>
                            <select id="simRoomType" onchange="calculatePoints()" class="w-full px-3 py-2 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] text-stone-900 text-xs outline-none">
                                <option value="10">Grand Deluxe (10 Pts / night)</option>
                                <option value="15">Grand Executive (15 Pts / night)</option>
                                <option value="20">Royal Suite (20 Pts / night)</option>
                                <option value="30">President Suite (30 Pts / night)</option>
                            </select>
                        </div>

                        <div>
                            <div class="flex items-center justify-between text-[10px] uppercase font-bold text-stone-700 mb-1">
                                <span>Number of Nights</span>
                                <span id="nightsLabel" class="text-[#8A6319] font-mono text-xs font-bold">3 Nights</span>
                            </div>
                            <input type="range" id="simNights" min="1" max="14" value="3" oninput="calculatePoints()" class="w-full accent-[#8A6319]">
                        </div>

                        <!-- Banquet Revenue Simulator -->
                        <div class="pt-2 border-t border-[#E8DFC8]">
                            <label class="block text-[10px] uppercase font-bold text-stone-700 mb-1">Banquet / Event Revenue (Every IDR 1M = 10 Pts)</label>
                            <input type="number" id="simBanquet" value="0" step="1000000" min="0" placeholder="Rp 0" oninput="calculatePoints()" class="w-full px-3 py-2 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] text-stone-900 text-xs outline-none font-mono">
                        </div>

                        <!-- Estimation Result -->
                        <div class="p-4 rounded-2xl bg-gradient-to-r from-amber-100 to-[#FAF3E3] border border-amber-300 text-center space-y-1">
                            <span class="text-[9px] uppercase tracking-wider text-[#8A6319] block font-bold">ESTIMATED NEW POINTSTS</span>
                            <div class="text-3xl font-black text-[#8A6319] font-mono drop-shadow-sm" id="estimatedPointsResult">
                                +30 POINTSTS
                            </div>
                            <p class="text-[10px] text-stone-700" id="simulationSummary">
                                (30 Room Points + 0 Banquet Points)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- DIRECT WHATSAPP CONCIERGE CARD (Mulia Style) -->
                <div class="p-5 rounded-3xl bg-gradient-to-br from-[#1C1408] to-[#2B1D0E] text-white border border-amber-500/30 space-y-3 shadow-md">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                            <i data-lucide="phone-call" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-amber-300 block">24/7 CONCIERGE SERVICE</span>
                            <h3 class="text-xs font-bold text-white">Concierge & Front Desk</h3>
                        </div>
                    </div>

                    <p class="text-xs text-stone-300 leading-relaxed">
                        Need room reservations, complimentary Tugu Station shuttle booking, or points inquiry? Our Concierge team is ready to assist you via official WhatsApp.
                    </p>

                    <a href="https://wa.me/{{ config('hotel.whatsapp') }}?text={{ urlencode('Halo Concierge Grand Senyum Hotel, saya member Senyum Stay Priority ingin bertanya.') }}" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs uppercase tracking-wider transition flex items-center justify-center space-x-2 shadow-lg">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>WhatsApp Concierge ({{ config('hotel.whatsapp_display') }})</span>
                    </a>
                </div>

                <!-- TIER COMPARISON OVERVIEW -->
                <div class="luxury-panel rounded-3xl p-5 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-stone-900 border-b border-[#E8DFC8] pb-2 font-serif">Tier Level Comparison</h3>
                    <div class="space-y-2 text-xs">
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="flex justify-between font-bold text-slate-800 mb-1">
                                <span>Silver Member</span>
                                <span>( 0 – 1000 Point )</span>
                            </div>
                            <p class="text-[10px] text-stone-600">5% Discount on F&B, IDR 10,000 Laundry Discount, IDR 25,000 Direct Booking Discount.</p>
                        </div>
                        <div class="p-3 rounded-xl bg-amber-50 border border-amber-200">
                            <div class="flex justify-between font-bold text-[#8A6319] mb-1">
                                <span>Gold Member</span>
                                <span>( 1000 – 5000 Point )</span>
                            </div>
                            <p class="text-[10px] text-stone-600">10% Discount on F&B, Free Laundry for 3 Pieces (1 Top, 1 Bottom, 1 Undergarment), IDR 50,000 Direct Booking Disc, Early/Late Check-in, Shuttle Tugu, Room Upgrade, E-Bike 1 Pax, VIP Treatment.</p>
                        </div>
                        <div class="p-3 rounded-xl bg-indigo-50 border border-indigo-200">
                            <div class="flex justify-between font-bold text-indigo-900 mb-1">
                                <span>Platinum Member</span>
                                <span>( 5000 – 10.000 Point )</span>
                            </div>
                            <p class="text-[10px] text-stone-600">Complimentary 1 Night Stay, 15% F&B, Free Laundry for 5 Pieces (1 Top, 1 Bottom, 3 Undergarments), IDR 100k Direct Booking Disc, E-Bike 2 Pax, Birthday Cake, VIP, Special Gift, Wheel of Fortune (Emas 5g).</p>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <!-- PERSISTENT MOBILE BOTTOM NAVIGATION BAR (Luxury Cream Palette) -->
        <nav class="fixed bottom-0 left-0 right-0 z-50 luxury-tab-bar px-2 py-2 flex items-center justify-around select-none">
            <!-- 1. Beranda -->
            <button type="button" onclick="switchTab('home')" id="nav-btn-home" class="nav-tab-btn flex flex-col items-center py-1 px-3 rounded-2xl text-[#8A6319] transition">
                <i data-lucide="home" class="w-5 h-5"></i>
                <span class="text-[9px] font-bold mt-1 tracking-wider">Home</span>
            </button>

            <!-- 2. Kartu VIP -->
            <button type="button" onclick="switchTab('kartu')" id="nav-btn-kartu" class="nav-tab-btn flex flex-col items-center py-1 px-3 rounded-2xl text-stone-400 hover:text-stone-800 transition">
                <i data-lucide="credit-card" class="w-5 h-5"></i>
                <span class="text-[9px] font-medium mt-1 tracking-wider">VIP Card</span>
            </button>

            <!-- 3. Hadiah (Redeem) -->
            <button type="button" onclick="switchTab('katalog')" id="nav-btn-katalog" class="nav-tab-btn flex flex-col items-center py-1 px-3 rounded-2xl text-stone-400 hover:text-stone-800 transition">
                <i data-lucide="gift" class="w-5 h-5"></i>
                <span class="text-[9px] font-medium mt-1 tracking-wider">Rewards</span>
            </button>

            <!-- 4. Riwayat -->
            <button type="button" onclick="switchTab('riwayat')" id="nav-btn-riwayat" class="nav-tab-btn flex flex-col items-center py-1 px-3 rounded-2xl text-stone-400 hover:text-stone-800 transition">
                <i data-lucide="receipt" class="w-5 h-5"></i>
                <span class="text-[9px] font-medium mt-1 tracking-wider">History</span>
            </button>

            <!-- 5. Simulasi -->
            <button type="button" onclick="switchTab('simulasi')" id="nav-btn-simulasi" class="nav-tab-btn flex flex-col items-center py-1 px-3 rounded-2xl text-stone-400 hover:text-stone-800 transition">
                <i data-lucide="calculator" class="w-5 h-5"></i>
                <span class="text-[9px] font-medium mt-1 tracking-wider">Simulation</span>
            </button>
        </nav>

            <!-- iOS Home Indicator Pill Bar -->
            <div class="hidden md:flex justify-center pb-1.5 pt-0.5 bg-[#FFFDF9]/95 z-40 select-none pointer-events-none">
                <div class="w-32 h-1 bg-stone-900/40 rounded-full"></div>
            </div>
        </div> <!-- End of #mobileAppContainer -->
    </div> <!-- End of #phoneDeviceShell -->

    <!-- ======================================================== -->
    <!-- MODAL 1: SEARCH / SWITCH VIP PROFILE (BOTTOM SHEET)      -->
    <!-- ======================================================== -->
    <div id="searchModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex-col justify-end p-0 transition-opacity duration-300">
        <div class="w-full max-w-lg mx-auto bg-[#FFFDF9] border-t border-[#DEC8A4] rounded-t-3xl p-5 space-y-4 max-h-[85vh] overflow-y-auto shadow-2xl">
            <div class="flex items-center justify-between pb-2 border-b border-[#E8DFC8]">
                <div class="flex items-center space-x-2">
                    <i data-lucide="user-search" class="w-5 h-5 text-[#8A6319]"></i>
                    <h3 class="text-sm font-bold text-stone-900 uppercase tracking-wider font-serif">Search / Switch Guest Account</h3>
                </div>
                <button type="button" onclick="closeSearchModal()" class="p-1 rounded-full text-stone-400 hover:text-stone-800">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Quick Form -->
            <form action="{{ route('guest.mobile') }}" method="GET" class="space-y-3">
                <div>
                    <label class="block text-[10px] uppercase font-bold text-stone-700 mb-1">Mobile Phone Number</label>
                    <input type="tel" name="phone" value="{{ $searchPhone }}" placeholder="e.g. 081234567890" class="w-full px-3.5 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] text-stone-900 text-xs outline-none focus:border-[#8A6319]">
                </div>
                <div>
                    <label class="block text-[10px] uppercase font-bold text-stone-700 mb-1">Or Guest Full Name</label>
                    <input type="text" name="name" value="{{ $searchName }}" placeholder="e.g. John Doe" class="w-full px-3.5 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] text-stone-900 text-xs outline-none focus:border-[#8A6319]">
                </div>
                <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-sm">
                    Search Guest
                </button>
            </form>


        </div>
    </div>

    <!-- ======================================================== -->
    <!-- MODAL 2: CONFIRM REDEEM REWARD                           -->
    <!-- ======================================================== -->
    <div id="redeemModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex-col justify-end p-0 transition-opacity duration-300">
        <div class="w-full max-w-lg mx-auto bg-[#FFFDF9] border-t border-[#DEC8A4] rounded-t-3xl p-5 space-y-4 max-h-[85vh] overflow-y-auto shadow-2xl">
            <div class="flex items-center justify-between pb-2 border-b border-[#E8DFC8]">
                <div class="flex items-center space-x-2">
                    <i data-lucide="gift" class="w-5 h-5 text-[#8A6319]"></i>
                    <h3 class="text-sm font-bold text-stone-900 uppercase tracking-wider font-serif">Confirm Reward Redemption</h3>
                </div>
                <button type="button" onclick="closeRedeemModal()" class="p-1 rounded-full text-stone-400 hover:text-stone-800">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            @if($guest)
                <form action="{{ route('guest.redeem') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="source" value="mobile">
                    <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                    <input type="hidden" name="item_id" id="modalItemId" value="">

                    <div class="p-4 rounded-2xl bg-[#FAF6EE] border border-[#DEC8A4] text-center space-y-1">
                        <span class="text-[10px] uppercase font-bold text-stone-500 block">Selected Item</span>
                        <h4 class="text-base font-bold text-stone-900" id="modalItemTitle">-</h4>
                        <div class="text-sm font-bold text-[#8A6319] font-mono" id="modalItemCost">- Points</div>
                    </div>

                    <!-- Dynamic Options if item has options -->
                    <div id="modalOptionsWrapper" class="space-y-1 hidden">
                        <label class="block text-[10px] uppercase font-bold text-stone-700">Gift Variant Option</label>
                        <select name="selected_option" id="modalSelectedOption" class="w-full px-3 py-2.5 rounded-xl bg-white border border-[#DEC8A4] text-stone-900 text-xs outline-none">
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase font-bold text-stone-700 mb-1">Additional Notes (Optional)</label>
                        <textarea name="notes" rows="2" placeholder="e.g. Please prepare upon check-in or deliver to room" class="w-full px-3 py-2 rounded-xl bg-white border border-[#DEC8A4] text-stone-900 text-xs outline-none"></textarea>
                    </div>

                    <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-[11px] text-[#8A6319]">
                        Your points will be automatically deducted and an e-voucher will be issued.
                    </div>

                    <div class="flex space-x-2 pt-2">
                        <button type="button" onclick="closeRedeemModal()" class="flex-1 py-3 rounded-xl bg-[#FAF6EE] text-stone-700 border border-[#DEC8A4] font-bold text-xs uppercase">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 py-3 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-sm">
                            Ya, Redeem Now
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- MODAL 3: STASIUN TUGU SHUTTLE BOOKING TEMPLATE           -->
    <!-- ======================================================== -->
    <div id="tuguModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex-col justify-end p-0 transition-opacity duration-300">
        <div class="w-full max-w-lg mx-auto bg-[#FFFDF9] border-t border-[#DEC8A4] rounded-t-3xl p-5 space-y-4 max-h-[85vh] overflow-y-auto shadow-2xl">
            <div class="flex items-center justify-between pb-2 border-b border-[#E8DFC8]">
                <div class="flex items-center space-x-2">
                    <i data-lucide="train" class="w-5 h-5 text-[#8A6319]"></i>
                    <h3 class="text-sm font-bold text-stone-900 uppercase tracking-wider font-serif">Tugu Train Station Shuttle Service</h3>
                </div>
                <button type="button" onclick="closeTuguModal()" class="p-1 rounded-full text-stone-400 hover:text-stone-800">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <p class="text-xs text-stone-600 leading-relaxed">
                Complimentary pick-up & drop-off service for <strong class="text-[#8A6319]">Gold</strong> and <strong class="text-indigo-800">Platinum</strong> members between Tugu Train Station and Grand Senyum Hotel.
            </p>

            <div class="p-3 rounded-xl bg-[#FAF6EE] border border-[#DEC8A4] space-y-2 text-xs">
                <div>
                    <label class="block text-[10px] uppercase font-bold text-stone-700">Train Name / Arrival Time</label>
                    <input type="text" id="trainArrivalTime" placeholder="e.g. KA Argo Dwipangga arriving at 15:30 WIB" class="w-full px-3 py-2 rounded-lg bg-white border border-[#DEC8A4] text-stone-900 text-xs mt-1">
                </div>
            </div>

            <button type="button" onclick="sendTuguWhatsApp()" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center space-x-2 shadow-md">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Send Booking Request via WhatsApp</span>
            </button>
        </div>
    </div>

    <!-- TOAST NOTIFICATION CONTAINER -->
    <div id="toast" class="fixed top-12 left-1/2 -translate-x-1/2 z-50 px-4 py-2 rounded-full bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 text-xs font-bold shadow-2xl transition-all duration-300 opacity-0 pointer-events-none">
        Notification
    </div>

    <!-- JAVASCRIPT CONTROLLERS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
            updateClock();
            setInterval(updateClock, 1000);

            // Generate QR Code if guest is present
            @if($guest)
                const qrElement = document.getElementById('qrcodeCanvas');
                if (qrElement && window.QRCode) {
                    new QRCode(qrElement, {
                        text: "{{ $guest->member_number }}",
                        width: 140,
                        height: 140,
                        colorDark: "#1C1408",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
            @endif

            // Check URL active tab parameter
            const urlParams = new URLSearchParams(window.location.search);
            const requestedTab = urlParams.get('tab');
            if (requestedTab) {
                switchTab(requestedTab);
            }

            // Auto play dashboard video
            const dashVideo = document.getElementById('dashboardOpeningVideo');
            if (dashVideo) {
                dashVideo.play().catch(() => {});
            }

            // ============================================================
            // Auto-trigger Cinematic Video Intro (identik logika web)
            // Hanya muncul saat pertama kali buka, belum ada pencarian tamu
            // ============================================================
            const searched = {{ ($searchName || $searchPhone || $guest) ? "true" : "false" }};
            const seen = sessionStorage.getItem('gsh_mobile_intro_seen');
            if (!searched && !seen) {
                setTimeout(() => {
                    openMobileIntro(false);
                }, 300);
            }
        });

        // Live Clock on Mobile Header
        function updateClock() {
            const clockEl = document.getElementById('mobileClock');
            if (!clockEl) return;
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            clockEl.textContent = `${hours}:${minutes}`;
        }

        // Fast Tab Switching without reload
        function switchTab(tabId, subTabId = null) {
            // Hide all tab panes
            document.querySelectorAll('.tab-pane').forEach(el => el.classList.add('hidden'));

            // Show selected tab pane
            const targetPane = document.getElementById('tab-' + tabId);
            if (targetPane) {
                targetPane.classList.remove('hidden');
            }

            // Update bottom navigation button styles
            document.querySelectorAll('.nav-tab-btn').forEach(btn => {
                btn.classList.remove('text-[#8A6319]');
                btn.classList.add('text-stone-400');
            });
            const activeBtn = document.getElementById('nav-btn-' + tabId);
            if (activeBtn) {
                activeBtn.classList.remove('text-stone-400');
                activeBtn.classList.add('text-[#8A6319]');
            }

            // Re-render lucide icons inside the pane
            if (window.lucide) lucide.createIcons();

            // Scroll top
            window.scrollTo({ top: 0, behavior: 'smooth' });

            // If subtab specified
            if (tabId === 'riwayat' && subTabId) {
                switchHistorySubTab(subTabId);
            }
        }

        // History Sub-Tabs (Stays vs Vouchers)
        function switchHistorySubTab(subTab) {
            const btnStays = document.getElementById('btnSubStays');
            const btnVouchers = document.getElementById('btnSubVouchers');
            const subTabStays = document.getElementById('subTabStays');
            const subTabVouchers = document.getElementById('subTabVouchers');

            if (subTab === 'stays') {
                btnStays.className = "py-2 rounded-xl bg-[#FFFDF9] border border-amber-300 text-[#8A6319] font-bold transition shadow-sm";
                btnVouchers.className = "py-2 rounded-xl text-stone-600 font-semibold hover:text-stone-900 transition";
                subTabStays.classList.remove('hidden');
                subTabVouchers.classList.add('hidden');
            } else {
                btnVouchers.className = "py-2 rounded-xl bg-[#FFFDF9] border border-amber-300 text-[#8A6319] font-bold transition shadow-sm";
                btnStays.className = "py-2 rounded-xl text-stone-600 font-semibold hover:text-stone-900 transition";
                subTabVouchers.classList.remove('hidden');
                subTabStays.classList.add('hidden');
            }
            if (window.lucide) lucide.createIcons();
        }

        // Filter Catalog by Points Category
        function filterCatalog(category) {
            document.querySelectorAll('.cat-pill').forEach(pill => {
                pill.className = "cat-pill px-3.5 py-1.5 rounded-full bg-[#FFFDF9] border border-[#DEC8A4] text-stone-700 font-semibold shrink-0";
            });
            const activePill = document.getElementById('cat-pill-' + category);
            if (activePill) {
                activePill.className = "cat-pill px-3.5 py-1.5 rounded-full bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold shrink-0 shadow-sm";
            }

            const items = document.querySelectorAll('.catalog-item');
            items.forEach(item => {
                if (category === 'all' || item.getAttribute('data-category') === category) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }

        // Interactive Simulator Calculation
        function calculatePoints() {
            const rate = parseInt(document.getElementById('simRoomType').value, 10) || 10;
            const nights = parseInt(document.getElementById('simNights').value, 10) || 1;
            const banquetRevenue = parseFloat(document.getElementById('simBanquet').value) || 0;

            document.getElementById('nightsLabel').textContent = `${nights} Night(s)`;

            const roomPoints = rate * nights;
            const banquetPoints = Math.floor(banquetRevenue / 1000000) * 10;
            const total = roomPoints + banquetPoints;

            document.getElementById('estimatedPointsResult').textContent = `+${total.toLocaleString('id-ID')} POINTS`;
            document.getElementById('simulationSummary').textContent = `(${roomPoints} Room Points + ${banquetPoints} Banquet Points)`;
        }

        // Toggle Audio on Dashboard Embedded Video
        function toggleDashboardVideoAudio() {
            const video = document.getElementById('dashboardOpeningVideo');
            const icon = document.getElementById('dashVideoAudioIcon');
            if (!video || !icon) return;

            video.muted = !video.muted;
            if (video.muted) {
                icon.setAttribute('data-lucide', 'volume-x');
            } else {
                icon.setAttribute('data-lucide', 'volume-2');
            }
            if (window.lucide) lucide.createIcons();
        }

        // Fullscreen Cinematic Intro Overlay Handlers
        function openMobileIntro(force = false) {
            const overlay = document.getElementById('mobile-drone-overlay');
            const player = document.getElementById('mobile-drone-player');
            if (!overlay) return;

            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            overlay.style.opacity = '0';
            setTimeout(() => { overlay.style.opacity = '1'; }, 10);

            if (player) {
                player.currentTime = 0;
                const playPromise = player.play();
                if (playPromise !== undefined) {
                    playPromise.catch(() => {
                        // Video gagal play â€” tampilkan fallback jika ada
                        const fallback = document.getElementById('mobile-drone-fallback');
                        if (fallback) fallback.classList.remove('hidden');
                    });
                }
            }
            if (window.lucide) lucide.createIcons();
        }

        function closeMobileIntro() {
            const overlay = document.getElementById('mobile-drone-overlay');
            const player = document.getElementById('mobile-drone-player');
            if (player) player.pause();
            if (overlay) {
                overlay.style.opacity = '0';
                setTimeout(() => {
                    overlay.classList.remove('flex');
                    overlay.classList.add('hidden');
                }, 500);
            }
            // Simpan ke sessionStorage agar tidak muncul lagi satu sesi
            sessionStorage.setItem('gsh_mobile_intro_seen', 'true');
        }

        function toggleIntroAudio() {
            const player = document.getElementById('mobile-drone-player');
            const icon = document.getElementById('intro-audio-icon');
            if (!player || !icon) return;

            player.muted = !player.muted;
            if (player.muted) {
                icon.setAttribute('data-lucide', 'volume-x');
            } else {
                icon.setAttribute('data-lucide', 'volume-2');
            }
            if (window.lucide) lucide.createIcons();
        }

        // Search Modal Handlers
        function openSearchModal() {
            document.getElementById('searchModal').classList.remove('hidden');
            document.getElementById('searchModal').classList.add('flex');
            if (window.lucide) lucide.createIcons();
        }
        function closeSearchModal() {
            document.getElementById('searchModal').classList.add('hidden');
            document.getElementById('searchModal').classList.remove('flex');
        }

        // Redeem Modal Handlers
        function openRedeemModal(itemId, itemTitle, itemCost, options = []) {
            document.getElementById('modalItemId').value = itemId;
            document.getElementById('modalItemTitle').textContent = itemTitle;
            document.getElementById('modalItemCost').textContent = `${itemCost.toLocaleString('id-ID')} Points`;

            const optionsWrapper = document.getElementById('modalOptionsWrapper');
            const selectEl = document.getElementById('modalSelectedOption');
            selectEl.innerHTML = '';

            if (options && options.length > 0) {
                optionsWrapper.classList.remove('hidden');
                options.forEach(opt => {
                    const optEl = document.createElement('option');
                    optEl.value = opt;
                    optEl.textContent = opt;
                    selectEl.appendChild(optEl);
                });
            } else {
                optionsWrapper.classList.add('hidden');
            }

            document.getElementById('redeemModal').classList.remove('hidden');
            document.getElementById('redeemModal').classList.add('flex');
            if (window.lucide) lucide.createIcons();
        }
        function closeRedeemModal() {
            document.getElementById('redeemModal').classList.add('hidden');
            document.getElementById('redeemModal').classList.remove('flex');
        }

        // Stasiun Tugu Shuttle Modal Handlers
        function openTuguBookingModal() {
            document.getElementById('tuguModal').classList.remove('hidden');
            document.getElementById('tuguModal').classList.add('flex');
            if (window.lucide) lucide.createIcons();
        }
        function closeTuguModal() {
            document.getElementById('tuguModal').classList.add('hidden');
            document.getElementById('tuguModal').classList.remove('flex');
        }
        function sendTuguWhatsApp() {
            const time = document.getElementById('trainArrivalTime').value || 'Hari ini';
            const guestName = "{{ $guest ? $guest->name : 'Grand Senyum Guest' }}";
            const memberNo = "{{ $guest ? $guest->member_number : '' }}";
            const text = `Halo Concierge Grand Senyum Hotel, saya member ${guestName} (${memberNo}) ingin memesan Complimentary Tugu Station Shuttle. Rincian: ${time}. Terima kasih.`;
            const hotelWhatsApp = "{{ config('hotel.whatsapp') }}";
            const url = `https://wa.me/${hotelWhatsApp}?text=${encodeURIComponent(text)}`;
            window.open(url, '_blank');
            closeTuguModal();
        }

        // Copy Text Helper with Toast
        function copyText(text, message = 'Text copied to clipboard') {
            navigator.clipboard.writeText(text).then(() => {
                showToast(message);
            }).catch(() => {
                showToast(message);
            });
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.remove('opacity-0', 'pointer-events-none');
            toast.classList.add('opacity-100');
            setTimeout(() => {
                toast.classList.remove('opacity-100');
                toast.classList.add('opacity-0', 'pointer-events-none');
            }, 2500);
        }

        // Desktop Device Frame Toggle
        let isFrameMode = true;
        function toggleDesktopDeviceFrame() {
            const shell = document.getElementById("phoneDeviceShell");
            const container = document.getElementById("mobileAppContainer");
            const label = document.getElementById("frameToggleLabel");
            if (isFrameMode) {
                if (shell) shell.classList.remove("iphone-17-pro-wrapper");
                if (container) container.classList.remove("mobile-frame-mode");
                label.textContent = "Frame iPhone 17 Pro";
                isFrameMode = false;
            } else {
                if (shell) shell.classList.add("iphone-17-pro-wrapper");
                if (container) container.classList.add("mobile-frame-mode");
                label.textContent = "Full Width Screen";
                isFrameMode = true;
            }
        }

    </script>
</body>
</html>
