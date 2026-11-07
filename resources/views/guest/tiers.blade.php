@extends('layouts.app')

@section('title', __('Membership Tiers & Privileges') . ' - Senyum Stay Priority')

@section('content')
<!-- Page Header Banner -->
<div class="relative bg-gradient-to-b from-[#1C1408] via-[#2A1D0B] to-[#140E06] text-white py-14 sm:py-20 border-b border-[#3D2C12] overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-25">
        <img src="{{ asset('images/hero-building.jpg') }}" alt="Grand Senyum Hotel" class="w-full h-full object-cover">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#140E06] via-transparent to-transparent"></div>
    <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full bg-[#D4AF37]/15 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
        <div class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-amber-500/20 text-[#EBD195] border border-amber-500/30 backdrop-blur-md">
            <i data-lucide="award" class="w-4 h-4 text-[#D4AF37]"></i>
            <span>{{ __('Guest Membership Tiers') }}</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-serif font-black tracking-tight text-white uppercase drop-shadow">
            {{ __('Membership Tiers') }} & <span class="gold-shimmer">{{ __('VIP Tiers') }}</span>
        </h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            {{ __('The more frequently you stay and host events at Grand Senyum Hotel Yogyakarta, the higher tier privileges and rewards you will enjoy.') }}
        </p>

        <!-- Quick Action Breadcrumb / CTA -->
        <div class="pt-3 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('guest.points') }}" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 font-bold text-xs uppercase tracking-wider shadow-md hover:scale-105 transition flex items-center space-x-2">
                <i data-lucide="search" class="w-3.5 h-3.5"></i>
                <span>{{ __('Check Your Tier & Points') }}</span>
            </a>
            <a href="{{ route('guest.catalog') }}" class="px-6 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs uppercase tracking-wider transition flex items-center space-x-2">
                <i data-lucide="gift" class="w-3.5 h-3.5 text-[#D4AF37]"></i>
                <span>{{ __('Explore Rewards Catalog') }}</span>
            </a>
        </div>
    </div>
</div>

<!-- ======================================================== -->
<!-- MEMBERSHIP TIERS & BENEFIT MATRIX                        -->
<!-- ======================================================== -->
<section class="py-16 sm:py-24 bg-[#FAF3E3]/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- 3 Simple & Aesthetic VIP Cards Showcase -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-14">
            
            <!-- 1. SILVER PRIORITY CARD & DETAILS -->
            <div class="space-y-5 flex flex-col justify-between">
                <div class="relative w-full aspect-[1011/639] rounded-3xl overflow-hidden border border-slate-400/40 shadow-2xl shadow-slate-900/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-slate-900/50 group">
                    <img src="{{ asset('images/cards/card-silver.jpg') }}" alt="Silver Member Card" class="absolute inset-0 w-full h-full object-cover">

                    <div class="absolute left-[5.5%] top-[65.2%] text-left pointer-events-none select-none z-10">
                        <div class="text-[11px] sm:text-[13px] font-sans font-semibold tracking-[0.08em] uppercase text-stone-700 leading-tight">
                            SILVER MEMBER
                        </div>
                        <div class="text-[13px] sm:text-[16px] font-sans font-semibold tracking-[0.14em] text-stone-800 mt-1 leading-tight">
                            GSH 2610 1088
                        </div>
                        <div class="text-[8px] sm:text-[9.5px] font-sans font-light tracking-[0.06em] text-stone-500 mt-2 leading-tight">
                            {{ app()->getLocale() === 'id' ? 'BERLAKU S/D' : 'VALID THRU' }} 11/27
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-[#FFFDF9] border border-[#DEC8A4] shadow-md flex-1 flex flex-col justify-between space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between pb-2.5 border-b border-[#E8DFC8]">
                            <div>
                                <span class="text-[10px] uppercase font-serif font-bold text-stone-600 tracking-wider">{{ __('Entry Tier') }}</span>
                                <h3 class="text-xl font-serif font-black text-stone-900">{{ __('Silver Member') }}</h3>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-stone-200 text-stone-800">
                                ( 0 – {{ app()->getLocale() === 'id' ? '1.000 Poin' : '1,000 Points' }} )
                            </span>
                        </div>

                        <p class="text-xs text-stone-700 leading-relaxed">
                            {{ __('Introductory membership for every registered guest. Enjoy instant dining discounts across all hotel restaurants.') }}
                        </p>

                        <div class="space-y-1.5 pt-2 border-t border-[#E8DFC8] text-xs text-stone-800">
                            @foreach($tiers['Silver']['benefits'] as $b)
                                <div class="flex items-start space-x-2 font-medium">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
                                    <span>{{ __($b) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-3 border-t border-[#E8DFC8]">
                        <span class="text-[11px] text-stone-600 block">{{ __('Maximum Points Limit:') }} <strong>1,000 {{ __('Points') }}</strong></span>
                    </div>
                </div>
            </div>

            <!-- 2. GOLD PRIORITY CARD & DETAILS -->
            <div class="space-y-5 flex flex-col justify-between">
                <div class="relative w-full aspect-[1011/639] rounded-3xl overflow-hidden border-2 border-[#d6ac57] shadow-2xl shadow-amber-950/40 transition-all duration-300 hover:-translate-y-2 hover:shadow-amber-950/60 group">
                    <img src="{{ asset('images/cards/card-gold.jpg') }}" alt="Gold Member Card" class="absolute inset-0 w-full h-full object-cover">

                    <div class="absolute left-[5.5%] top-[65.2%] text-left pointer-events-none select-none z-10">
                        <div class="text-[11px] sm:text-[13px] font-sans font-semibold tracking-[0.08em] uppercase text-amber-100 leading-tight drop-shadow-sm">
                            GOLD MEMBER
                        </div>
                        <div class="text-[13px] sm:text-[16px] font-sans font-semibold tracking-[0.14em] text-white mt-1 leading-tight drop-shadow-sm">
                            GSH 2610 5022
                        </div>
                        <div class="text-[8px] sm:text-[9.5px] font-sans font-light tracking-[0.06em] text-amber-200/80 mt-2 leading-tight">
                            {{ app()->getLocale() === 'id' ? 'BERLAKU S/D' : 'VALID THRU' }} 11/27
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-[#FFFDF9] border-2 border-[#d6ac57] shadow-xl relative overflow-hidden flex-1 flex flex-col justify-between space-y-4">
                    <div class="absolute top-0 right-0 bg-gradient-to-l from-[#d6ac57] to-[#b38a36] text-slate-950 font-serif font-bold text-[9px] uppercase tracking-widest px-3.5 py-0.5 rounded-bl-xl shadow-sm">
                        {{ __('Popular') }}
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between pb-2.5 border-b border-[#DEC8A4]">
                            <div>
                                <span class="text-[10px] uppercase font-serif font-bold text-[#8A6319] tracking-wider">{{ __('Mid Tier') }}</span>
                                <h3 class="text-xl font-serif font-black text-stone-900">{{ __('Gold Member') }}</h3>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-[#d6ac57] to-[#b38a36] text-slate-950">
                                ( {{ app()->getLocale() === 'id' ? '1.000 – 5.000 Poin' : '1,000 – 5,000 Points' }} )
                            </span>
                        </div>

                        <p class="text-xs text-stone-700 leading-relaxed">
                            {{ __('Enjoy complimentary Tugu Station transfers, direct booking discounts, early check-in, and room upgrades.') }}
                        </p>

                        <div class="space-y-1.5 pt-2 border-t border-[#DEC8A4] text-xs text-stone-800">
                            @foreach($tiers['Gold']['benefits'] as $b)
                                <div class="flex items-start space-x-2 font-medium">
                                    <i data-lucide="check" class="w-4 h-4 text-[#d6ac57] shrink-0 mt-0.5"></i>
                                    <span>{{ __($b) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-3 border-t border-[#DEC8A4]">
                        <span class="text-[11px] text-amber-950 font-semibold block">{{ __('Maximum Points Limit:') }} <strong>5,000 {{ __('Points') }}</strong></span>
                    </div>
                </div>
            </div>

            <!-- 3. PLATINUM VIP PRIORITY CARD & DETAILS -->
            <div class="space-y-5 flex flex-col justify-between">
                <div class="relative w-full aspect-[1011/639] rounded-3xl overflow-hidden border-2 border-amber-400/40 shadow-2xl shadow-stone-950/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-stone-950/70 group">
                    <img src="{{ asset('images/cards/card-platinum.jpg') }}" alt="Platinum Member Card" class="absolute inset-0 w-full h-full object-cover">

                    <div class="absolute left-[5.5%] top-[65.2%] text-left pointer-events-none select-none z-10">
                        <div class="text-[11px] sm:text-[13px] font-sans font-semibold tracking-[0.08em] uppercase text-stone-200 leading-tight">
                            PLATINUM VIP
                        </div>
                        <div class="text-[13px] sm:text-[16px] font-sans font-semibold tracking-[0.14em] text-[#d6ac57] mt-1 leading-tight">
                            GSH 2610 8888
                        </div>
                        <div class="text-[8px] sm:text-[9.5px] font-sans font-light tracking-[0.06em] text-stone-400 mt-2 leading-tight">
                            {{ app()->getLocale() === 'id' ? 'BERLAKU S/D' : 'VALID THRU' }} 11/27
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-[#FFFDF9] border-2 border-[#A881D4] shadow-xl relative overflow-hidden flex-1 flex flex-col justify-between space-y-4">
                    <div class="absolute top-0 right-0 bg-indigo-600 text-white font-serif font-bold text-[9px] uppercase tracking-widest px-3.5 py-0.5 rounded-bl-xl shadow-sm">
                        {{ __('Highest') }}
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between pb-2.5 border-b border-[#DEC6F5]">
                            <div>
                                <span class="text-[10px] uppercase font-serif font-bold text-indigo-900 tracking-wider">{{ __('Highest Tier') }}</span>
                                <h3 class="text-xl font-serif font-black text-stone-900">{{ __('Platinum VIP') }}</h3>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-500 text-white">
                                ( {{ app()->getLocale() === 'id' ? '5.000 – 10.000 Poin' : '5,000 – 10,000 Points' }} )
                            </span>
                        </div>

                        <p class="text-xs text-stone-700 leading-relaxed">
                            {{ __('The pinnacle of luxury appreciation featuring a complimentary annual 1-night stay, birthday cake, special gift, and premier benefits.') }}
                        </p>

                        <div class="space-y-1.5 pt-2 border-t border-[#DEC6F5] text-xs text-stone-800">
                            @foreach($tiers['Platinum']['benefits'] as $b)
                                <div class="flex items-start space-x-2 font-medium">
                                    <i data-lucide="check" class="w-4 h-4 text-indigo-600 shrink-0 mt-0.5"></i>
                                    <span>{{ __($b) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-3 border-t border-[#DEC6F5]">
                        <span class="text-[11px] text-indigo-950 font-semibold block">{{ __('Maximum Accumulation Limit:') }} <strong>10,000 {{ __('Points') }}</strong></span>
                    </div>
                </div>
            </div>

        </div>

        <!-- WHEEL OF FORTUNE (LUCKY DRAW 5G GOLD PRIZE) -->
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
                            <span>{{ __('Grand Annual Lucky Draw') }}</span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-serif font-black text-stone-900 tracking-tight">
                            {{ __('Wheel of Fortune') }}
                        </h3>
                        <p class="text-sm sm:text-base text-stone-800 font-semibold">
                            {{ __('Earn a minimum of 5,000 points for a chance to win a 5-gram pure gold prize!') }}
                        </p>
                        <p class="text-xs text-stone-600 italic">
                            {{ __('*The lucky draw takes place at the end of each year for active eligible members.') }}
                        </p>
                    </div>
                </div>

                <div class="shrink-0">
                    <div class="px-6 py-3.5 rounded-2xl bg-[#1e1709] text-white border border-[#D4AF37]/50 shadow-md text-center">
                        <span class="text-[10px] uppercase tracking-widest text-[#D4AF37] font-bold block">{{ __('Grand Prize') }}</span>
                        <span class="text-lg font-serif font-black text-[#F5DE93]">{{ __('5-Gram Pure Gold Bar') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comprehensive Side-by-Side Comparison Matrix -->
        <div class="bg-[#FFFDF9] rounded-3xl border border-[#DEC8A4] p-6 sm:p-8 shadow-lg">
            <h3 class="font-serif font-black text-xl text-stone-900 mb-4 pb-2 border-b border-[#E8DFC8] flex items-center">
                <i data-lucide="table-2" class="w-5 h-5 mr-2 text-[#8A6319]"></i>
                {{ __('Complete Member Privileges & Benefits Comparison Matrix') }}
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm text-stone-800">
                    <thead class="bg-[#F5EDE0] text-xs font-bold uppercase tracking-wider text-stone-900 border-b border-[#D8C9AF]">
                        <tr>
                            <th class="px-4 py-3.5">{{ __('Member Benefits & Privileges') }}</th>
                            <th class="px-4 py-3.5 text-center">Silver (0 – {{ app()->getLocale() === 'id' ? '1.000 Poin' : '1,000 Points' }})</th>
                            <th class="px-4 py-3.5 text-center bg-[#FAF3E3]">Gold ({{ app()->getLocale() === 'id' ? '1.000 – 5.000 Poin' : '1,000 – 5,000 Points' }})</th>
                            <th class="px-4 py-3.5 text-center">Platinum ({{ app()->getLocale() === 'id' ? '5.000 – 10.000 Poin' : '5,000 – 10,000 Points' }})</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EAE0CD]">
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('Discount on F&B') }}</td>
                            <td class="px-4 py-3 text-center font-bold text-stone-900">5%</td>
                            <td class="px-4 py-3 text-center font-bold text-amber-900 bg-[#FAF3E3]">10%</td>
                            <td class="px-4 py-3 text-center font-bold text-indigo-950">15%</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('Laundry Benefit / Discount') }}</td>
                            <td class="px-4 py-3 text-center font-bold text-stone-900">{{ __('IDR 10,000 Disc') }}</td>
                            <td class="px-4 py-3 text-center font-bold text-amber-900 bg-[#FAF3E3]">{{ __('Free 3 Pieces') }}<div class="text-[10px] font-normal text-stone-600">{{ __('(1 Top, 1 Bottom, 1 Undergarment)') }}</div></td>
                            <td class="px-4 py-3 text-center font-bold text-indigo-950">{{ __('Free 5 Pieces') }}<div class="text-[10px] font-normal text-stone-600">{{ __('(1 Top, 1 Bottom, 3 Undergarments)') }}</div></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('Discount on Room Rates (Direct Booking)') }}</td>
                            <td class="px-4 py-3 text-center font-bold text-stone-900">{{ app()->getLocale() === 'id' ? 'Rp 25.000' : 'IDR 25,000' }}</td>
                            <td class="px-4 py-3 text-center font-bold text-amber-900 bg-[#FAF3E3]">{{ app()->getLocale() === 'id' ? 'Rp 50.000' : 'IDR 50,000' }}</td>
                            <td class="px-4 py-3 text-center font-bold text-indigo-950">{{ app()->getLocale() === 'id' ? 'Rp 100.000' : 'IDR 100,000' }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('Early Check-in & Late Check-out Privileges') }}</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600 bg-[#FAF3E3]"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('Complimentary Pick-up & Drop-off at Tugu Train Station') }}</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600 bg-[#FAF3E3]"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('Complimentary Room Upgrade (Subject to Availability)') }}</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600 bg-[#FAF3E3]"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('Complimentary E-Bike for 1 Hour') }}</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center font-bold text-amber-900 bg-[#FAF3E3]">{{ __('1 Person') }}</td>
                            <td class="px-4 py-3 text-center font-bold text-indigo-950">{{ __('Up to 2 Persons') }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('VIP Treatment') }}</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600 bg-[#FAF3E3]"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('Complimentary Birthday Cake') }}</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-stone-400 bg-[#FAF3E3]">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('Special Gift') }}</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-stone-400 bg-[#FAF3E3]">-</td>
                            <td class="px-4 py-3 text-center text-emerald-600"><i data-lucide="check" class="w-4 h-4 mx-auto"></i></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('Complimentary Room for 1 Night Stay Annually') }}</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-stone-400 bg-[#FAF3E3]">-</td>
                            <td class="px-4 py-3 text-center font-bold text-indigo-950 bg-indigo-50/50">{{ __('1 Night Annually') }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ __('Wheel of Fortune (Grand Lucky Draw 5g Gold)') }}</td>
                            <td class="px-4 py-3 text-center text-stone-400">-</td>
                            <td class="px-4 py-3 text-center text-stone-400 bg-[#FAF3E3]">-</td>
                            <td class="px-4 py-3 text-center font-bold text-amber-700 bg-amber-50/60"><i data-lucide="sparkles" class="w-4 h-4 mx-auto text-[#B8860B]"></i>{{ __('Min. 5.000 Pts') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
                    {{ __('Need Assistance with Your Tier Upgrade?') }}
                </h3>
                <p class="text-xs sm:text-sm text-stone-300 leading-relaxed">
                    {{ __('Grand Senyum Hotel reservation and Front Desk staff are at your service 24 hours a day for tier inquiries, station transfer bookings, and room reservations.') }}
                </p>
            </div>

            <div class="shrink-0 flex flex-col sm:flex-row items-center gap-3 relative z-10">
                <a href="https://wa.me/{{ config('hotel.whatsapp') }}?text={{ urlencode('Hello Concierge Grand Senyum Hotel, I would like to inquire about Membership Tiers and Senyum Stay Priority.') }}" target="_blank" rel="noopener noreferrer" 
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
