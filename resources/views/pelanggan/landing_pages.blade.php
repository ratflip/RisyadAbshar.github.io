@extends('components.app')

@section('content')

<main>

{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden bg-surface">

    {{-- Background texture: layered rings --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute -top-32 -right-32 w-[640px] h-[640px] rounded-full"
             style="background: radial-gradient(circle, rgba(29,158,117,0.10) 0%, transparent 70%);"></div>
        <div class="absolute bottom-0 -left-24 w-[400px] h-[400px] rounded-full"
             style="background: radial-gradient(circle, rgba(29,158,117,0.07) 0%, transparent 70%);"></div>
        {{-- Faint grid dot pattern --}}
        <svg class="absolute inset-0 w-full h-full opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="dots" x="0" y="0" width="24" height="24" patternUnits="userSpaceOnUse">
                    <circle cx="2" cy="2" r="1.5" fill="currentColor"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#dots)"/>
        </svg>
    </div>

    <div class="max-w-container-max mx-auto px-gutter w-full relative z-10">
        <div class="grid lg:grid-cols-2 gap-lg items-center py-xl">

            {{-- LEFT --}}
            <div class="space-y-md text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-primary/20 bg-primary/5 text-primary font-label-md uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse inline-block"></span>
                    Solusi Makan Sehat
                </div>

                <h1 class="font-display-lg text-display-lg-mobile md:text-display-lg leading-[1.1] text-on-surface tracking-tight">
                    Makan Enak<br/>
                    Tiap Hari,<br/>
                    <span class="text-primary relative inline-block">
                        Tanpa Repot.
                        {{-- Underline accent --}}
                        <svg class="absolute -bottom-2 left-0 w-full" height="6" viewBox="0 0 200 6" preserveAspectRatio="none" aria-hidden="true">
                            <path d="M0 5 Q50 0 100 4 Q150 8 200 3" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" opacity="0.5"/>
                        </svg>
                    </span>
                </h1>

                <p class="font-body-lg text-on-surface-variant max-w-md mx-auto lg:mx-0 leading-relaxed">
                    Katering box harian yang praktis atau paket prasmanan lengkap — masakan segar, diantar tepat waktu, langsung ke tangan kamu.
                </p>

                <div class="flex flex-col sm:flex-row gap-sm pt-xs justify-center lg:justify-start">
                    <a href="{{ route('pelanggan.katalog') }}"
                       class="inline-flex justify-center items-center gap-2 bg-primary text-on-primary font-label-md px-lg py-sm rounded-xl
                              hover:-translate-y-0.5 hover:shadow-lg transition-all active:scale-95 shadow-md">
                        <span class="material-symbols-outlined text-[20px]">restaurant_menu</span>
                        Lihat Katalog
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex justify-center items-center gap-2 border-2 border-primary/30 text-primary font-label-md px-lg py-sm rounded-xl
                              hover:border-primary hover:bg-primary/5 hover:-translate-y-0.5 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[20px]">person_add</span>
                        Daftar Gratis
                    </a>
                </div>

                {{-- Social proof --}}
                <div class="flex items-center gap-sm pt-xs justify-center lg:justify-start">
                    <div class="flex -space-x-3">
                        @foreach([
                            'https://lh3.googleusercontent.com/aida-public/AB6AXuDbHF2KfLqH7kwVPOf1xF3q4Te_beIZDw9yqXLh1ovFBsjosvANt_dWnYJI4APxDXcGKV4k52znPYy-5LtrhVaL6zSml0E4bIO6K4kxwH3fEJHu9icP_KfJ0v7YDlPbqir-9OSIt86Mu3_01YBBin9jINcaNOkqNfuwNLgf93EgBjwtTjzgWB8l83sUNbqQYCQmheUH6Oo_3cO3KF5r6q84-Fl5-uCDwAt5UEaRYftSYV5zxVa1Ztg42IXREhnSm0Uablfi3MFMbTrE',
                            'https://lh3.googleusercontent.com/aida-public/AB6AXuAZ2sHUB73PolglYHnZBv-4NFcChf_FmqsIvX2RtCAECizm7iX9WFnfc50Rrj7x_ZMLqUBlVPz8Ojk-9FxnlPo5g-o-CHHy__JL2eAaPCcG3DrZ81BlZcsmwfRksh_7-ryLruE4f-f3W1k2Lywpb6KUYq08It-2qyU6N0He-69-j_BeyQS7q3oP-h9_o4iC9GozDtKezx_nr2dRALltP1e6owCUCS4fXtFjpC63nLDTSR_9fSdpRkTjgIQO7UAgXrYBY0H5jMgIBqRg',
                            'https://lh3.googleusercontent.com/aida-public/AB6AXuCFgpmoJwnWZrZ2wLzoNMmJyJcbLAMfS5bCviYsr6r6qAsOQ6ZyHonlEaEb5Knm6rzbHF41Wln6ttTtUtpNSQ-u-OneFGcHqP0c96GZ2OEtg1atebKPgqr06RhCxTQc6bsLA4QroT7LRHEyivGU77aYoWgPNgSWG0PGRshJF7BtxxcW8NCHMsomY0ofRyv8uaP2P-oZTYOG8-Gik6NWhGyPP78chJRE7jLQ1bTyXhaE6pLWJFVciXjc1SrjsyHOUWi__fpSiTw_2MCR'
                        ] as $avatar)
                        <div class="w-10 h-10 rounded-full border-2 border-surface overflow-hidden ring-1 ring-primary/10 shadow-sm">
                            <img src="{{ $avatar }}" alt="Reviewer" class="w-full h-full object-cover"/>
                        </div>
                        @endforeach
                    </div>
                    <div>
                        <div class="flex items-center gap-0.5 mb-0.5">
                            @for($i = 0; $i < 5; $i++)
                            <span class="material-symbols-outlined text-accent-amber text-[14px]" style="font-variation-settings:'FILL' 1;">star</span>
                            @endfor
                        </div>
                        <p class="text-label-sm text-on-surface-variant">
                            <span class="font-bold text-on-surface">2.500+</span> pelanggan puas
                        </p>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Hero image with floating badge --}}
            <div class="relative flex justify-center lg:justify-end">
                {{-- Decorative ring behind image --}}
                <div class="absolute inset-0 m-auto w-[340px] h-[340px] rounded-full border border-primary/10 pointer-events-none" aria-hidden="true"></div>
                <div class="absolute inset-0 m-auto w-[420px] h-[420px] rounded-full border border-primary/5 pointer-events-none" aria-hidden="true"></div>

                <div class="relative z-10 w-full max-w-[480px]">
                    {{-- Main image card --}}
                    <div class="rounded-2xl overflow-hidden shadow-2xl transform lg:rotate-2 hover:rotate-0 transition-transform duration-500 border border-surface-container-highest/50">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBTrm4WvLAtRy9i4mFol-jOo2WLtXMpwx25j5ZpTqVkXEatqS44_9Yr2m0sqk6_KsfduFkA3VeNBrchdyX_TlhTIigyTXjMyOm5acZcATc1i0iCtiJP9lp8_eK7kRUF-zHM7xnrpTZ5VGnfUPpErb3dYvBVn15HQS266qpAnwHvchumojYsmZ0E5mzeO4x3RrMzOZbQrRslL06DghOrYj9ApC6RVbnXcdPX9c_6vFYMpPZtNGmYsDdOiUBVngTb-Tl_8p3SSSGvbc6N"
                             alt="Tampilan makanan sehat dari katering kami"
                             class="w-full h-auto object-cover"/>
                    </div>

                    {{-- Floating rating badge --}}
                    <div class="absolute -bottom-4 -right-4 md:-bottom-6 md:-right-6 bg-surface rounded-2xl px-sm py-xs shadow-xl border border-surface-container-highest z-20">
                        <div class="flex items-center gap-xs">
                            <span class="material-symbols-outlined text-accent-amber" style="font-variation-settings:'FILL' 1;">star</span>
                            <span class="font-bold text-on-surface">4.9</span>
                            <span class="text-on-surface-variant text-sm">/ 5</span>
                        </div>
                        <p class="text-[10px] text-on-surface-variant mt-0.5 text-center">Rating Kepuasan</p>
                    </div>

                    {{-- Floating "Fresh today" badge --}}
                    <div class="absolute -top-4 -left-4 md:-top-5 md:-left-5 bg-primary text-on-primary rounded-2xl px-sm py-xs shadow-xl z-20 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]" style="font-variation-settings:'FILL' 1;">eco</span>
                        <span class="text-[11px] font-bold tracking-wide">Segar Hari Ini</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     MENU REKOMENDASI
     ============================================================ --}}
