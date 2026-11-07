@extends('layouts.app')

@section('title', __('Rewards Redemption Catalog') . ' - Senyum Stay Priority')

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
            <i data-lucide="gift" class="w-4 h-4 text-[#D4AF37]"></i>
            <span>{{ __('Exclusive Rewards Collection') }}</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-serif font-black tracking-tight text-white uppercase drop-shadow">
            {{ __('Rewards Catalog') }} & <span class="gold-shimmer">{{ __('Exclusive Rewards Redemption') }}</span>
        </h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            {{ __('Redeem your accumulated stay & event points for exclusive Grand Senyum Hotel merchandise souvenirs, dining vouchers, electric bicycle rentals, or complimentary luxury room stays.') }}
        </p>

        <!-- Quick Action Breadcrumb / CTA -->
        <div class="pt-3 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('guest.points') }}" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-md hover:scale-105 transition flex items-center space-x-2">
                <i data-lucide="search" class="w-3.5 h-3.5"></i>
                <span>{{ __('Check Your Point Balance') }}</span>
            </a>
            <a href="{{ route('guest.earn') }}" class="px-6 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs uppercase tracking-wider transition flex items-center space-x-2">
                <i data-lucide="calculator" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                <span>{{ __('How to Earn More Points') }}</span>
            </a>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- REWARDS REDEMPTION CATALOG SECTION                       -->
