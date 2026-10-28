@extends('layouts.admin')

@section('title', 'Admin Dashboard - Senyum Stay Priority | Grand Senyum Hotel')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-10 space-y-8">

    <!-- Admin Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-[#DEC8A4]">
        <div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-[#F5EDDE] text-[#7A5210] border border-[#DEC8A4]">
                    Administrator Front Desk
                </span>
            </div>
            <h1 class="text-2xl sm:text-4xl font-serif font-extrabold text-stone-900 tracking-tight mt-1.5">
                Pencatatan Reservasi & Poin Tamu
            </h1>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('guest.points') }}" target="_blank" class="inline-flex items-center px-4 py-2.5 rounded-xl border border-[#D8C9AF] bg-[#FFFDF9] hover:bg-[#F5ECD8] text-stone-800 text-xs font-bold uppercase tracking-wider shadow-sm transition">
                <i data-lucide="external-link" class="w-3.5 h-3.5 mr-2 text-[#8A6319]"></i>
                Buka Portal Tamu
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards (4 Metrics) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-[#FFFDF9] p-5 rounded-3xl border border-[#E6DAC3] shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-2xl bg-[#FAF3E2] flex items-center justify-center text-[#8A6319] shrink-0 border border-[#DEC8A4]">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-xs uppercase font-bold text-stone-600 tracking-wider block">Total Member</span>
                <span class="text-2xl font-serif font-black text-stone-900">{{ number_format($stats['total_guests']) }}</span>
            </div>
        </div>

        <div class="bg-[#FFFDF9] p-5 rounded-3xl border border-[#E6DAC3] shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-2xl bg-[#FAF6EE] flex items-center justify-center text-stone-700 shrink-0 border border-[#D8C9AF]">
                <i data-lucide="shield" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-xs uppercase font-bold text-stone-600 tracking-wider block">Silver Member</span>
                <span class="text-2xl font-serif font-black text-stone-900">{{ number_format($stats['silver_guests']) }}</span>
            </div>
        </div>

        <div class="bg-[#FFFDF9] p-5 rounded-3xl border border-[#E6DAC3] shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-2xl bg-[#FBF3E2] flex items-center justify-center text-[#8A6319] shrink-0 border border-[#DEC8A4]">
                <i data-lucide="crown" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-xs uppercase font-bold text-[#8A6319] tracking-wider block">Gold & Platinum</span>
                <span class="text-2xl font-serif font-black text-stone-900">{{ number_format($stats['gold_guests'] + $stats['platinum_guests']) }}</span>
            </div>
        </div>

        <div class="bg-[#FFFDF9] p-5 rounded-3xl border border-[#E6DAC3] shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-700 shrink-0 border border-emerald-200">
                <i data-lucide="coins" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-xs uppercase font-bold text-stone-600 tracking-wider block">Total Poin Masuk</span>
                <span class="text-2xl font-serif font-black text-emerald-700">{{ number_format($stats['total_points_distributed']) }}</span>
            </div>
        </div>
    </div>

    {{-- General Success Alert --}}
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-950 flex items-center space-x-3 text-sm shadow-sm">
            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- General Error Alert --}}
    @if(session('error'))
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-300 text-rose-950 flex items-center space-x-3 text-sm shadow-sm">
            <i data-lucide="alert-octagon" class="w-5 h-5 text-rose-600 shrink-0"></i>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Alert Success Flash Data -->
    @if(session('stay_result'))
        @php $res = session('stay_result'); @endphp
        <div class="p-6 rounded-3xl bg-emerald-50 border border-emerald-200 shadow-sm space-y-4">
            <div class="flex items-start justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                        <i data-lucide="check" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-serif font-bold text-emerald-950 text-base sm:text-lg">
                            Transaksi Poin Berhasil Diproses!
                        </h3>
                        <p class="text-xs text-emerald-800">
                            Tamu: <strong>{{ $res['guest_name'] }}</strong> &bull; No. Member: <span class="font-mono font-bold">{{ $res['member_number'] }}</span>
                            @if($res['is_new_guest'])
                                <span class="ml-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-200 text-emerald-950 uppercase">Tamu Baru Didaftarkan</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 rounded-2xl bg-[#FFFDF9] border border-emerald-100 text-xs">
                <div>
                    <span class="text-[10px] text-stone-600 uppercase tracking-wider block">Transaksi</span>
                    <span class="font-bold text-stone-900 text-sm">
                        @if($res['transaction_type'] === 'banquet')
                            Revenue Banquet (Rp {{ number_format($res['revenue_amount']) }})
                        @else
                            {{ $res['room_type'] }} ({{ $res['nights'] }} Malam)
                        @endif
                    </span>
                </div>
                <div>
                    <span class="text-[10px] text-stone-600 uppercase tracking-wider block">Poin Dihitung</span>
                    <span class="font-bold text-stone-900 text-sm">+{{ number_format($res['points_earned']) }} Poin</span>
                </div>
                <div>
                    <span class="text-[10px] text-stone-600 uppercase tracking-wider block">Poin Riil Masuk</span>
                    <span class="font-bold text-emerald-600 text-base">+{{ number_format($res['points_added']) }} Poin</span>
                </div>
                <div>
                    <span class="text-[10px] text-stone-600 uppercase tracking-wider block">Total Saldo Tamu</span>
                    <span class="font-bold text-[#8A6319] text-base">{{ number_format($res['points_after']) }} Poin</span>
                </div>
            </div>

            @if($res['is_capped'])
                <div class="p-3.5 rounded-2xl bg-amber-50 border border-amber-300 text-xs text-amber-900 flex items-start space-x-2.5">
                    <i data-lucide="shield-alert" class="w-4 h-4 text-amber-600 shrink-0 mt-0.5"></i>
                    <div>
                        <span class="font-bold">Batas Maksimal Diterapkan:</span> {{ $res['capped_message'] }}
                    </div>
                </div>
            @endif

            @if($res['tier_upgraded'])
                <div class="p-3.5 rounded-2xl bg-indigo-50 border border-indigo-200 text-xs text-indigo-900 flex items-start space-x-2.5">
                    <i data-lucide="award" class="w-4 h-4 text-indigo-600 shrink-0 mt-0.5"></i>
                    <div>
                        <span class="font-bold">Tier Naik!</span> Tamu berhasil naik dari tier <strong>{{ $res['tier_before'] }}</strong> ke tier <strong>{{ $res['tier_after'] }}</strong>!
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- ADMIN SLIDE TABS (Slide 1, Slide 2, Slide 3, Slide 4) -->
    <div class="bg-[#EFE8D9] p-1.5 rounded-2xl border border-[#DCD0B8] flex items-center gap-1.5 overflow-x-auto">
        <button type="button" onclick="goToAdminSlide(1)" id="admin-tab-1" 
                class="admin-tab-btn flex-1 min-w-[200px] py-2.5 px-4 rounded-xl text-xs font-bold transition-all duration-200 flex items-center justify-center space-x-2 bg-[#FFFDF9] text-stone-950 shadow-sm border border-[#D8C9AF]">
            <i data-lucide="edit-3" class="w-4 h-4 text-[#8A6319]"></i>
            <span>Slide 1: Input Transaksi & Poin</span>
        </button>
        <button type="button" onclick="goToAdminSlide(2)" id="admin-tab-2" 
                class="admin-tab-btn flex-1 min-w-[200px] py-2.5 px-4 rounded-xl text-xs font-semibold text-stone-700 hover:text-stone-950 hover:bg-[#F8F4EB] transition-all duration-200 flex items-center justify-center space-x-2">
            <i data-lucide="history" class="w-4 h-4 text-stone-600"></i>
            <span>Slide 2: Riwayat Transaksi ({{ $recentStays->count() }})</span>
        </button>
        <button type="button" onclick="goToAdminSlide(3)" id="admin-tab-3" 
                class="admin-tab-btn flex-1 min-w-[200px] py-2.5 px-4 rounded-xl text-xs font-semibold text-stone-700 hover:text-stone-950 hover:bg-[#F8F4EB] transition-all duration-200 flex items-center justify-center space-x-2">
            <i data-lucide="users" class="w-4 h-4 text-stone-600"></i>
            <span>Slide 3: Direktori Member & Ubah Tier</span>
        </button>
        <button type="button" onclick="goToAdminSlide(4)" id="admin-tab-4" 
                class="admin-tab-btn flex-1 min-w-[200px] py-2.5 px-4 rounded-xl text-xs font-semibold text-stone-700 hover:text-stone-950 hover:bg-[#F8F4EB] transition-all duration-200 flex items-center justify-center space-x-2">
            <i data-lucide="gift" class="w-4 h-4 text-stone-600"></i>
            <span>Slide 4: Voucher & Klaim Hadiah ({{ $recentRedemptions->count() }})</span>
        </button>
    </div>

    <!-- ADMIN SLIDE 1: FORMULIR INPUT TRANSAKSI (KAMAR / BANQUET) -->
    <div id="admin-slide-1" class="admin-slide-content">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Input Form (Col 8) -->
            <div class="lg:col-span-8 bg-[#FFFDF9] rounded-3xl border border-[#E6DAC3] p-6 sm:p-8 shadow-sm">
                <div class="flex items-center space-x-3 pb-5 border-b border-[#E8DFC8] mb-6">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-bold">
                        <i data-lucide="plus" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-serif font-bold text-stone-900">Formulir Input Poin Tamu</h2>
                    </div>
                </div>

                <form action="{{ route('admin.stay.store') }}" method="POST" id="stayForm" class="space-y-6">
                    @csrf

                    <!-- Section 1: Guest Information -->
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[#8A6319] mb-3">1. Informasi Tamu</h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Phone Input -->
                            <div>
                                <label for="admin_phone" class="block text-xs font-bold text-stone-800 uppercase tracking-wider mb-1.5">
                                    Nomor Handphone <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="tel" 
                                           id="admin_phone" 
                                           name="phone" 
                                           value="{{ old('phone') }}" 
                                           placeholder="Contoh: 081234567890" 
                                           required 
                                           autocomplete="off"
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] text-stone-900 text-sm outline-none transition">
                                    <i data-lucide="phone" class="w-4 h-4 text-[#8A6319] absolute left-3.5 top-3"></i>
                                </div>
                                @error('phone')
                                    <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Name Input -->
                            <div>
                                <label for="admin_name" class="block text-xs font-bold text-stone-800 uppercase tracking-wider mb-1.5">
                                    Nama Lengkap Tamu <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" 
                                           id="admin_name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Masukkan nama lengkap tamu" 
                                           required 
                                           autocomplete="off"
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] text-stone-900 text-sm outline-none transition">
                                    <i data-lucide="user" class="w-4 h-4 text-[#8A6319] absolute left-3.5 top-3"></i>
                                </div>
                                @error('name')
                                    <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Dynamic Guest Status Box -->
                        <div id="guestStatusBox" class="mt-3.5 p-3.5 rounded-2xl bg-[#FAF6EE] border border-[#D8C9AF] text-xs flex items-center justify-between transition-all">
                            <div class="flex items-center space-x-2">
                                <span id="guestStatusIcon" class="w-2.5 h-2.5 rounded-full bg-[#D8C9AF]"></span>
                                <span id="guestStatusText" class="text-stone-600">
                                    Ketik nomor HP atau nama untuk cek status member...
                                </span>
                            </div>
                            <span id="guestMemberBadge" class="font-mono font-bold text-[#8A6319]">
                                Auto: {{ $nextMemberNumber }}
                            </span>
                        </div>
                    </div>

                    <!-- Section 2: Transaction Type & Details -->
                    <div class="pt-5 border-t border-[#E8DFC8]">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-[#8A6319] mb-3">2. Jenis Transaksi & Rincian</h3>
                        
                        <!-- Transaction Type Toggle -->
                        <div class="mb-4">
                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="transaction_type" value="room" id="type_room" checked onchange="toggleTransactionType()" class="peer sr-only">
                                    <div class="p-3.5 rounded-2xl border-2 border-[#D8C9AF] peer-checked:border-[#C89B3C] peer-checked:bg-[#FAF3E2] flex items-center space-x-3 transition">
                                        <i data-lucide="bed-double" class="w-5 h-5 text-[#8A6319] shrink-0"></i>
                                        <div>
                                            <p class="font-bold text-stone-900 text-xs">Reservasi Kamar</p>
                                            <p class="text-[11px] text-stone-600">Poin dihitung per malam</p>
                                        </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="transaction_type" value="banquet" id="type_banquet" onchange="toggleTransactionType()" class="peer sr-only">
                                    <div class="p-3.5 rounded-2xl border-2 border-[#D8C9AF] peer-checked:border-[#C89B3C] peer-checked:bg-[#FAF3E2] flex items-center space-x-3 transition">
                                        <i data-lucide="coins" class="w-5 h-5 text-[#8A6319] shrink-0"></i>
                                        <div>
                                            <p class="font-bold text-stone-900 text-xs">Revenue Banquet</p>
                                            <p class="text-[11px] text-stone-600">10 Poin / Rp 1.000.000</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Booking Code / Invoice -->
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label for="booking_code" id="code_label" class="block text-xs font-bold text-stone-800 uppercase tracking-wider">
                                        Kode Booking <span class="text-rose-500">*</span>
                                    </label>
                                    <button type="button" onclick="generateBookingCode()" class="text-[11px] text-[#8A6319] hover:text-[#5E3F0A] font-semibold flex items-center">
                                        <i data-lucide="refresh-cw" class="w-3 h-3 mr-1"></i> Buat Acak
                                    </button>
                                </div>
                                <div class="relative">
                                    <input type="text" 
                                           id="booking_code" 
                                           name="booking_code" 
                                           value="{{ old('booking_code') }}" 
                                           placeholder="Contoh: BK-98214" 
                                           required 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] text-stone-900 font-mono uppercase text-sm outline-none transition">
                                    <i data-lucide="bookmark" class="w-4 h-4 text-[#8A6319] absolute left-3.5 top-3"></i>
                                </div>
                                @error('booking_code')
                                    <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date Input -->
                            <div>
                                <label for="stay_date" id="date_label" class="block text-xs font-bold text-stone-800 uppercase tracking-wider mb-1.5">
                                    Tanggal Check-in
                                </label>
                                <div class="relative">
                                    <input type="date" 
                                           id="stay_date" 
                                           name="stay_date" 
                                           value="{{ old('stay_date', date('Y-m-d')) }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] text-stone-900 text-sm outline-none transition">
                                    <i data-lucide="calendar" class="w-4 h-4 text-[#8A6319] absolute left-3.5 top-3"></i>
                                </div>
                            </div>

                            <!-- Room Fields Group -->
                            <div id="room_fields_container" class="contents">
                                <!-- Room Type -->
                                <div>
                                    <label for="room_type" class="block text-xs font-bold text-stone-800 uppercase tracking-wider mb-1.5">
                                        Tipe Kamar <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select id="room_type" 
                                                name="room_type" 
                                                onchange="calculateLivePoints()"
                                                class="w-full pl-10 pr-8 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] text-stone-900 text-sm outline-none transition appearance-none">
                                            @foreach($roomRates as $type => $rate)
                                                <option value="{{ $type }}" data-rate="{{ $rate }}" {{ old('room_type', 'Grand Deluxe') === $type ? 'selected' : '' }}>
                                                    {{ $type }} ({{ $rate }} Point/malam)
                                                </option>
                                            @endforeach
                                        </select>
                                        <i data-lucide="bed-double" class="w-4 h-4 text-[#8A6319] absolute left-3.5 top-3"></i>
                                        <i data-lucide="chevron-down" class="w-4 h-4 text-stone-500 absolute right-3.5 top-3 pointer-events-none"></i>
                                    </div>
                                    @error('room_type')
                                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nights -->
                                <div>
                                    <label for="nights" class="block text-xs font-bold text-stone-800 uppercase tracking-wider mb-1.5">
                                        Jumlah Malam <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number" 
                                               id="nights" 
                                               name="nights" 
                                               min="1" 
                                               max="365" 
                                               value="{{ old('nights', 1) }}" 
                                               oninput="calculateLivePoints()"
                                               class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] text-stone-900 text-sm outline-none transition">
                                        <i data-lucide="moon" class="w-4 h-4 text-[#8A6319] absolute left-3.5 top-3"></i>
                                    </div>
                                    @error('nights')
                                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Banquet Fields Group (Hidden by default) -->
                            <div id="banquet_fields_container" class="hidden sm:col-span-2">
                                <label for="revenue_amount" class="block text-xs font-bold text-stone-800 uppercase tracking-wider mb-1.5">
                                    Nominal Revenue Banquet (Rp) <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" 
                                           id="revenue_amount" 
                                           name="revenue_amount" 
                                           min="1000000" 
                                           step="500000"
                                           value="{{ old('revenue_amount', 10000000) }}" 
                                           placeholder="Contoh: 10000000"
                                           oninput="calculateLivePoints()"
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] text-stone-900 text-sm outline-none transition font-mono font-semibold">
                                    <i data-lucide="coins" class="w-4 h-4 text-[#8A6319] absolute left-3.5 top-3"></i>
                                </div>
                                <span class="text-[11px] text-[#8A6319] font-semibold block mt-1">
                                    * Kelipatan Rp 1.000.000,- otomatis menghasilkan +10 Point.
                                </span>
                                @error('revenue_amount')
                                    <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mt-4">
                            <label for="notes" class="block text-xs font-bold text-stone-800 uppercase tracking-wider mb-1.5">
                                Catatan Tambahan (Opsional)
                            </label>
                            <input type="text" 
                                   id="notes" 
                                   name="notes" 
                                   value="{{ old('notes') }}" 
                                   placeholder="Contoh: Acara Wedding Ballroom, Direct booking, dll" 
                                   class="w-full px-4 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] focus:bg-white focus:ring-2 focus:ring-[#C89B3C] focus:border-[#C89B3C] text-stone-900 text-sm outline-none transition">
                        </div>

                        <!-- Auto Upgrade Checkbox Option -->
                        <div class="mt-4 p-4 rounded-2xl bg-[#FAF6EE] border border-[#D8C9AF]">
                            <label class="flex items-start space-x-3 cursor-pointer">
                                <input type="checkbox" 
                                       name="auto_upgrade" 
                                       value="1" 
                                       id="auto_upgrade" 
                                       onchange="calculateLivePoints()"
                                       {{ old('auto_upgrade') ? 'checked' : '' }}
                                       class="mt-1 rounded border-[#D8C9AF] text-[#8A6319] focus:ring-[#C89B3C]">
                                <div>
                                    <span class="text-xs font-bold text-stone-900">
                                        Otomatis Naikkan Tier Jika Poin Mencapai Batas Maksimal
                                    </span>
                                    <p class="text-[11px] text-stone-600 mt-0.5 leading-relaxed">
                                        Bila dicentang, tamu Silver yang mencapai 1.000 poin akan otomatis naik ke Gold (kuota 5.000). Tamu Gold yang mencapai 5.000 poin akan naik ke Platinum (kuota 10.000). Jika tidak dicentang, poin akan dibatasi tepat di batas maksimal tier saat ini.
                                    </p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#D4AF37] via-[#DFB85B] to-[#B8860B] hover:from-[#B8860B] hover:to-[#D4AF37] text-stone-950 font-serif font-bold text-sm tracking-wider uppercase shadow-md shadow-amber-900/10 transition flex items-center justify-center space-x-2">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Simpan Transaksi & Tambah Poin Tamu</span>
                    </button>
                </form>
            </div>

            <!-- Live Calculation Preview Card (Col 4) -->
            <div class="lg:col-span-4 space-y-6">
                
                <div class="bg-gradient-to-b from-[#241A0B] to-[#160F06] text-white rounded-3xl p-6 shadow-xl border border-[#6F511E]">
                    <div class="flex items-center space-x-2 text-[10px] font-serif font-bold uppercase tracking-widest text-amber-400 mb-4 pb-3 border-b border-[#4D3815]">
                        <i data-lucide="calculator" class="w-4 h-4"></i>
                        <span>Simulasi Kalkulasi Poin</span>
                    </div>

                    <div class="space-y-4 text-xs sm:text-sm">
                        <div class="flex justify-between items-center text-amber-100/80">
                            <span id="calc_rate_label">Tarif Poin Kamar:</span>
                            <span id="calc_rate" class="font-bold text-white">10 poin/malam</span>
                        </div>

                        <div class="flex justify-between items-center text-amber-100/80">
                            <span id="calc_dur_label">Durasi Menginap:</span>
                            <span id="calc_nights" class="font-bold text-white">1 Malam</span>
                        </div>

                        <div class="flex justify-between items-center pt-2 border-t border-[#4D3815]">
                            <span class="text-amber-300 font-semibold font-serif">Poin Dari Transaksi:</span>
                            <span id="calc_earned" class="font-serif font-bold text-amber-400 text-lg">+10 Poin</span>
                        </div>

                        <div class="p-4 rounded-2xl bg-[#2D210F]/90 border border-[#4D3815] space-y-2.5 text-xs">
                            <div class="flex justify-between text-amber-100/80">
                                <span>Status Tamu:</span>
                                <span id="calc_tier" class="font-bold text-white">Silver (Baru)</span>
                            </div>
                            <div class="flex justify-between text-amber-100/80">
                                <span>Saldo Saat Ini:</span>
                                <span id="calc_current_points" class="font-bold text-white">0 Poin</span>
                            </div>
                            <div class="flex justify-between text-amber-100/80">
                                <span>Batas Maksimal Tier:</span>
                                <span id="calc_max_points" class="font-bold text-amber-300">1.000 Poin</span>
                            </div>
                            <div class="flex justify-between text-amber-100 font-bold pt-2 border-t border-[#4D3815] text-sm">
                                <span>Proyeksi Saldo Baru:</span>
                                <span id="calc_projected_total" class="font-serif font-bold text-emerald-400">10 Poin</span>
                            </div>
                        </div>

                        <!-- Capping Alert Box -->
                        <div id="calc_cap_warning" class="hidden p-3.5 rounded-2xl bg-amber-500/20 border border-amber-400/40 text-amber-300 text-xs flex items-start space-x-2">
                            <i data-lucide="alert-triangle" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                            <span id="calc_cap_warning_text">
                                Poin melebihi batas maksimal tier dan akan dipotong!
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Hotel Rules Box -->
                <div class="bg-[#FFFDF9] rounded-3xl border border-[#E6DAC3] p-6 text-xs space-y-3.5 shadow-sm">
                    <h4 class="font-serif font-bold text-stone-900 text-sm flex items-center">
                        <i data-lucide="book-open" class="w-4 h-4 mr-2 text-[#8A6319]"></i>
                        Aturan Baku Poin GSH
                    </h4>
                    
                    <div class="space-y-1.5 text-stone-700">
                        <p class="font-bold text-stone-900">Nilai Poin Kamar / Malam:</p>
                        <p>&bull; Grand Deluxe: <strong>10 Poin</strong></p>
                        <p>&bull; Grand Executive: <strong>15 Poin</strong></p>
                        <p>&bull; Royal Suite: <strong>20 Poin</strong></p>
                        <p>&bull; President Suite: <strong>30 Poin</strong></p>
                    </div>

                    <div class="pt-2 border-t border-[#EDE4D3] space-y-1.5 text-stone-700">
                        <p class="font-bold text-stone-900">Nilai Poin Revenue Banquet:</p>
                        <p>&bull; <strong>+10 Point</strong> per Rp 1.000.000 revenue (kelipatan)</p>
                    </div>

                    <div class="pt-2 border-t border-[#EDE4D3] space-y-1.5 text-stone-700">
                        <p class="font-bold text-stone-900">Tier Point & Batas:</p>
                        <p>&bull; Silver: 0 – 1.000 Poin (Diskon F&B 5%)</p>
                        <p>&bull; Gold: 1.000 – 5.000 Poin (Diskon F&B 10%, Room Rp25k, dll)</p>
                        <p>&bull; Platinum: 5.000 – 10.000 Poin (Diskon F&B 15%, Free 1 Malam, dll)</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ADMIN SLIDE 2: RIWAYAT TRANSAKSI TERKINI -->
    <div id="admin-slide-2" class="admin-slide-content hidden">
        <div class="bg-[#FFFDF9] rounded-3xl border border-[#E6DAC3] shadow-sm overflow-hidden">
            <div class="px-6 sm:px-8 py-5 border-b border-[#E8DFC8] flex items-center justify-between">
                <div>
                    <h3 class="font-serif font-bold text-stone-900 text-base sm:text-lg flex items-center">
                        <i data-lucide="history" class="w-4 h-4 mr-2 text-[#8A6319]"></i>
                        Riwayat Transaksi Reservasi & Banquet Terkini
                    </h3>
                </div>
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-[#FAF6EE] text-stone-800 border border-[#D8C9AF]">
                    Total: {{ $recentStays->count() }} Transaksi
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-stone-700">
                    <thead class="bg-[#F5EDE0] text-xs uppercase tracking-wider text-stone-900 border-b border-[#D8C9AF] font-bold">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Kode Transaksi</th>
                            <th class="px-6 py-4">Nama Tamu & HP</th>
                            <th class="px-6 py-4">Jenis Transaksi</th>
                            <th class="px-6 py-4 text-center">Durasi / Revenue</th>
                            <th class="px-6 py-4 text-right">Poin Masuk</th>
                            <th class="px-6 py-4">Catatan / Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EAE0CD]">
                        @forelse($recentStays as $stay)
                            <tr class="hover:bg-[#FAF6EE] transition">
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-stone-700">
                                    {{ $stay->stay_date ? $stay->stay_date->format('d/m/Y') : $stay->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 font-mono font-bold text-stone-900 whitespace-nowrap">
                                    {{ $stay->booking_code }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-stone-900">{{ $stay->guest->name }}</div>
                                    <div class="text-xs text-stone-600 font-mono">{{ $stay->guest->phone }} ({{ $stay->guest->member_number }})</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($stay->transaction_type === 'banquet')
                                        <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-[#F5EDDE] text-[#7A5210] border border-[#DEC8A4]">
                                            Revenue Banquet
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-[#FAF6EE] text-stone-800 border border-[#D8C9AF]">
                                            {{ $stay->room_type }}
                                        </span>
                                        <span class="text-xs text-stone-600 block mt-0.5">({{ $stay->points_per_night }} pts/mlm)</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center font-bold text-stone-800 whitespace-nowrap">
                                    @if($stay->transaction_type === 'banquet')
                                        Rp {{ number_format($stay->revenue_amount ?? 0, 0, ',', '.') }}
                                    @else
                                        {{ $stay->nights }} Malam
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-[#8A6319] whitespace-nowrap">
                                    +{{ number_format($stay->points_added) }} Pts
                                    @if($stay->points_added < $stay->points_earned)
                                        <span class="block text-[10px] text-rose-600 font-semibold">(Cap Limit)</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-stone-700">
                                    {{ $stay->notes ?: '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-stone-500">
                                    Belum ada data transaksi reservasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ADMIN SLIDE 3: DIREKTORI MEMBER & UBAH TIER -->
    <div id="admin-slide-3" class="admin-slide-content hidden">
        <div class="bg-[#FFFDF9] rounded-3xl border border-[#E6DAC3] shadow-sm overflow-hidden">
            <div class="px-6 sm:px-8 py-5 border-b border-[#E8DFC8] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="font-serif font-bold text-stone-900 text-base sm:text-lg flex items-center">
                        <i data-lucide="users" class="w-4 h-4 mr-2 text-[#8A6319]"></i>
                        Direktori Anggota Tamu & Manajemen Tier
                    </h3>
                </div>

                <!-- Search Form -->
                <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center space-x-2">
                    <input type="text" 
                           name="q" 
                           value="{{ $searchQuery }}" 
                           placeholder="Cari nama, HP, no member..." 
                           class="px-3.5 py-2 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] text-xs text-stone-900 placeholder:text-stone-500 focus:bg-white focus:ring-2 focus:ring-[#C89B3C] outline-none">
                    <button type="submit" class="px-4 py-2 rounded-xl bg-stone-900 text-white font-bold text-xs uppercase tracking-wider hover:bg-stone-800 transition">
                        Cari
                    </button>
                    @if($searchQuery)
                        <a href="{{ route('admin.dashboard') }}" class="px-2 py-2 text-stone-600 hover:text-stone-900 text-xs font-semibold">Reset</a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-stone-700">
                    <thead class="bg-[#F5EDE0] text-xs uppercase tracking-wider text-stone-900 border-b border-[#D8C9AF] font-bold">
                        <tr>
                            <th class="px-6 py-4">No. Member</th>
                            <th class="px-6 py-4">Nama Tamu</th>
                            <th class="px-6 py-4">Nomor HP</th>
                            <th class="px-6 py-4">Tier Saat Ini</th>
                            <th class="px-6 py-4 text-right">Saldo Poin</th>
                            <th class="px-6 py-4">Top Reward</th>
                            <th class="px-6 py-4 text-center">Ubah Tier Manual</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EAE0CD]">
                        @forelse($guests as $guest)
                            @php
                                $tierStyle = match($guest->tier) {
                                    'Gold' => 'bg-[#FAF3E2] text-amber-950 border-[#D4AF37]',
                                    'Platinum' => 'bg-[#F7F0FA] text-indigo-950 border-[#DEC6F5]',
                                    default => 'bg-[#FAF6EE] text-stone-800 border-[#D8C9AF]',
                                };
                            @endphp
                            <tr class="hover:bg-[#FAF6EE] transition">
                                <td class="px-6 py-4 font-mono font-bold text-stone-900 whitespace-nowrap">
                                    {{ $guest->member_number }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-stone-900">{{ $guest->name }}</div>
                                    <span class="text-xs text-stone-600">
                                        {{ $guest->stays_count }} kali transaksi
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-mono text-stone-700 whitespace-nowrap">
                                    {{ $guest->phone }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 rounded-full text-xs font-serif font-bold uppercase tracking-wider border {{ $tierStyle }}">
                                        {{ $guest->tier }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right font-serif font-bold text-stone-900 text-base whitespace-nowrap">
                                    {{ number_format($guest->points) }}
                                    <span class="text-xs font-normal text-stone-600">/ {{ number_format($guest->max_points) }} pts</span>
                                </td>
                                <td class="px-6 py-4 text-xs font-medium text-stone-800 whitespace-nowrap">
                                    {{ $guest->reward }}
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <form action="{{ route('admin.guest.tier', $guest) }}" method="POST" class="inline-flex items-center space-x-1.5">
                                        @csrf
                                        @method('PATCH')
                                        <select name="tier" class="px-2 py-1 rounded-lg bg-[#FAF6EE] border border-[#D8C9AF] text-xs text-stone-900 font-semibold focus:ring-1 focus:ring-[#C89B3C] outline-none">
                                            <option value="Silver" {{ $guest->tier === 'Silver' ? 'selected' : '' }}>Silver (Max 1.000)</option>
                                            <option value="Gold" {{ $guest->tier === 'Gold' ? 'selected' : '' }}>Gold (Max 5.000)</option>
                                            <option value="Platinum" {{ $guest->tier === 'Platinum' ? 'selected' : '' }}>Platinum (Max 10.000)</option>
                                        </select>
                                        <button type="submit" class="px-2.5 py-1 rounded-lg bg-stone-900 text-white text-xs font-bold hover:bg-stone-800 transition">
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-stone-500">
                                    Tidak ada data member yang sesuai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($guests->hasPages())
                <div class="px-6 py-4 border-t border-[#E8DFC8] bg-[#FAF6EE]">
                    {{ $guests->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- ADMIN SLIDE 4: DAFTAR VOUCHER & KLAIM HADIAH -->
    <div id="admin-slide-4" class="admin-slide-content hidden">
        <div class="space-y-6">
            <!-- Table of Redemptions -->
            <div class="bg-[#FFFDF9] rounded-3xl border border-[#E6DAC3] shadow-sm overflow-hidden">
                <div class="px-6 sm:px-8 py-5 border-b border-[#E8DFC8] flex items-center justify-between">
                    <div>
                        <h3 class="font-serif font-bold text-stone-900 text-base sm:text-lg flex items-center">
                            <i data-lucide="gift" class="w-4 h-4 mr-2 text-[#8A6319]"></i>
                            Daftar Voucher & Status Penukaran Hadiah
                        </h3>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-[#F5EDDE] text-[#7A5210] border border-[#DEC8A4]">
                        Total: {{ $recentRedemptions->count() }} Voucher
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-stone-700">
                        <thead class="bg-[#F5EDE0] text-xs uppercase tracking-wider text-stone-900 border-b border-[#D8C9AF] font-bold">
                            <tr>
                                <th class="px-6 py-4">Waktu Ditukar</th>
                                <th class="px-6 py-4">Kode Voucher</th>
                                <th class="px-6 py-4">Nama Tamu & HP</th>
                                <th class="px-6 py-4">Item Hadiah / Pilihan</th>
                                <th class="px-6 py-4 text-right">Poin Ditukar</th>
                                <th class="px-6 py-4 text-center">Status Klaim</th>
                                <th class="px-6 py-4 text-center">Ubah Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#EAE0CD]">
                            @forelse($recentRedemptions as $rdm)
                                <tr class="hover:bg-[#FAF6EE] transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-stone-700">
                                        {{ $rdm->redeemed_at ? $rdm->redeemed_at->format('d/m/Y H:i') : $rdm->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 font-mono font-bold text-[#8A6319] whitespace-nowrap">
                                        {{ $rdm->voucher_code }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-stone-900">{{ $rdm->guest->name }}</div>
                                        <div class="text-xs text-stone-600 font-mono">{{ $rdm->guest->phone }} ({{ $rdm->guest->member_number }})</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-stone-900 block">{{ $rdm->item_title }}</span>
                                        @if($rdm->selected_option)
                                            <span class="text-xs text-[#8A6319] font-semibold">Pilihan: {{ $rdm->selected_option }}</span>
                                        @elseif($rdm->item_detail)
                                            <span class="text-xs text-stone-600 block">{{ $rdm->item_detail }}</span>
                                        @endif
                                        @if($rdm->notes)
                                            <span class="text-[11px] text-stone-500 italic block mt-0.5">Note: {{ $rdm->notes }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right font-mono font-bold text-rose-600 whitespace-nowrap">
                                        -{{ number_format($rdm->points_cost) }} Pts
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if($rdm->status === 'aktif')
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                                Aktif / Siap Klaim
                                            </span>
                                        @elseif($rdm->status === 'selesai')
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-stone-200 text-stone-700 border border-stone-300">
                                                Telah Digunakan
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-800 border border-rose-300">
                                                {{ ucfirst($rdm->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <form action="{{ route('admin.redemption.status', $rdm) }}" method="POST" class="inline-flex items-center space-x-1.5">
                                            @csrf
                                            <select name="status" class="px-2 py-1 rounded-lg bg-[#FAF6EE] border border-[#D8C9AF] text-xs text-stone-900 font-semibold focus:ring-1 focus:ring-[#C89B3C] outline-none">
                                                <option value="aktif" {{ $rdm->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="selesai" {{ $rdm->status === 'selesai' ? 'selected' : '' }}>Selesai / Diklaim</option>
                                                <option value="batal" {{ $rdm->status === 'batal' ? 'selected' : '' }}>Batalkan</option>
                                            </select>
                                            <button type="submit" class="px-2.5 py-1 rounded-lg bg-stone-900 text-white text-xs font-bold hover:bg-stone-800 transition">
                                                Simpan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-stone-500">
                                        Belum ada data klaim voucher penukaran hadiah.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Formulir Tukar Poin di Meja Resepsionis -->
            <div class="bg-[#FFFDF9] rounded-3xl border border-[#E6DAC3] p-6 sm:p-8 shadow-sm">
                <div class="flex items-center space-x-3 pb-4 border-b border-[#E8DFC8] mb-5">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#B8860B] text-slate-950 flex items-center justify-center font-bold">
                        <i data-lucide="gift" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="font-serif font-bold text-stone-900 text-base">Proses Penukaran Poin di Meja Resepsionis</h3>
                        <p class="text-xs text-stone-600">Bantu tamu menukarkan poin mereka secara langsung di front desk.</p>
                    </div>
                </div>

                <form action="{{ route('admin.redemption.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-800 mb-1.5">
                            Pilih Tamu Member <span class="text-rose-500">*</span>
                        </label>
                        <select name="guest_id" required class="w-full px-3.5 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] text-xs text-stone-900 font-semibold focus:bg-white focus:ring-2 focus:ring-[#C89B3C] outline-none">
                            <option value="">-- Pilih Tamu Member --</option>
                            @foreach($guests as $g)
                                <option value="{{ $g->id }}">{{ $g->name }} - {{ $g->phone }} ({{ number_format($g->points) }} Pts)</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-800 mb-1.5">
                            Pilih Item Hadiah <span class="text-rose-500">*</span>
                        </label>
                        <select name="item_id" required class="w-full px-3.5 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] text-xs text-stone-900 font-semibold focus:bg-white focus:ring-2 focus:ring-[#C89B3C] outline-none">
                            <option value="">-- Pilih Hadiah --</option>
                            @foreach($redeemCatalog as $pts => $cat)
                                <optgroup label="Kategori {{ $cat['label'] }}">
                                    @foreach($cat['items'] as $it)
                                        <option value="{{ $it['id'] }}">{{ $it['title'] }} ({{ $pts }} Pts)</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-800 mb-1.5">
                            Pilihan Varian / Catatan
                        </label>
                        <input type="text" name="selected_option" placeholder="Contoh: Payung GSH / Catatan staf" class="w-full px-3.5 py-2.5 rounded-xl bg-[#FAF6EE] border border-[#D8C9AF] text-xs text-stone-900 focus:bg-white focus:ring-2 focus:ring-[#C89B3C] outline-none">
                    </div>

                    <div class="md:col-span-3 flex justify-end pt-2">
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#D4AF37] via-[#DFB85B] to-[#B8860B] hover:from-[#B8860B] hover:to-[#D4AF37] text-stone-950 font-bold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition flex items-center space-x-1.5">
                            <i data-lucide="check" class="w-4 h-4"></i>
                            <span>Tukarkan Poin Tamu Sekarang</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    const roomRatesConfig = @json($roomRates);
    const banquetRevenuePerUnit = {{ $banquetRevenuePerUnit }};
    const banquetPointsPerUnit = {{ $banquetPointsPerUnit }};
    const tierLimits = {
        'Silver': 1000,
        'Gold': 5000,
        'Platinum': 10000
    };

    let currentGuestData = {
        found: false,
        name: '',
        phone: '',
        member_number: '{{ $nextMemberNumber }}',
        tier: 'Silver',
        points: 0,
        max_points: 1000
    };

    // Toggle Admin Slide Tabs
    function goToAdminSlide(slideNum) {
        for (let i = 1; i <= 4; i++) {
            const slideEl = document.getElementById('admin-slide-' + i);
            const tabBtn = document.getElementById('admin-tab-' + i);
            if (slideEl) {
                if (i === slideNum) {
                    slideEl.classList.remove('hidden');
                } else {
                    slideEl.classList.add('hidden');
                }
            }
            if (tabBtn) {
                if (i === slideNum) {
                    tabBtn.className = "admin-tab-btn flex-1 min-w-[200px] py-2.5 px-4 rounded-xl text-xs font-bold transition-all duration-200 flex items-center justify-center space-x-2 bg-[#FFFDF9] text-stone-950 shadow-sm border border-[#D8C9AF]";
                    const icon = tabBtn.querySelector('i');
                    if (icon) icon.className = "w-4 h-4 text-[#8A6319]";
                } else {
                    tabBtn.className = "admin-tab-btn flex-1 min-w-[200px] py-2.5 px-4 rounded-xl text-xs font-semibold text-stone-700 hover:text-stone-950 hover:bg-[#F8F4EB] transition-all duration-200 flex items-center justify-center space-x-2";
                    const icon = tabBtn.querySelector('i');
                    if (icon) icon.className = "w-4 h-4 text-stone-600";
                }
            }
        }
    }

    // Toggle Jenis Transaksi (Room vs Banquet)
    function toggleTransactionType() {
        const isBanquet = document.getElementById('type_banquet').checked;
        const roomContainer = document.getElementById('room_fields_container');
        const banquetContainer = document.getElementById('banquet_fields_container');
        const roomSelect = document.getElementById('room_type');
        const nightsInput = document.getElementById('nights');
        const revenueInput = document.getElementById('revenue_amount');
        const codeLabel = document.getElementById('code_label');
        const bookingInput = document.getElementById('booking_code');
        const dateLabel = document.getElementById('date_label');

        if (isBanquet) {
            roomContainer.classList.add('hidden');
            banquetContainer.classList.remove('hidden');
            roomSelect.removeAttribute('required');
            nightsInput.removeAttribute('required');
            revenueInput.setAttribute('required', 'required');
            codeLabel.innerHTML = 'Kode Invoice / Event <span class="text-rose-500">*</span>';
            dateLabel.innerText = 'Tanggal Event / Acara';
            if (bookingInput.value.startsWith('BK-')) {
                bookingInput.value = bookingInput.value.replace('BK-', 'EV-');
            }
        } else {
            roomContainer.classList.remove('hidden');
            banquetContainer.classList.add('hidden');
            roomSelect.setAttribute('required', 'required');
            nightsInput.setAttribute('required', 'required');
            revenueInput.removeAttribute('required');
            codeLabel.innerHTML = 'Kode Booking <span class="text-rose-500">*</span>';
            dateLabel.innerText = 'Tanggal Check-in';
            if (bookingInput.value.startsWith('EV-')) {
                bookingInput.value = bookingInput.value.replace('EV-', 'BK-');
            }
        }

        calculateLivePoints();
    }

    // Buat kode booking acak
    function generateBookingCode() {
        const isBanquet = document.getElementById('type_banquet').checked;
        const prefix = isBanquet ? 'EV-' : 'BK-';
        const num = Math.floor(10000 + Math.random() * 90000);
        document.getElementById('booking_code').value = prefix + num;
    }

    // Live search / autofill tamu
    let lookupTimeout = null;
    const phoneInput = document.getElementById('admin_phone');
    const nameInput = document.getElementById('admin_name');

    phoneInput.addEventListener('input', triggerLookup);
    nameInput.addEventListener('input', triggerLookup);

    function triggerLookup() {
        clearTimeout(lookupTimeout);
        lookupTimeout = setTimeout(() => {
            const phone = phoneInput.value.trim();
            const name = nameInput.value.trim();

            if (phone.length < 4 && name.length < 3) {
                resetGuestState();
                return;
            }

            fetchGuestLookup(phone, name);
        }, 400);
    }

    function fetchGuestLookup(phone, name) {
        const params = new URLSearchParams();
        if (phone) params.append('phone', phone);
        if (name) params.append('name', name);

        fetch(`{{ route('api.guest.lookup') }}?${params.toString()}`)
            .then(res => res.json())
            .then(data => {
                const box = document.getElementById('guestStatusBox');
                const icon = document.getElementById('guestStatusIcon');
                const text = document.getElementById('guestStatusText');
                const badge = document.getElementById('guestMemberBadge');

                if (data.found) {
                    currentGuestData = {
                        found: true,
                        name: data.guest.name,
                        phone: data.guest.phone,
                        member_number: data.guest.member_number,
                        tier: data.guest.tier,
                        points: data.guest.points,
                        max_points: data.guest.max_points
                    };

                    if (!phone && data.guest.phone) {
                        document.getElementById('admin_phone').value = data.guest.phone;
                    }
                    if (!name && data.guest.name) {
                        document.getElementById('admin_name').value = data.guest.name;
                    }

                    box.className = 'mt-3.5 p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-xs flex items-center justify-between transition-all';
                    icon.className = 'w-2.5 h-2.5 rounded-full bg-emerald-500';
                    text.innerHTML = `<span class="font-bold text-emerald-900">✓ Tamu Terdaftar:</span> <span class="font-semibold text-stone-900">${data.guest.name}</span> | Tier: <span class="font-bold text-[#8A6319]">${data.guest.tier}</span> | Saldo: <span class="font-bold text-stone-900">${data.guest.points.toLocaleString()} pts</span>`;
                    badge.innerHTML = `<span class="text-emerald-700 font-mono font-bold">${data.guest.member_number}</span>`;
                } else {
                    currentGuestData = {
                        found: false,
                        name: name,
                        phone: phone,
                        member_number: data.next_member_number || '{{ $nextMemberNumber }}',
                        tier: 'Silver',
                        points: 0,
                        max_points: 1000
                    };

                    box.className = 'mt-3.5 p-3.5 rounded-2xl bg-[#F0F4FA] border border-[#C5D5EB] text-xs flex items-center justify-between transition-all';
                    icon.className = 'w-2.5 h-2.5 rounded-full bg-blue-500';
                    text.innerHTML = `<span class="font-bold text-blue-900">✨ Tamu Baru:</span> Nomor member otomatis diterbitkan (Tier Silver)`;
                    badge.innerHTML = `<span class="text-blue-700 font-mono font-bold">${currentGuestData.member_number}</span>`;
                }

                calculateLivePoints();
            })
            .catch(err => {
                console.error(err);
            });
    }

    function resetGuestState() {
        currentGuestData = {
            found: false,
            name: '',
            phone: '',
            member_number: '{{ $nextMemberNumber }}',
            tier: 'Silver',
            points: 0,
            max_points: 1000
        };

        const box = document.getElementById('guestStatusBox');
        box.className = 'mt-3.5 p-3.5 rounded-2xl bg-[#FAF6EE] border border-[#D8C9AF] text-xs flex items-center justify-between transition-all';
        document.getElementById('guestStatusIcon').className = 'w-2.5 h-2.5 rounded-full bg-[#D8C9AF]';
        document.getElementById('guestStatusText').innerText = 'Ketik nomor HP atau nama untuk cek status member...';
        document.getElementById('guestMemberBadge').innerText = 'Auto: {{ $nextMemberNumber }}';

        calculateLivePoints();
    }

    function calculateLivePoints() {
        const isBanquet = document.getElementById('type_banquet').checked;
        const autoUpgrade = document.getElementById('auto_upgrade').checked;

        let earned = 0;

        if (isBanquet) {
            const revenue = parseFloat(document.getElementById('revenue_amount').value) || 0;
            earned = Math.floor(revenue / banquetRevenuePerUnit) * banquetPointsPerUnit;

            document.getElementById('calc_rate_label').innerText = 'Rate Banquet:';
            document.getElementById('calc_rate').innerText = '10 Pts / 1 Juta';
            document.getElementById('calc_dur_label').innerText = 'Revenue Acara:';
            document.getElementById('calc_nights').innerText = `Rp ${revenue.toLocaleString()}`;
        } else {
            const roomSelect = document.getElementById('room_type');
            const selectedRoom = roomSelect.value;
            const nights = parseInt(document.getElementById('nights').value) || 0;
            const rate = roomRatesConfig[selectedRoom] || 10;
            earned = rate * nights;

            document.getElementById('calc_rate_label').innerText = 'Tarif Poin Kamar:';
            document.getElementById('calc_rate').innerText = `${rate} poin/malam`;
            document.getElementById('calc_dur_label').innerText = 'Durasi Menginap:';
            document.getElementById('calc_nights').innerText = `${nights} Malam`;
        }

        document.getElementById('calc_earned').innerText = `+${earned.toLocaleString()} Poin`;
        document.getElementById('calc_tier').innerText = `${currentGuestData.tier} ${currentGuestData.found ? '(Terdaftar)' : '(Baru)'}`;
        document.getElementById('calc_current_points').innerText = `${currentGuestData.points.toLocaleString()} Poin`;

        let currentTier = currentGuestData.tier;
        let maxPoints = tierLimits[currentTier] || 1000;

        document.getElementById('calc_max_points').innerText = `${maxPoints.toLocaleString()} Poin`;

        const potentialTotal = currentGuestData.points + earned;
        let projectedTotal = potentialTotal;
        let isCapped = false;
        let warningText = '';

        if (potentialTotal > maxPoints) {
            if (autoUpgrade) {
                if (currentTier === 'Silver') {
                    currentTier = 'Gold';
                    maxPoints = 5000;
                    if (potentialTotal > 5000) {
                        projectedTotal = 5000;
                        isCapped = true;
                        warningText = `Poin melebihi 5.000 (batas maksimal tier Gold). Poin dibatasi di 5.000.`;
                    } else {
                        projectedTotal = potentialTotal;
                        warningText = `Tamu otomatis naik ke Tier Gold! Poin baru: ${projectedTotal.toLocaleString()}`;
                    }
                } else if (currentTier === 'Gold') {
                    currentTier = 'Platinum';
                    maxPoints = 10000;
                    if (potentialTotal > 10000) {
                        projectedTotal = 10000;
                        isCapped = true;
                        warningText = `Poin melebihi 10.000 (batas maksimal tier Platinum). Poin dibatasi di 10.000.`;
                    } else {
                        projectedTotal = potentialTotal;
                        warningText = `Tamu otomatis naik ke Tier Platinum! Poin baru: ${projectedTotal.toLocaleString()}`;
                    }
                } else if (currentTier === 'Platinum') {
                    projectedTotal = 10000;
                    isCapped = true;
                    const discarded = potentialTotal - 10000;
                    warningText = `⚠️ Perhatian: Poin mentok di 10.000 poin sesuai batas maksimal Platinum. Sisa ${discarded.toLocaleString()} poin tidak dapat dimasukkan!`;
                }
            } else {
                projectedTotal = maxPoints;
                isCapped = true;
                const discarded = potentialTotal - maxPoints;
                warningText = `⚠️ Perhatian: Poin mentok di ${maxPoints.toLocaleString()} poin sesuai batas maksimal ${currentTier}. Sisa ${discarded.toLocaleString()} poin tidak dapat dimasukkan!`;
            }
        }

        document.getElementById('calc_projected_total').innerText = `${projectedTotal.toLocaleString()} Poin`;

        const warningBox = document.getElementById('calc_cap_warning');
        const warningEl = document.getElementById('calc_cap_warning_text');

        if (isCapped || (autoUpgrade && potentialTotal > tierLimits[currentGuestData.tier])) {
            warningBox.classList.remove('hidden');
            warningEl.innerText = warningText;
        } else {
            warningBox.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (!document.getElementById('booking_code').value) {
            generateBookingCode();
        }
        calculateLivePoints();
    });
</script>
@endpush
@endsection