<section class="py-xl bg-surface-container-low">
    <div class="max-w-container-max mx-auto px-gutter">

        {{-- Section header --}}
        <div class="flex flex-col md:flex-row justify-between items-end gap-sm mb-lg">
            <div class="space-y-xs">
                <span class="text-primary text-label-md font-bold uppercase tracking-widest">Menu Hari Ini</span>
                <h2 class="font-headline-md text-headline-md-mobile md:text-headline-md text-on-surface">
                    Rekomendasi Untuk Kamu
                </h2>
                <p class="text-on-surface-variant max-w-md">Pilih dari berbagai kategori yang sesuai selera dan kebutuhan nutrisimu.</p>
            </div>
                <div class="flex items-center shrink-0">
                <a href="{{ route('pelanggan.katalog') }}"
                class="px-5 py-2 bg-primary text-on-primary rounded-full font-label-md shadow-sm hover:-translate-y-0.5 transition-all text-center text-sm flex items-center gap-xs group">
                    <span>Lihat Semua Menu</span>
                    <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform duration-300">arrow_forward</span>
                </a>
            </div>
        </div>

        {{-- Menu grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-md">
            @foreach($menus as $item)
            <article class="group bg-surface rounded-2xl overflow-hidden border border-surface-container-highest
                            flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                {{-- Image --}}
                <div class="relative h-52 overflow-hidden bg-surface-container-low">
                    <img src="{{ asset('storage/' . $item->gambar) }}"
                         alt="{{ $item->nama }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.src='https://placehold.co/400x300?text=Katering'"/>
                    {{-- Category badge --}}
                    <span class="absolute top-3 right-3 bg-primary/90 backdrop-blur-sm text-on-primary
                                 px-3 py-1 rounded-full text-[11px] font-bold shadow">
                        {{ $item->kategori }}
                    </span>
                </div>

                {{-- Content --}}
                <div class="flex flex-col flex-1 p-sm">
                    <div class="flex-1 space-y-1 mb-sm">
                        <h3 class="font-title-lg text-on-surface leading-tight">{{ $item->nama }}</h3>
                        <p class="text-label-sm text-on-surface-variant line-clamp-2 leading-relaxed">{{ $item->deskripsi }}</p>
                    </div>

                    {{-- Footer --}}
                    <div class="flex items-center justify-between pt-sm border-t border-surface-container-highest">
                        <div>
                            <p class="text-[10px] text-on-surface-variant font-medium uppercase tracking-wider mb-0.5">Mulai dari</p>
                            <span class="font-bold text-primary font-title-lg">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('pelanggan.order', ['id' => $item->id]) }}"
                           class="flex items-center justify-center w-10 h-10 bg-primary text-on-primary rounded-xl
                                  hover:scale-110 hover:shadow-lg transition-all active:scale-95"
                           aria-label="Pesan {{ $item->nama }}">
                            <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     CARA PESAN — HOW IT WORKS
     ============================================================ --}}
