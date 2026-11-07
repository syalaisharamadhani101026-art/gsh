@extends('layouts.app')

@section('title', __('About') . ' Senyum Stay Priority - Grand Senyum Hotel Yogyakarta')

@section('content')
<!-- Page Header Banner -->
<div class="relative bg-gradient-to-b from-[#1C1408] via-[#2A1D0B] to-[#140E06] text-white py-14 sm:py-20 border-b border-[#3D2C12] overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-30">
        <img src="{{ asset('images/hero-building.jpg') }}" alt="Grand Senyum Hotel" class="w-full h-full object-cover">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#140E06] via-[#140E06]/40 to-transparent"></div>
    <div class="absolute -top-20 -left-20 w-80 h-80 rounded-full bg-[#D4AF37]/15 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
        <div class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-amber-500/20 text-[#EBD195] border border-amber-500/30 backdrop-blur-md">
            <i data-lucide="gem" class="w-4 h-4 text-[#D4AF37]"></i>
            <span>{{ __('Bespoke Yogyakarta Hospitality') }}</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-serif font-black tracking-tight text-white uppercase drop-shadow">
            {{ __('About') }} <span class="gold-shimmer">Senyum Stay Priority</span>
        </h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            {{ __('Specially crafted for distinguished guests who appreciate refined hospitality in the heart of Yogyakarta. Our three core pillars guarantee that every stay and event becomes a treasured memory.') }}
        </p>

        <!-- Quick Action Breadcrumb / CTA -->
        <div class="pt-3 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('guest.points') }}" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-md hover:scale-105 transition flex items-center space-x-2">
                <i data-lucide="search" class="w-3.5 h-3.5"></i>
                <span>{{ __('Check Your Member Points') }}</span>
            </a>
            <a href="{{ route('guest.tiers') }}" class="px-6 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs uppercase tracking-wider transition flex items-center space-x-2">
                <i data-lucide="award" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                <span>{{ __('Explore Membership Tiers') }}</span>
            </a>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- 3 CORE PILLARS OF SENYUM STAY PRIORITY                  -->
<!-- ======================================================== -->
<section class="py-16 sm:py-24 bg-[#FAF7F2]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-[#F5EDDE] text-[#7A5210] border border-[#DEC8A4]">
                <i data-lucide="crown" class="w-3.5 h-3.5 text-[#B8860B]"></i>
                <span>{{ __('Our Program Philosophy') }}</span>
            </span>
            <h2 class="text-3xl sm:text-4xl font-serif font-black text-stone-900 tracking-tight">
                {{ __('Three Pillars of Unmatched Hospitality') }}
            </h2>
            <p class="text-stone-700 text-sm sm:text-base leading-relaxed">
                {{ __('Senyum Stay Priority was designed to give every loyal guest a seamless journey from booking, staying, hosting grand events, to redeeming bespoke privileges.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            
            <!-- Pillar 1 -->
            <div class="p-8 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-md hover:shadow-xl hover:border-[#D4AF37] transition-all space-y-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md">
                    <i data-lucide="hotel" class="w-7 h-7"></i>
                </div>
                <h3 class="font-serif font-black text-xl text-stone-900">{{ __('Bespoke Hospitality') }}</h3>
                <p class="text-xs sm:text-sm text-stone-700 leading-relaxed">
                    @if(app()->getLocale() === 'id')
                        Lokasi utama di <a href="{{ config('hotel.maps_url', 'https://www.google.com/maps/search/?api=1&query=Grand+Senyum+Hotel+Yogyakarta') }}" target="_blank" rel="noopener noreferrer" class="text-[#8A6319] hover:underline font-semibold inline-flex items-center gap-1">Jalan Pangeran Diponegoro No.27 <i data-lucide="external-link" class="w-3 h-3 inline"></i></a>, dekat Monumen Tugu dan Malioboro. Nikmati kenyamanan istimewa dengan antar-jemput gratis Stasiun Tugu, prioritas early check-in, dan late check-out.
                    @else
                        Prime location on <a href="{{ config('hotel.maps_url', 'https://www.google.com/maps/search/?api=1&query=Grand+Senyum+Hotel+Yogyakarta') }}" target="_blank" rel="noopener noreferrer" class="text-[#8A6319] hover:underline font-semibold inline-flex items-center gap-1">Jalan Pangeran Diponegoro No.27 <i data-lucide="external-link" class="w-3 h-3 inline"></i></a>, near Tugu Monument and Malioboro. Enjoy bespoke comfort with complimentary Tugu station pick-up, early check-in, and late check-out.
                    @endif
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="p-8 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-md hover:shadow-xl hover:border-[#D4AF37] transition-all space-y-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md">
                    <i data-lucide="coins" class="w-7 h-7"></i>
                </div>
                <h3 class="font-serif font-black text-xl text-stone-900">{{ __('Genuine Point Rewards') }}</h3>
                <p class="text-xs sm:text-sm text-stone-700 leading-relaxed">
                    @if(app()->getLocale() === 'id')
                        Dapatkan poin otomatis dari setiap malam menginap mulai dari tipe Grand Deluxe hingga President Suite, ditambah hadiah poin banquet revenue (+10 Poin per Rp 1.000.000 untuk meeting, pesta pernikahan, dan perayaan).
                    @else
                        Earn points automatically from every room night across Grand Deluxe to President Suite, plus generous banquet revenue rewards (+10 Pts per IDR 1,000,000 spent on meetings, weddings, and celebrations).
                    @endif
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="p-8 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-md hover:shadow-xl hover:border-[#D4AF37] transition-all space-y-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-black shadow-md">
                    <i data-lucide="gift" class="w-7 h-7"></i>
                </div>
                <h3 class="font-serif font-black text-xl text-stone-900">{{ __('Exclusive Rewards Redemption') }}</h3>
                <p class="text-xs sm:text-sm text-stone-700 leading-relaxed">
                    @if(app()->getLocale() === 'id')
                        Tukarkan poin Anda dengan mudah untuk souvenir resmi GSH, voucher makan di restoran hotel, sewa sepeda listrik santai di sekitar Yogyakarta, dan kamar menginap mewah gratis.
                    @else
                        Redeem your points effortlessly for exclusive GSH souvenirs, gourmet restaurant dining vouchers, fun electric bicycle rentals around Yogyakarta, and complimentary luxury room stays.
                    @endif
                </p>
            </div>

        </div>

        <!-- Location & Atmosphere Showcase Card -->
        <div class="bg-[#FFFDF9] rounded-3xl border border-[#DEC8A4] p-8 sm:p-12 shadow-lg">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-5">
                    <span class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-[#F5EDDE] text-[#7A5210] border border-[#DEC8A4]">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#B8860B]"></i>
                        <span>{{ __('Strategic Prime Location') }}</span>
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-serif font-black text-stone-900 tracking-tight">
                        {{ __('Located in the Heart of Heritage Yogyakarta') }}
                    </h3>
                    <p class="text-sm text-stone-700 leading-relaxed">
                        {{ __('Grand Senyum Hotel stands prestigiously on Jalan Pangeran Diponegoro, moments away from Tugu Yogyakarta, the legendary Malioboro Street, and Tugu Train Station. Whether traveling for leisure or corporate events, Senyum Stay Priority ensures your time with us is marked by effortless distinction.') }}
                    </p>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2">
                        <div class="p-3.5 rounded-2xl bg-[#FAF6EE] border border-[#DEC8A4]">
                            <span class="text-xs font-bold text-stone-900 block">{{ __('3 Mins to Tugu') }}</span>
                            <span class="text-[11px] text-stone-600">{{ __('Yogyakarta Landmark') }}</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-[#FAF6EE] border border-[#DEC8A4]">
                            <span class="text-xs font-bold text-stone-900 block">{{ __('Free Pick-up') }}</span>
                            <span class="text-[11px] text-stone-600">{{ __('Tugu Train Station') }}</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-[#FAF6EE] border border-[#DEC8A4]">
                            <span class="text-xs font-bold text-stone-900 block">{{ __('5 Mins to Malioboro') }}</span>
                            <span class="text-[11px] text-stone-600">{{ __('Heritage Shopping') }}</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="relative rounded-3xl overflow-hidden border-2 border-[#D4AF37] shadow-xl aspect-video lg:aspect-square">
                        <img src="{{ asset('images/hero-building.jpg') }}" alt="Grand Senyum Hotel Yogyakarta" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-6">
                            <div class="text-white">
                                <span class="text-xs uppercase font-bold tracking-wider text-[#F5DE93] block">Grand Senyum Hotel Yogyakarta</span>
                                <span class="text-xs text-stone-200">Jl. Pangeran Diponegoro No.27, Jetis, Kota Yogyakarta</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Concierge Assistance Section -->
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
                <a href="{{ route('guest.points') }}" 
                   class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-serif font-bold text-xs uppercase tracking-wider flex items-center justify-center space-x-2 transition">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    <span>{{ __('Check Points Now') }}</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