<!-- ======================================================== -->
<section class="py-16 sm:py-24 bg-[#FAF3E3]/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Tabs: All Rewards / 100 Points / 500 Points / 1,000 Points -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
            <button type="button" onclick="filterCatalog('all')" id="catalog-tab-all" class="catalog-tab-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-stone-950 text-white shadow-md transition">
                {{ __('All Rewards') }}
            </button>
            <button type="button" onclick="filterCatalog(100)" id="catalog-tab-100" class="catalog-tab-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#FFFDF9] text-stone-700 hover:bg-[#F5ECD8] border border-[#DEC8A4] shadow-sm transition">
                100 {{ __('Points') }}
            </button>
            <button type="button" onclick="filterCatalog(500)" id="catalog-tab-500" class="catalog-tab-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#FFFDF9] text-stone-700 hover:bg-[#F5ECD8] border border-[#DEC8A4] shadow-sm transition">
                500 {{ __('Points') }}
            </button>
            <button type="button" onclick="filterCatalog(1000)" id="catalog-tab-1000" class="catalog-tab-btn px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#FFFDF9] text-stone-700 hover:bg-[#F5ECD8] border border-[#DEC8A4] shadow-sm transition">
                {{ __('1,000 Points (Free Stay)') }}
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
                                {{ __($item['badge']) }}
                            </span>
                            <span class="font-mono font-black text-sm text-[#8A6319]">100 {{ __('Points') }}</span>
                        </div>
                        <h4 class="font-serif font-black text-stone-900 text-lg mt-3">{{ __($item['title']) }}</h4>
                        <p class="text-xs text-stone-700 mt-1.5 leading-relaxed">{{ __($item['detail']) }}</p>
                    </div>

                    <div class="pt-4 border-t border-[#E8DFC8]">
                        <a href="{{ route('guest.points') }}" 
                           class="w-full py-3 px-4 rounded-xl bg-stone-900 hover:bg-stone-800 text-white font-bold text-xs uppercase tracking-wider transition flex items-center justify-center space-x-1.5">
                            <span>{{ __('Check Points & Redeem') }}</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            @endforeach

            <!-- Category 500 Pts Items -->
            @foreach($redeemCatalog[500]['items'] as $item)
                <div class="catalog-card catalog-tier-500 p-6 rounded-3xl bg-[#FFFDF9] border border-[#DEC8A4] hover:border-[#D4AF37] hover:shadow-xl transition-all flex flex-col justify-between space-y-5">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-[#E8DFC8]">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#FAF3E3] text-[#7A5210] border border-[#D4AF37]">
                                {{ __($item['badge']) }}
                            </span>
                            <span class="font-mono font-black text-sm text-[#8A6319]">500 {{ __('Points') }}</span>
                        </div>
                        <h4 class="font-serif font-black text-stone-900 text-lg mt-3">{{ __($item['title']) }}</h4>
                        <p class="text-xs text-stone-700 mt-1.5 leading-relaxed">{{ __($item['detail']) }}</p>
                        @if(!empty($item['options']))
                            <div class="mt-2.5 p-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] text-[11px] text-[#8A6319] font-medium">
                                <span class="font-bold block text-stone-900 mb-0.5">{{ __('Merchandise Options:') }}</span>
                                {{ implode(', ', array_map(fn($opt) => __($opt), $item['options'])) }}
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-[#E8DFC8]">
                        <a href="{{ route('guest.points') }}" 
                           class="w-full py-3 px-4 rounded-xl bg-stone-900 hover:bg-stone-800 text-white font-bold text-xs uppercase tracking-wider transition flex items-center justify-center space-x-1.5">
                            <span>{{ __('Check Points & Redeem') }}</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            @endforeach

            <!-- Category 1.000 Pts Item (Free Room Stay) -->
            @foreach($redeemCatalog[1000]['items'] as $item)
                <div class="catalog-card catalog-tier-1000 md:col-span-2 lg:col-span-3 p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-[#FAF3E3] via-[#FFFDF9] to-[#F5EAD4] border-2 border-[#D4AF37] shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-3">
                        <div class="flex items-center space-x-2">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 uppercase tracking-widest font-serif">
                                {{ __($item['badge']) }}
                            </span>
                            <span class="font-mono font-black text-sm text-[#8A6319]">1,000 {{ __('Points') }}</span>
                        </div>
                        <h4 class="font-serif font-black text-2xl text-stone-900">{{ __($item['title']) }}</h4>
                        <p class="text-xs sm:text-sm text-stone-700 max-w-2xl leading-relaxed">{{ __($item['detail']) }}</p>
                    </div>

                    <div class="shrink-0 text-right">
                        <a href="{{ route('guest.points') }}" 
                           class="w-full md:w-auto px-8 py-3.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] hover:brightness-105 text-slate-950 font-serif font-bold text-xs uppercase tracking-wider shadow-lg transition flex items-center justify-center space-x-2">
                            <span>{{ __('Access Account & Redeem') }}</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</section>

<!-- Concierge Assistance Section -->
<section class="py-16 sm:py-20 bg-gradient-to-b from-[#FAF3E3] to-[#FAF7F2]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="p-8 sm:p-12 rounded-3xl bg-[#1C1408] text-white border border-[#3D2C12] shadow-2xl flex flex-col lg:flex-row items-center justify-between gap-8 relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-[#D4AF37]/10 blur-3xl pointer-events-none"></div>

            <div class="space-y-4 max-w-2xl relative z-10 text-center lg:text-left">
                <span class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-amber-500/20 text-[#EBD195] border border-amber-500/30">
                    <i data-lucide="phone-call" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                    <span>{{ __('24/7 Concierge Service') }}</span>
                </span>
                <h3 class="text-2xl sm:text-4xl font-serif font-black text-white">
                    {{ __('Need Help with Reward Redemption?') }}
                </h3>
                <p class="text-xs sm:text-sm text-stone-300 leading-relaxed">
                    {{ __('Contact our reception staff or concierge if you need custom voucher assistance, physical merchandise delivery to your room, or dining table reservations.') }}
                </p>
            </div>

            <div class="shrink-0 flex flex-col sm:flex-row items-center gap-3 relative z-10">
                <a href="https://wa.me/{{ config('hotel.whatsapp') }}?text={{ urlencode('Hello Concierge Grand Senyum Hotel, I would like to inquire about redeeming my reward points.') }}" target="_blank" rel="noopener noreferrer" 
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
</script>
@endpush
@endsection