<section class="py-xl bg-surface overflow-hidden">
    <div class="max-w-container-max mx-auto px-gutter">

        <div class="text-center mb-xl">
            <span class="text-primary text-label-md font-bold uppercase tracking-widest">Cara Pesan</span>
            <h2 class="font-headline-md text-headline-md-mobile md:text-headline-md text-on-surface mt-xs">
                Tiga Langkah, Makanan di Tanganmu
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg relative">

            {{-- Connector line (desktop) --}}
            <div class="hidden md:block absolute top-[52px] left-[calc(16.667%+32px)] right-[calc(16.667%+32px)] h-px border-t-2 border-dashed border-outline-variant/60 z-0" aria-hidden="true"></div>

            @foreach([
                ['icon' => 'restaurant_menu', 'step' => '01', 'title' => 'Pilih Menu', 'desc' => 'Pilih paket box harian atau prasmanan yang paling cocok buat kamu.'],
                ['icon' => 'calendar_month', 'step' => '02', 'title' => 'Tentukan Jadwal', 'desc' => 'Atur jadwal pengantaran sesuai rutinitasmu — pagi, siang, atau sore.'],
                ['icon' => 'local_shipping', 'step' => '03', 'title' => 'Bayar & Ditantar', 'desc' => 'Bayar sekali, kami yang urus sisanya sampai makanan ada di mejamu.'],
            ] as $step)
            <div class="relative z-10 flex flex-col items-center text-center group">
                {{-- Icon circle --}}
                <div class="w-[72px] h-[72px] mb-md bg-surface-container-low rounded-2xl flex items-center justify-center
                            border border-surface-container-highest shadow-sm
                            group-hover:bg-primary group-hover:border-primary group-hover:shadow-lg
                            transition-all duration-300 relative">
                    <span class="material-symbols-outlined text-[32px] text-primary group-hover:text-on-primary transition-colors duration-300">{{ $step['icon'] }}</span>
                    {{-- Step number chip --}}
                    <span class="absolute -top-2.5 -right-2.5 w-6 h-6 rounded-full bg-primary text-on-primary text-[10px] font-bold flex items-center justify-center shadow">
                        {{ $step['step'] }}
                    </span>
                </div>
                <h3 class="font-title-lg text-on-surface mb-xs">{{ $step['title'] }}</h3>
                <p class="text-on-surface-variant text-sm leading-relaxed max-w-[200px]">{{ $step['desc'] }}</p>
            </div>
            @endforeach

        </div>
    </div>
