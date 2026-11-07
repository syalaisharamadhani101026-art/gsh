@extends('layouts.app')

@section('title', __('How to Earn Points') . ' - Senyum Stay Priority')

@section('content')
<!-- Page Header Banner -->
<div class="relative bg-gradient-to-b from-[#1C1408] via-[#2A1D0B] to-[#140E06] text-white py-14 sm:py-20 border-b border-[#3D2C12] overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-25">
        <img src="{{ asset('images/hero-building.jpg') }}" alt="Grand Senyum Hotel" class="w-full h-full object-cover">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#140E06] via-[#140E06]/40 to-transparent"></div>
    <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full bg-[#D4AF37]/15 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
        <div class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-amber-500/20 text-[#EBD195] border border-amber-500/30 backdrop-blur-md">
            <i data-lucide="calculator" class="w-4 h-4 text-[#D4AF37]"></i>
            <span>{{ __('Point Accumulation Structure') }}</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-serif font-black tracking-tight text-white uppercase drop-shadow">
            {{ __('How to Earn') }} <span class="gold-shimmer">{{ __('Member Points') }}</span>
        </h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            {{ __('Points are earned automatically from your room reservations per night, as well as meetings, weddings, and banquet events hosted at Grand Senyum Hotel Yogyakarta.') }}
        </p>

        <!-- Quick Action Breadcrumb / CTA -->
        <div class="pt-3 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('guest.points') }}" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-md hover:scale-105 transition flex items-center space-x-2">
                <i data-lucide="search" class="w-3.5 h-3.5"></i>
                <span>{{ __('Check Your Point Balance') }}</span>
            </a>
            <a href="{{ route('guest.catalog') }}" class="px-6 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs uppercase tracking-wider transition flex items-center space-x-2">
                <i data-lucide="gift" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                <span>{{ __('See What You Can Redeem') }}</span>
            </a>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- HOW TO EARN POINTS (ROOM & BANQUET)                      -->
<!-- ======================================================== -->
<section class="py-16 sm:py-24 bg-[#FAF7F2]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch mb-12">
            
            <!-- Room Stays Point Rates -->
            <div class="p-6 sm:p-8 rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-md flex flex-col justify-between space-y-6">
                <div>
                    <div class="flex items-center space-x-3 pb-3 border-b border-[#E8DFC8] mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-bold shadow-sm">
                            <i data-lucide="bed-double" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] block font-serif">{{ __('Hotel Rooms') }}</span>
                            <h3 class="font-serif font-bold text-stone-900 text-lg">{{ __('Points Value from Rooms (Per Night)') }}</h3>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($roomRates as $room => $pts)
                            <div class="p-4 rounded-2xl bg-[#FAF6EE] border border-[#D8C9AF] flex items-center justify-between">
                                <div>
                                    <span class="text-xs text-stone-600 block">{{ __('Room Category') }}</span>
                                    <h4 class="font-serif font-bold text-stone-900 text-sm">{{ $room }}</h4>
                                </div>
                                <div class="text-right">
                                    <span class="font-mono font-black text-lg text-[#8A6319]">+{{ $pts }}</span>
                                    <span class="text-[10px] text-stone-600 block uppercase font-bold">{{ __('Points / Night') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-[#F5EDE0] text-xs text-stone-700 space-y-1">
                    <p class="font-bold text-stone-900 flex items-center"><i data-lucide="info" class="w-3.5 h-3.5 mr-1 text-[#8A6319]"></i> {{ __('Room Reservation Terms:') }}</p>
                    <p>{{ __('Points are automatically credited to your member account upon check-out processing by the hotel reception.') }}</p>
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
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#8A6319] block font-serif">{{ __('Banquet & Events') }}</span>
                            <h3 class="font-serif font-bold text-stone-900 text-lg">{{ __('Points Value from Banquet Revenue') }}</h3>
                        </div>
                    </div>

                    <div class="p-6 rounded-3xl bg-gradient-to-br from-[#FAF3E3] via-[#FFFDF9] to-[#F5EAD4] border-2 border-[#D4AF37] space-y-4">
                        <div class="flex items-baseline justify-between">
                            <span class="text-xs uppercase font-serif font-bold text-[#8A6319]">{{ __('Banquet Calculation') }}</span>
                            <span class="font-mono font-black text-2xl text-[#8A6319]">{{ __('+10 Points') }}</span>
                        </div>
                        <p class="font-serif font-bold text-stone-900 text-base">
                            {{ __('Earn 10 Points for every IDR 1,000,000 in qualifying banquet revenue') }}
                        </p>
                        <p class="text-xs text-stone-700 leading-relaxed">
                            {{ __('Applies in full multiples for ballroom bookings, meeting packages, weddings, and gala dinners.') }}
                        </p>

                        <!-- Example Calculations -->
                        <div class="grid grid-cols-3 gap-2 pt-2 border-t border-[#DEC8A4] text-center text-xs">
                            <div class="p-2.5 rounded-xl bg-[#FFFDF9] border border-[#DEC8A4]">
                                <span class="text-[10px] text-stone-600 block">{{ __('IDR 5 Million') }}</span>
                                <span class="font-bold text-[#8A6319]">{{ __('50 Pts') }}</span>
                            </div>
                            <div class="p-2.5 rounded-xl bg-[#FFFDF9] border border-[#DEC8A4]">
                                <span class="text-[10px] text-stone-600 block">{{ __('IDR 20 Million') }}</span>
                                <span class="font-bold text-[#8A6319]">{{ __('200 Pts') }}</span>
                            </div>
                            <div class="p-2.5 rounded-xl bg-[#FFFDF9] border border-[#DEC8A4]">
                                <span class="text-[10px] text-stone-600 block">{{ __('IDR 50 Million') }}</span>
                                <span class="font-bold text-[#8A6319]">{{ __('500 Pts') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-[#F5EDE0] text-xs text-stone-700 space-y-1">
                    <p class="font-bold text-stone-900 flex items-center"><i data-lucide="info" class="w-3.5 h-3.5 mr-1 text-[#8A6319]"></i> {{ __('Banquet Event Terms:') }}</p>
                    <p>{{ __('Points are calculated based on official billing before tax and service charge, applicable for direct bookings with Grand Senyum Hotel banquet sales team.') }}</p>
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
                    {{ __('Questions Regarding Your Stay Points?') }}
                </h3>
                <p class="text-xs sm:text-sm text-stone-300 leading-relaxed">
                    {{ __('Our Front Desk and reservation team are ready to assist you anytime with point verification, stay history records, or banquet point crediting.') }}
                </p>
            </div>

            <div class="shrink-0 flex flex-col sm:flex-row items-center gap-3 relative z-10">
                <a href="https://wa.me/{{ config('hotel.whatsapp') }}?text={{ urlencode('Hello Concierge Grand Senyum Hotel, I would like to inquire about my stay points calculation.') }}" target="_blank" rel="noopener noreferrer" 
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
