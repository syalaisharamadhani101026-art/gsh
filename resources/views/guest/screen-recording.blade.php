@extends('layouts.app')

@section('title', 'Rekaman Layar Web Mobile & Web Desktop - Senyum Stay Priority')

@section('content')
<div class="py-10 sm:py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Header Information -->
        <div class="text-center space-y-4">
            <div class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-amber-500/15 text-[#8A6319] border border-amber-500/30">
                <i data-lucide="video" class="w-4 h-4 text-[#D4AF37]"></i>
                <span>Official Screen Recording & Demo Walkthrough</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-sans font-bold text-stone-900 tracking-tight">
                Rekaman Layar <span class="text-[#8A6319]">Mobile & Web Desktop</span>
            </h1>
            <p class="text-sm sm:text-base text-stone-600 max-w-2xl mx-auto leading-relaxed">
                Demonstrasi video interaktif aplikasi loyalitas <strong>Senyum Stay Priority</strong> Grand Senyum Hotel Yogyakarta pada perangkat smartphone (iPhone 14 Pro) dan peramban desktop Full HD.
            </p>

            <!-- Video Tab Selector -->
            <div class="inline-flex p-1.5 rounded-2xl bg-stone-200/80 border border-stone-300 shadow-inner max-w-md mx-auto">
                <button type="button" 
                        onclick="switchVideoTab('mobile')" 
                        id="tab-btn-mobile"
                        class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 flex items-center space-x-2 bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 shadow-md">
                    <i data-lucide="smartphone" class="w-4 h-4"></i>
                    <span>1. Rekaman Web Mobile</span>
                </button>
                <button type="button" 
                        onclick="switchVideoTab('web')" 
                        id="tab-btn-web"
                        class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 flex items-center space-x-2 text-stone-700 hover:text-stone-950">
                    <i data-lucide="monitor" class="w-4 h-4"></i>
                    <span>2. Rekaman Web Desktop</span>
                </button>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 1: REKAMAN MOBILE (IPHONE 14 PRO)     -->
        <!-- ========================================== -->
        <div id="video-panel-mobile" class="space-y-6">
            <div class="flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-[#E8DFC8] shadow-sm">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-[#8A6319] flex items-center justify-center font-bold">
                        <i data-lucide="smartphone" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-sm sm:text-base text-stone-900">Versi Mobile Customer App</h2>
                        <p class="text-xs text-stone-500">Emulasi Layar: iPhone 14 Pro (430 × 932 px, 60 FPS)</p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('guest.mobile') }}" target="_blank" class="px-4 py-2 rounded-xl bg-[#FAF7F2] hover:bg-[#F3EAD8] text-stone-900 border border-[#DEC8A4] font-bold text-xs uppercase tracking-wider transition flex items-center space-x-1.5">
                        <i data-lucide="external-link" class="w-3.5 h-3.5 text-[#8A6319]"></i>
                        <span>Buka Live Mobile</span>
                    </a>
                    <a href="{{ asset('videos/rekam-layar-mobile.mp4') }}" download="rekam-layar-mobile-senyum-stay.mp4" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-sm hover:scale-105 transition flex items-center space-x-1.5">
                        <i data-lucide="download" class="w-3.5 h-3.5"></i>
                        <span>Unduh MP4</span>
                    </a>
                    <a href="{{ asset('videos/rekam-layar-mobile.webm') }}" download="rekam-layar-mobile-senyum-stay.webm" class="px-3 py-2 rounded-xl bg-stone-900 hover:bg-stone-800 text-stone-300 font-bold text-xs uppercase tracking-wider transition flex items-center space-x-1">
                        <i data-lucide="download" class="w-3.5 h-3.5"></i>
                        <span>WebM</span>
                    </a>
                </div>
            </div>

            <!-- Video Player Display Container -->
            <div class="bg-[#140E06] rounded-3xl p-4 sm:p-8 border border-amber-500/30 shadow-2xl space-y-6">
                <div class="flex items-center justify-between text-xs text-amber-200/80 pb-3 border-b border-white/10">
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                        <span class="w-3 h-3 rounded-full bg-green-500"></span>
                        <span class="ml-2 font-mono text-[11px] text-stone-300">iPhone 14 Pro Walkthrough &bull; Reel Video Hotel &bull; Kartu VIP Gold/Platinum &bull; QR & Barcode</span>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full bg-red-500/20 text-red-300 text-[10px] font-bold uppercase tracking-wider flex items-center space-x-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-400 animate-ping"></span>
                        <span>HD Mobile</span>
                    </span>
                </div>

                <!-- Video Frame -->
                <div class="max-w-[420px] mx-auto rounded-3xl overflow-hidden border-4 border-[#2A2012] shadow-2xl bg-black">
                    <video id="demoMobileVideoPlayer" 
                           controls 
                           autoplay 
                           loop 
                           muted 
                           playsinline 
                           class="w-full h-auto object-cover block">
                        <source src="{{ asset('videos/rekam-layar-mobile.mp4') }}" type="video/mp4">
                        <source src="{{ asset('videos/rekam-layar-mobile.webm') }}" type="video/webm">
                        Peramban Anda tidak mendukung pemutar video HTML5.
                    </video>
                </div>

                <div class="text-center text-xs text-stone-400">
                    Fitur Mobile: Video header interaktif &bull; Kartu loyalitas rasio presisi web &bull; Filter hadiah 100/500 poin &bull; Copy e-voucher &bull; Kalkulator simulasi.
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 2: REKAMAN WEB DESKTOP (FULL HD 1080P) -->
        <!-- ========================================== -->
        <div id="video-panel-web" class="space-y-6 hidden">
            <div class="flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-[#E8DFC8] shadow-sm">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-[#8A6319] flex items-center justify-center font-bold">
                        <i data-lucide="monitor" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-sm sm:text-base text-stone-900">Versi Portal Web Desktop</h2>
                        <p class="text-xs text-stone-500">Resolusi Desktop: Full HD 1440 × 900 (Background Gedung 80% HD & Member Hub)</p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('guest.points') }}" target="_blank" class="px-4 py-2 rounded-xl bg-[#FAF7F2] hover:bg-[#F3EAD8] text-stone-900 border border-[#DEC8A4] font-bold text-xs uppercase tracking-wider transition flex items-center space-x-1.5">
                        <i data-lucide="external-link" class="w-3.5 h-3.5 text-[#8A6319]"></i>
                        <span>Buka Live Web</span>
                    </a>
                    <a href="{{ asset('videos/rekam-layar-web.mp4') }}" download="rekam-layar-web-senyum-stay.mp4" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-sm hover:scale-105 transition flex items-center space-x-1.5">
                        <i data-lucide="download" class="w-3.5 h-3.5"></i>
                        <span>Unduh MP4</span>
                    </a>
                    <a href="{{ asset('videos/rekam-layar-web.webm') }}" download="rekam-layar-web-senyum-stay.webm" class="px-3 py-2 rounded-xl bg-stone-900 hover:bg-stone-800 text-stone-300 font-bold text-xs uppercase tracking-wider transition flex items-center space-x-1">
                        <i data-lucide="download" class="w-3.5 h-3.5"></i>
                        <span>WebM</span>
                    </a>
                </div>
            </div>

            <!-- Video Player Display Container Desktop -->
            <div class="bg-[#140E06] rounded-3xl p-4 sm:p-8 border border-amber-500/30 shadow-2xl space-y-6">
                <div class="flex items-center justify-between text-xs text-amber-200/80 pb-3 border-b border-white/10">
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                        <span class="w-3 h-3 rounded-full bg-green-500"></span>
                        <span class="ml-2 font-mono text-[11px] text-stone-300">Desktop Viewport &bull; Full HD Hero Gedung 80% &bull; Panel Highlight Poin Baru &bull; Member Hub Gold</span>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-[10px] font-bold uppercase tracking-wider flex items-center space-x-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>Desktop 1080p</span>
                    </span>
                </div>

                <!-- Video Frame Desktop 16:9 -->
                <div class="w-full rounded-2xl overflow-hidden border-4 border-[#2A2012] shadow-2xl bg-black">
                    <video id="demoWebVideoPlayer" 
                           controls 
                           autoplay 
                           loop 
                           muted 
                           playsinline 
                           class="w-full h-auto object-cover block aspect-video">
                        <source src="{{ asset('videos/rekam-layar-web.mp4') }}" type="video/mp4">
                        <source src="{{ asset('videos/rekam-layar-web.webm') }}" type="video/webm">
                        Peramban Anda tidak mendukung pemutar video HTML5.
                    </video>
                </div>

                <div class="text-center text-xs text-stone-400">
                    Fitur Desktop: Drone intro cinematic &bull; Latar gedung 80% Full HD tajam &bull; Kartu highlight poin kontras tinggi &bull; Form pencarian member langsung &bull; WhatsApp concierge terintegrasi.
                </div>
            </div>
        </div>

        <!-- Walkthrough Highlights Table / Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-4">
            <div class="p-6 rounded-3xl bg-white border border-[#E8DFC8] shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-amber-500/15 text-[#8A6319] flex items-center justify-center">
                    <i data-lucide="credit-card" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-base text-stone-900">Kartu VIP Digital 3D (Rasio Web Asli)</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    Tampilan kartu fisik resmi (Silver, Gold, Platinum) dengan nomor unik member, badge poin dinamis, QR Code, dan barcode scan front-desk.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-[#E8DFC8] shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-amber-500/15 text-[#8A6319] flex items-center justify-center">
                    <i data-lucide="gift" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-base text-stone-900">Katalog Penukaran Hadiah & E-Voucher</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    Katalog hadiah dengan filter 100, 500, dan 1.000 poin, modal konfirmasi penukaran live, serta penyimpanan e-voucher aktif dengan tombol salin instan.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-[#E8DFC8] shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-amber-500/15 text-[#8A6319] flex items-center justify-center">
                    <i data-lucide="image" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-base text-stone-900">Hero Background Gedung 80% HD & Video Intro</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    Tampilan foto gedung Full HD tanpa pecah dengan visibilitas 80%, gradasi pelindung tipografi, kartu highlight poin kontras tinggi, dan video compro hotel yang memukau.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-[#E8DFC8] shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-amber-500/15 text-[#8A6319] flex items-center justify-center">
                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-base text-stone-900">WhatsApp Concierge Resmi {{ config('hotel.whatsapp_display') }}</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    Layanan concierge dan pemesanan Free Shuttle Stasiun Tugu yang terhubung langsung ke WhatsApp resmi Grand Senyum Hotel baik di versi mobile maupun desktop.
                </p>
            </div>
        </div>

    </div>
</div>

<script>
function switchVideoTab(tab) {
    const mobilePanel = document.getElementById('video-panel-mobile');
    const webPanel = document.getElementById('video-panel-web');
    const mobileBtn = document.getElementById('tab-btn-mobile');
    const webBtn = document.getElementById('tab-btn-web');

    const mobileVideo = document.getElementById('demoMobileVideoPlayer');
    const webVideo = document.getElementById('demoWebVideoPlayer');

    if (tab === 'mobile') {
        mobilePanel.classList.remove('hidden');
        webPanel.classList.add('hidden');

        mobileBtn.className = "px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 flex items-center space-x-2 bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 shadow-md";
        webBtn.className = "px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 flex items-center space-x-2 text-stone-700 hover:text-stone-950";

        if (webVideo) webVideo.pause();
        if (mobileVideo) mobileVideo.play();
    } else {
        webPanel.classList.remove('hidden');
        mobilePanel.classList.add('hidden');

        webBtn.className = "px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 flex items-center space-x-2 bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 shadow-md";
        mobileBtn.className = "px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 flex items-center space-x-2 text-stone-700 hover:text-stone-950";

        if (mobileVideo) mobileVideo.pause();
        if (webVideo) webVideo.play();
    }
}
</script>
@endsection