</section>


{{-- ============================================================
     BEHIND THE KITCHEN — VIDEO SECTION
     ============================================================ --}}
<section class="py-xl bg-surface-container-low relative overflow-hidden">

    {{-- Orb dekoratif --}}
    <div class="absolute top-[-80px] right-[-60px] w-[320px] h-[320px] rounded-full pointer-events-none" aria-hidden="true"
         style="background: radial-gradient(circle at 60% 40%, rgba(29,158,117,0.12), transparent 70%);"></div>
    <div class="absolute bottom-0 left-[-40px] w-[240px] h-[240px] rounded-full pointer-events-none" aria-hidden="true"
         style="background: radial-gradient(circle at 40% 60%, rgba(93,202,165,0.09), transparent 70%);"></div>

    <div class="max-w-container-max mx-auto px-gutter relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-xl items-center">

            {{-- LEFT --}}
            <div class="space-y-md text-center lg:text-left">

                <span class="inline-block text-[11px] font-medium tracking-widest uppercase
                             bg-[rgba(29,158,117,0.12)] text-[#0F6E56]
                             px-3 py-1 rounded-full">
                    Behind the Kitchen
                </span>

                <h2 class="font-headline-md text-headline-md-mobile md:text-headline-md
                           text-on-surface leading-tight font-black tracking-tight">
                    Dari Dapur Bersih,<br class="hidden md:inline"/>
                    Sampai ke Meja Makanmu
                </h2>

                <p class="text-on-surface-variant text-body-md leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Penasaran gimana bekal makan siang atau menu acaramu disiapkan?
                    Intip standar kebersihan dapur kami, cara kami milih bahan segar harian,
                    sampai proses packing yang rapi lewat video singkat ini.
                </p>

                <div class="flex flex-col gap-3 max-w-md mx-auto lg:mx-0 text-left">

                    <div class="btk-feat flex items-start gap-3 p-4 rounded-xl
                                border border-surface-container-highest bg-surface
                                cursor-default transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center bg-[rgba(29,158,117,0.12)]">
                            <span class="material-symbols-outlined text-[20px] text-[#0F6E56]">shield</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-on-surface">Standardisasi Higienis</p>
                            <p class="text-xs text-on-surface-variant mt-0.5 leading-relaxed">Dapur bersih dan kru yang selalu terproteksi.</p>
                        </div>
                    </div>

                    <div class="btk-feat flex items-start gap-3 p-4 rounded-xl
                                border border-surface-container-highest bg-surface
                                cursor-default transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center bg-[rgba(29,158,117,0.12)]">
                            <span class="material-symbols-outlined text-[20px] text-[#0F6E56]">storefront</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-on-surface">Bahan Segar Setiap Subuh</p>
                            <p class="text-xs text-on-surface-variant mt-0.5 leading-relaxed">Tanpa stok lama, langsung olah dari pasar induk.</p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- RIGHT: 3D video card --}}
<div class="flex flex-col items-center lg:items-start" id="btk-video-parent">

    <div id="btk-video-card"
         class="w-full aspect-video rounded-2xl overflow-hidden relative bg-black
                border border-surface-container-highest transition-all duration-300"
         style="transform: perspective(800px) rotateY(-6deg) rotateX(2deg);
                box-shadow: 8px 16px 40px rgba(0,0,0,0.18), 2px 4px 12px rgba(0,0,0,0.10), inset 0 1px 0 rgba(255,255,255,0.08);">

        <div class="absolute top-0 left-0 right-0 h-[3px] z-10 pointer-events-none"
             style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);" aria-hidden="true"></div>
        <div class="absolute top-0 bottom-0 left-0 w-[3px] z-10 pointer-events-none"
             style="background: linear-gradient(180deg, rgba(255,255,255,0.12), transparent);" aria-hidden="true"></div>

        <video class="w-full h-full object-cover relative z-0" controls autoplay muted loop>
            <<source src="{{ asset('storage/vidio/video_catering.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>

    </div>

    <p class="mt-3 flex items-center gap-1.5 text-xs font-medium text-on-surface-variant pl-1">
        <span class="inline-block w-1.5 h-1.5 rounded-full bg-[#1D9E75] animate-pulse"></span>
        Tonton proses dapur kami
    </p>

