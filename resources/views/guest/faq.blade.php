@extends('layouts.app')

@section('title', __('Frequently Asked Questions') . ' - Senyum Stay Priority')

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
            <i data-lucide="help-circle" class="w-4 h-4 text-[#D4AF37]"></i>
            <span>{{ __('Help & Information Center') }}</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-serif font-black tracking-tight text-white uppercase drop-shadow">
            {{ __('Frequently Asked') }} <span class="gold-shimmer">{{ __('Questions') }}</span>
        </h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            {{ __('Everything you need to know about point accumulation rules, member tier privileges, station pick-up requests, and voucher redemption procedures.') }}
        </p>

        <!-- Quick Action Breadcrumb / CTA -->
        <div class="pt-3 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('guest.points') }}" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-md hover:scale-105 transition flex items-center space-x-2">
                <i data-lucide="search" class="w-3.5 h-3.5"></i>
                <span>{{ __('Check Your Member Status') }}</span>
            </a>
            <a href="{{ route('guest.tiers') }}" class="px-6 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs uppercase tracking-wider transition flex items-center space-x-2">
                <i data-lucide="award" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                <span>{{ __('View Membership Tiers') }}</span>
            </a>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- FAQ ACCORDION SECTION                                    -->
<!-- ======================================================== -->
<section class="py-16 sm:py-24 bg-[#FAF7F2]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="space-y-4">
            
            <!-- FAQ 1 -->
            <div class="faq-item rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-sm overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full px-6 py-5 text-left flex items-center justify-between text-sm sm:text-base font-bold text-stone-900 hover:text-[#8A6319] transition">
                    <span class="flex items-center space-x-3">
                        <i data-lucide="sparkles" class="w-4 h-4 text-[#D4AF37] shrink-0"></i>
                        <span>{{ __('How do I enroll in Senyum Stay Priority membership?') }}</span>
                    </span>
                    <i data-lucide="chevron-down" id="faq-icon-1" class="w-4 h-4 text-[#8A6319] transition-transform duration-300 shrink-0"></i>
                </button>
                <div id="faq-content-1" class="hidden px-6 pb-6 pt-1 text-xs sm:text-sm text-stone-700 border-t border-[#E8DFC8] leading-relaxed">
                    {{ __('Every guest reserving a room or holding an event at Grand Senyum Hotel Yogyakarta is automatically enrolled into Senyum Stay Priority with a unique member number (GSH-xxxx format). Simply enter your full name or mobile phone number in the search form to verify your points and tier status.') }}
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="faq-item rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-sm overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full px-6 py-5 text-left flex items-center justify-between text-sm sm:text-base font-bold text-stone-900 hover:text-[#8A6319] transition">
                    <span class="flex items-center space-x-3">
                        <i data-lucide="calculator" class="w-4 h-4 text-[#D4AF37] shrink-0"></i>
                        <span>{{ __('How many points do I earn from room stays and banquet events?') }}</span>
                    </span>
                    <i data-lucide="chevron-down" id="faq-icon-2" class="w-4 h-4 text-[#8A6319] transition-transform duration-300 shrink-0"></i>
                </button>
                <div id="faq-content-2" class="hidden px-6 pb-6 pt-1 text-xs sm:text-sm text-stone-700 border-t border-[#E8DFC8] leading-relaxed">
                    {{ __('For room reservations: Grand Deluxe (10 pts/night), Grand Executive (15 pts/night), Royal Suite (20 pts/night), and President Suite (30 pts/night). For banquet & ballroom events: You earn +10 Points for every IDR 1,000,000 in qualifying revenue (applies in multiples).') }}
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="faq-item rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-sm overflow-hidden">
                <button type="button" onclick="toggleFaq(3)" class="w-full px-6 py-5 text-left flex items-center justify-between text-sm sm:text-base font-bold text-stone-900 hover:text-[#8A6319] transition">
                    <span class="flex items-center space-x-3">
                        <i data-lucide="shield" class="w-4 h-4 text-[#D4AF37] shrink-0"></i>
                        <span>{{ __('Is there a maximum point accumulation limit for each tier?') }}</span>
                    </span>
                    <i data-lucide="chevron-down" id="faq-icon-3" class="w-4 h-4 text-[#8A6319] transition-transform duration-300 shrink-0"></i>
                </button>
                <div id="faq-content-3" class="hidden px-6 pb-6 pt-1 text-xs sm:text-sm text-stone-700 border-t border-[#E8DFC8] leading-relaxed">
                    {{ __('Yes, to preserve exclusivity: Silver members have a maximum accumulation cap of 1,000 Points, Gold members have a cap of 5,000 Points, and Platinum members have an accumulation cap of 10,000 Points. When approaching your tier cap, you are encouraged to redeem points for merchandise, dining vouchers, or free room stays.') }}
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="faq-item rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-sm overflow-hidden">
                <button type="button" onclick="toggleFaq(4)" class="w-full px-6 py-5 text-left flex items-center justify-between text-sm sm:text-base font-bold text-stone-900 hover:text-[#8A6319] transition">
                    <span class="flex items-center space-x-3">
                        <i data-lucide="train" class="w-4 h-4 text-[#D4AF37] shrink-0"></i>
                        <span>{{ __('How do I claim Tugu Station pick-up & E-Bike privileges?') }}</span>
                    </span>
                    <i data-lucide="chevron-down" id="faq-icon-4" class="w-4 h-4 text-[#8A6319] transition-transform duration-300 shrink-0"></i>
                </button>
                <div id="faq-content-4" class="hidden px-6 pb-6 pt-1 text-xs sm:text-sm text-stone-700 border-t border-[#E8DFC8] leading-relaxed">
                    {{ __('Complimentary Tugu Station transfers and 1-hour free E-Bike privileges are reserved for Gold and Platinum members. You may confirm your train arrival schedule with our Concierge team via official WhatsApp at least 24 hours prior to arrival.') }}
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="faq-item rounded-3xl bg-[#FFFDF9] border border-[#E6DAC3] shadow-sm overflow-hidden">
                <button type="button" onclick="toggleFaq(5)" class="w-full px-6 py-5 text-left flex items-center justify-between text-sm sm:text-base font-bold text-stone-900 hover:text-[#8A6319] transition">
                    <span class="flex items-center space-x-3">
                        <i data-lucide="ticket" class="w-4 h-4 text-[#D4AF37] shrink-0"></i>
                        <span>{{ __('How do I use my reward redemption E-Voucher?') }}</span>
                    </span>
                    <i data-lucide="chevron-down" id="faq-icon-5" class="w-4 h-4 text-[#8A6319] transition-transform duration-300 shrink-0"></i>
                </button>
                <div id="faq-content-5" class="hidden px-6 pb-6 pt-1 text-xs sm:text-sm text-stone-700 border-t border-[#E8DFC8] leading-relaxed">
                    {{ __('After successfully redeeming points in the catalog, the system issues an official E-Voucher with a unique code. Simply display the code on your smartphone or print the voucher when visiting the Front Desk or Grand Senyum Hotel restaurant.') }}
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
                    {{ __('Still Have Questions?') }}
                </h3>
                <p class="text-xs sm:text-sm text-stone-300 leading-relaxed">
                    {{ __('Grand Senyum Hotel reservation and Front Desk staff are at your service 24 hours a day for any membership inquiries, booking adjustments, or assistance.') }}
                </p>
            </div>

            <div class="shrink-0 flex flex-col sm:flex-row items-center gap-3 relative z-10">
                <a href="https://wa.me/{{ config('hotel.whatsapp') }}?text={{ urlencode('Hello Concierge Grand Senyum Hotel, I have a question about the membership program.') }}" target="_blank" rel="noopener noreferrer" 
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

@push('scripts')
<script>
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
</script>
@endpush
@endsection
