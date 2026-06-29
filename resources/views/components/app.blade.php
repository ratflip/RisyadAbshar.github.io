<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>CateringYuk! - Makan Sehat Tiap Hari, Tanpa Ribet</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-tint": "#006e0c",
                        "surface-container-highest": "#e4e2e4",
                        "primary": "#006c0c",
                        "inverse-surface": "#303032",
                        "surface-container": "#f0edef",
                        "on-tertiary-fixed": "#1b1d0e",
                        "surface-dim": "#dcd9dc",
                        "surface-container-high": "#eae7ea",
                        "on-surface": "#1b1b1d",
                        "secondary-fixed": "#ffdbc9",
                        "error": "#ba1a1a",
                        "secondary": "#934b19",
                        "tertiary-fixed-dim": "#c8c8b0",
                        "secondary-fixed-dim": "#ffb68c",
                        "tertiary": "#5c5d4a",
                        "surface-bright": "#fcf8fb",
                        "on-primary-container": "#f8fff0",
                        "secondary-container": "#ffa26a",
                        "surface-container-low": "#f6f3f5",
                        "inverse-on-surface": "#f3f0f2",
                        "on-secondary-container": "#783603",
                        "surface-container-lowest": "#ffffff",
                        "inverse-primary": "#77dd6a",
                        "outline-variant": "#becab7",
                        "on-surface-variant": "#3f4a3b",
                        "on-primary-fixed": "#002201",
                        "on-primary-fixed-variant": "#005307",
                        "surface-variant": "#e4e2e4",
                        "error-container": "#ffdad6",
                        "primary-fixed-dim": "#77dd6a",
                        "on-tertiary-fixed-variant": "#474836",
                        "primary-container": "#1c871e",
                        "on-error": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-tertiary": "#ffffff",
                        "on-secondary-fixed": "#321200",
                        "outline": "#6f7a6a",
                        "tertiary-fixed": "#e4e4cc",
                        "on-background": "#1b1b1d",
                        "on-tertiary-container": "#fefee5",
                        "on-primary": "#ffffff",
                        "on-secondary-fixed-variant": "#753401",
                        "tertiary-container": "#757662",
                        "background": "#fcf8fb",
                        "surface": "#fcf8fb",
                        "primary-fixed": "#92fa83",
                        "on-secondary": "#ffffff",
                        "accent-amber": "#FFBF00"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-max": "1200px",
                        "md": "24px",
                        "gutter": "24px",
                        "lg": "48px",
                        "sm": "16px",
                        "base": "4px",
                        "xs": "8px",
                        "xl": "80px",
                        "margin-mobile": "16px"
                    },
                    "fontFamily": {
                        "display-lg-mobile": ["Quicksand"],
                        "headline-md-mobile": ["Quicksand"],
                        "label-sm": ["Public Sans"],
                        "body-lg": ["Public Sans"],
                        "body-md": ["Public Sans"],
                        "title-lg": ["Quicksand"],
                        "headline-md": ["Quicksand"],
                        "display-lg": ["Quicksand"],
                        "label-md": ["Public Sans"]
                    },
                    "fontSize": {
                        "display-lg-mobile": ["32px", {"lineHeight": "40px", "fontWeight": "700"}],
                        "headline-md-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "title-lg": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "headline-md": ["32px", {"lineHeight": "40px", "fontWeight": "700"}],
                        "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "600"}]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .hero-gradient {
            background: linear-gradient(135deg, rgba(0, 108, 12, 0.05) 0%, rgba(255, 191, 0, 0.05) 100%);
        }
        .bento-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .bento-card:hover {
            transform: translateY(-4px);
            box-shadow: 0px 8px 30px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body-md overflow-x-hidden">

<header class="bg-surface sticky top-0 z-50 shadow-[0px_4px_20px_rgba(0,0,0,0.05)]">
    <nav class="flex justify-between items-center px-gutter py-sm max-w-container-max mx-auto w-full">
        <a href="{{ route('pelanggan.landing') }}" class="flex items-center gap-xs transition-transform hover:scale-105 active:scale-95 duration-200">
            <img alt="CateringYuk! Logo" class="h-10 w-10 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAds8W77KWvL5kPVw0CR4vPQ_RiTkm59GeZUOjTsJ0o4goQINXEJnsFAa-yakS2Eh9g4PU8ndwrFXQpWdHrp3dgI3G20t2uNZplmKF0Kj-0YJ7LhoDbJxkIObODuw3wVSIDB2GyzpwxAUdQx18KZ_nvuUepPW3uStvHpl3aEmHY7Lc5F3k8bkpCfJ3jzfZ07QXPWDlLQ13Mrs8Bx1SyGrEg7yA56qJdnRTR0a16e3k0QznSCB7TWbpOXs_87x_HwddCRxh6lwkSNs8y"/>
            <span class="font-display-lg text-headline-md font-bold text-primary">CateringYuk!</span>
        </a>
        
        <div class="hidden md:flex items-center space-x-sm">
            <a class="px-5 py-2 bg-surface-container-lowest text-on-surface-variant font-bold rounded-xl border border-surface-container shadow-[0_4px_0_#e4e2e4] hover:text-primary hover:bg-surface-bright active:shadow-none active:translate-y-[4px] transition-all duration-150" href="{{ route('pelanggan.landing') }}">Dashboard</a>
            
            <a class="px-5 py-2 bg-surface-container-lowest text-on-surface-variant font-bold rounded-xl border border-surface-container shadow-[0_4px_0_#e4e2e4] hover:text-primary hover:bg-surface-bright active:shadow-none active:translate-y-[4px] transition-all duration-150" href="{{ route('pelanggan.katalog') }}">Katalog</a>
        </div>
        
        <div class="flex items-center gap-sm">
            @auth
                <div class="hidden sm:flex items-center gap-2 mr-2">
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-5 py-2 bg-error text-white font-bold rounded-xl shadow-[0_4px_0_#93000a] hover:brightness-110 active:shadow-none active:translate-y-[4px] transition-all duration-150">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center justify-center px-6 py-2 bg-primary text-white font-bold rounded-xl shadow-[0_4px_0_#005307] hover:brightness-110 active:shadow-none active:translate-y-[4px] transition-all duration-150">
                    Login
                </a>
            @endguest
            
            @auth
            <div class="hidden sm:flex items-center gap-4 mr-2">
                <a href="{{ route('pelanggan.order') }}" class="relative p-3 bg-surface-container-lowest text-primary font-bold rounded-xl border border-surface-container shadow-[0_4px_0_#e4e2e4] hover:bg-surface-bright active:shadow-none active:translate-y-[4px] transition-all duration-150 flex items-center justify-center">
                    <span ></span>
                </a>

                <span class="text-on-surface-variant font-label-md font-medium px-4 py-2 bg-surface-container-low rounded-xl border border-surface-container shadow-sm">
                    Halo👋, {{ Auth::user()->username }}
                </span>
            </div>
            @endauth
            
            <button id="mobile-menu-toggle" class="md:hidden p-2 bg-surface-container-lowest text-primary font-bold rounded-xl border border-surface-container shadow-[0_4px_0_#e4e2e4] active:shadow-none active:translate-y-[4px] transition-all duration-150 focus:outline-none flex items-center justify-center">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" class="hidden md:hidden bg-surface border-t border-surface-container-high px-gutter py-md space-y-md shadow-inner">
        <a class="block text-center px-4 py-3 bg-surface-container-lowest text-on-surface-variant font-bold rounded-xl border border-surface-container shadow-[0_4px_0_#e4e2e4] hover:text-primary active:shadow-none active:translate-y-[4px] transition-all duration-150" href="{{ route('pelanggan.landing') }}">Dashboard</a>
        
        <a class="block text-center px-4 py-3 bg-surface-container-lowest text-on-surface-variant font-bold rounded-xl border border-surface-container shadow-[0_4px_0_#e4e2e4] hover:text-primary active:shadow-none active:translate-y-[4px] transition-all duration-150" href="{{ route('pelanggan.order') }}">Order</a>
        
        <a class="block text-center px-4 py-3 bg-surface-container-lowest text-on-surface-variant font-bold rounded-xl border border-surface-container shadow-[0_4px_0_#e4e2e4] hover:text-primary active:shadow-none active:translate-y-[4px] transition-all duration-150" href="{{ route('pelanggan.katalog') }}#cara-pesan">Katalog</a>
        
        <div class="pt-sm border-t border-surface-container-high flex flex-col gap-sm">
            @auth
                <div class="w-full text-center text-on-surface-variant font-label-md py-2">
                    Halo, <strong>{{ Auth::user()->username }}</strong>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-center px-4 py-3 bg-error text-white font-bold rounded-xl shadow-[0_4px_0_#93000a] hover:brightness-110 active:shadow-none active:translate-y-[4px] transition-all duration-150">
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="w-full text-center block px-4 py-3 bg-primary text-white font-bold rounded-xl shadow-[0_4px_0_#005307] hover:brightness-110 active:shadow-none active:translate-y-[4px] transition-all duration-150">
                    Login
                </a>
            @endguest
        </div>
    </div>
</header>

@yield('content')

<footer class="bg-[#111111] text-white border-t border-white/10 mt-xl">
    <div class="max-w-container-max mx-auto px-gutter py-xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg">
            
            <div class="space-y-sm">
                <span class="font-display-lg text-headline-md font-bold text-primary-fixed">CateringYuk!</span>
                <p class="font-body-md text-zinc-400">
                    Menyajikan hidangan sehat, lezat, dan higienis langsung ke tempat Anda. Mitra terbaik untuk segala acara dan kebutuhan harian Anda.
                </p>
                <div class="space-y-xs pt-xs font-body-md text-zinc-300">
                    <div class="flex items-center gap-xs">
                        <span class="material-symbols-outlined text-primary-fixed text-[20px]">call</span>
                        <span>+62 812-3456-7890</span>
                    </div>
                    <div class="flex items-center gap-xs">
                        <span class="material-symbols-outlined text-primary-fixed text-[20px]">mail</span>
                        <span>info@cateringyuk.com</span>
                    </div>
                    <div class="flex items-center gap-xs">
                        <span class="material-symbols-outlined text-primary-fixed text-[20px]">schedule</span>
                        <span>Setiap Hari: 07.00 - 20.00 WIB</span>
                    </div>
                </div>
            </div>

            <div class="space-y-sm">
                <h4 class="font-title-lg text-title-lg text-primary-fixed font-bold">Workshop Kami</h4>
                <div class="flex gap-xs font-body-md text-zinc-300">
                    <span class="material-symbols-outlined text-primary-fixed text-[24px] flex-shrink-0">location_on</span>
                    <p class="text-zinc-400">
                        <strong class="text-white">CateringYuk! Head Office & Kitchen</strong><br>
                        Jl. Ir. H. Juanda No. 62, Blok C No. 4,<br>
                        Kecamatan Ciputat Timur, Kota Tangerang Selatan,<br>
                        Banten 15412
                    </p>
                </div>
                <div class="pt-xs">
                    <p class="font-label-md text-white font-bold uppercase tracking-wider mb-xs">Navigasi</p>
                    <div class="flex gap-md font-body-md text-zinc-400">
                        <a href="{{ route('pelanggan.katalog') }}" class="hover:text-primary-fixed transition-colors">Katalog</a>
                        <a href="{{ route('pelanggan.order') }}" class="hover:text-primary-fixed transition-colors">Order</a>
                        <a href="{{ route('pelanggan.landing') }}#cara-pesan" class="hover:text-primary-fixed transition-colors">Cara Pesan</a>
                    </div>
                </div>
            </div>

            <div class="space-y-sm">
                <h4 class="font-title-lg text-title-lg text-primary-fixed font-bold">Lokasi Google Maps</h4>
                <div class="w-full h-48 rounded-xl overflow-hidden shadow-sm border border-white/10">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.653377553502!2d106.87586397481081!3d-6.309186961743076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed6654025c37%3A0x684b644f4d39e5c!2sKopi%20Kenangan%20-%20Ruko%20Tanah%20Merdeka!5e0!3m2!1sid!2sid!4v1781257713003!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>

        <div class="border-t border-white/10 mt-lg pt-md flex flex-col sm:flex-row justify-between items-center gap-xs text-label-md text-zinc-500">
            <p>© 2026 CateringYuk!. All Rights Reserved.</p>
            <div class="flex gap-sm">
                <a href="#" class="hover:text-primary-fixed transition-colors">Privacy Policy</a>
                <span>•</span>
                <a href="#" class="hover:text-primary-fixed transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Logic toggle menu mobile hamburger
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Intersection observer animasi layout
    const observerOptions = { threshold: 0.1 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-10');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.bento-card, section h2, .hero-gradient h1').forEach(el => {
        el.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-10');
        observer.observe(el);
    });
</script>
</body>
</html>