</div>
        </div>
    </div>
</section>


{{-- ============================================================
     CTA BANNER
     ============================================================ --}}
<section class="py-xl bg-surface">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="relative overflow-hidden bg-primary rounded-3xl px-lg py-xl md:px-xl flex flex-col md:flex-row items-center justify-between gap-lg">

            {{-- Decorative shapes --}}
            <div class="absolute -top-16 -right-16 w-48 h-48 rounded-full bg-white/10 pointer-events-none" aria-hidden="true"></div>
            <div class="absolute -bottom-10 right-1/3 w-32 h-32 rounded-full bg-white/5 pointer-events-none" aria-hidden="true"></div>
            <div class="absolute top-1/2 -translate-y-1/2 right-1/4 w-2 h-24 rounded-full bg-white/10 pointer-events-none rotate-12" aria-hidden="true"></div>
            <div class="absolute -bottom-8 -left-8 w-32 h-32 rounded-full bg-secondary-container/20 pointer-events-none" aria-hidden="true"></div>

            <div class="relative z-10 text-center md:text-left space-y-xs max-w-lg">
                <p class="text-on-primary/70 text-label-md font-bold uppercase tracking-widest text-sm">Mulai Sekarang</p>
                <h2 class="font-headline-md text-on-primary md:text-display-lg-mobile leading-tight">
                    Tertarik Mencoba?
                </h2>
                <p class="text-on-primary/85 text-body-lg leading-relaxed">
                    Konsultasikan kebutuhan katering kamu sekarang — tim kami siap bantu dari nol.
                </p>
            </div>

            <div class="relative z-10 flex flex-col sm:flex-row gap-sm shrink-0">
                <a href="https://wa.me/089652693211"
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex justify-center items-center gap-2 bg-accent-amber text-on-secondary-fixed-variant
                          font-bold px-lg py-sm rounded-xl hover:scale-105 hover:shadow-xl
                          transition-all active:scale-95 shadow-lg">
                    <span class="material-symbols-outlined text-[20px]" style="font-variation-settings:'FILL' 1;">chat</span>
                    Hubungi via WhatsApp
                </a>
            </div>

        </div>
    </div>
</section>


</main>

{{-- ============================================================
     JS: 3D Video Tilt + Feature Hover
     ============================================================ --}}
<script>
(function () {
    'use strict';

    var card   = document.getElementById('btk-video-card');
    var parent = document.getElementById('btk-video-parent');

    if (!card || !parent) return;

    var BASE_SHADOW  = '8px 16px 40px rgba(0,0,0,0.18), 2px 4px 12px rgba(0,0,0,0.10), inset 0 1px 0 rgba(255,255,255,0.08)';
    var HOVER_SHADOW = '14px 28px 56px rgba(0,0,0,0.22), 4px 8px 20px rgba(0,0,0,0.12), inset 0 1px 0 rgba(255,255,255,0.1)';

    parent.addEventListener('mousemove', function (e) {
        var rect = card.getBoundingClientRect();
        var dx   = (e.clientX - (rect.left + rect.width  / 2)) / (rect.width  / 2);
        var dy   = (e.clientY - (rect.top  + rect.height / 2)) / (rect.height / 2);
        card.style.transform  = 'perspective(800px) rotateY(' + (-6 + dx * 4) + 'deg) rotateX(' + (2 - dy * 2) + 'deg) scale(1.02)';
        card.style.boxShadow  = HOVER_SHADOW;
    });

    parent.addEventListener('mouseleave', function () {
        card.style.transform  = 'perspective(800px) rotateY(-6deg) rotateX(2deg) scale(1)';
        card.style.boxShadow  = BASE_SHADOW;
    });

    document.querySelectorAll('.btk-feat').forEach(function (el) {
        el.addEventListener('mouseenter', function () {
            el.style.transform = 'perspective(400px) rotateX(-2deg) translateY(-2px)';
        });
        el.addEventListener('mouseleave', function () {
            el.style.transform = '';
        });
    });

    {{-- Scroll reveal: tambahkan class .revealed saat elemen masuk viewport --}}
    if ('IntersectionObserver' in window) {
        var style = document.createElement('style');
        style.textContent = '.reveal{opacity:0;transform:translateY(20px);transition:opacity .5s ease,transform .5s ease}.reveal.revealed{opacity:1;transform:none}';
        document.head.appendChild(style);

        document.querySelectorAll('article, .btk-feat, section > div > div > div').forEach(function (el, i) {
            el.classList.add('reveal');
            el.style.transitionDelay = (i % 4 * 80) + 'ms';
        });

        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
    }
})();
</script>

@endsection