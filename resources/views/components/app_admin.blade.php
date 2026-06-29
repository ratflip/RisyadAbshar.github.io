<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Dashboard | CateringYuk!</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
                        "on-secondary": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
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
                        "display-lg-mobile": ["Quicksand", "sans-serif"],
                        "headline-md-mobile": ["Quicksand", "sans-serif"],
                        "label-sm": ["Public Sans", "sans-serif"],
                        "body-lg": ["Public Sans", "sans-serif"],
                        "body-md": ["Public Sans", "sans-serif"],
                        "title-lg": ["Quicksand", "sans-serif"],
                        "headline-md": ["Quicksand", "sans-serif"],
                        "display-lg": ["Quicksand", "sans-serif"],
                        "label-md": ["Public Sans", "sans-serif"]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            background-color: #fcf8fb;
            color: #1b1b1d;
        }
        .material-symbols-outlined {
            font-display: block;
        }
        .sidebar-active {
            background-color: #006c0c;
            color: #ffffff;
            font-weight: 700;
        }
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #becab7;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-background text-on-background antialiased">

<aside class="h-screen w-64 fixed left-0 top-0 bg-surface-container-low dark:bg-surface-container-high flex flex-col py-lg space-y-xs overflow-y-auto">
    <div class="px-md mb-xl">
        <h1 class="font-display-lg-mobile text-display-lg-mobile text-primary">CateringYuk!</h1>
        <p class="font-label-md text-label-md text-on-surface-variant opacity-70">Admin Panel</p>
    </div>
    
    <nav class="flex-1 space-y-base">
        <a class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }} mx-2 flex items-center px-sm py-xs rounded-xl transition-all duration-200" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined mr-xs" style="font-variation-settings: 'FILL' 1, 'wght' 600;">dashboard</span>
            <span class="font-label-md text-label-md">Dashboard</span>
        </a>
        
        <a class="{{ request()->routeIs('admin.menu') ? 'sidebar-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }} mx-2 flex items-center px-sm py-xs rounded-xl transition-all duration-200" href="{{ route('admin.menu') }}">
            <span class="material-symbols-outlined mr-xs">restaurant_menu</span>
            <span class="font-label-md text-label-md">Manajemen Menu</span>
        </a>
        
        <a class="{{ request()->routeIs('admin.laporan') ? 'sidebar-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }} mx-2 flex items-center px-sm py-xs rounded-xl transition-all duration-200" href="{{ route('admin.laporan') }}">
            <span class="material-symbols-outlined mr-xs">assessment</span>
            <span class="font-label-md text-label-md">Laporan</span>
        </a>
        
    </nav>
    
    <div class="px-md pt-lg border-t border-outline-variant/30 space-y-sm">
        <form method="POST" action="{{ route('logout') }}" class="w-full m-0">
            @csrf
            <button type="submit" class="w-full text-error font-label-md text-label-md py-sm px-md rounded-xl hover:bg-error-container transition-colors flex items-center justify-center gap-xs cursor-pointer">
                <span class="material-symbols-outlined">logout</span>
                Keluar
            </button>
        </form>
    </div>
</aside>

@yield('content')

<footer class="ml-64 px-gutter py-md bg-inverse-surface text-white">
    <div class="max-w-container-max mx-auto flex justify-between items-center text-xs">
        <span>© 2024 CateringYuk!</span>
    </div>
</footer>

<script>
    // Data dikirim langsung dari Controller melalui Blade
    const dashboardData = @json($statsData ?? []);

    function updateDashboard() {
        if (!dashboardData || Object.keys(dashboardData).length === 0) return;

        // 1. Update Statistik Utama
        document.getElementById('stat-total-pesanan').innerText = dashboardData.stats.totalPesananHariIni;
        document.getElementById('stat-pending').innerText = dashboardData.stats.pending;
        document.getElementById('stat-processing').innerText = dashboardData.stats.processing;
        document.getElementById('stat-pendapatan').innerText = dashboardData.stats.pendapatan;

        // 2. Update Grafik Status (Bar)
        const total = dashboardData.stats.paid + dashboardData.stats.pending + dashboardData.stats.processing;
        
        const updateBar = (status, count, idLabel, idBar) => {
            const percent = total > 0 ? Math.round((count / total) * 100) : 0;
            document.getElementById(idLabel).innerText = `${count} Pesanan (${percent}%)`;
            document.getElementById(idBar).style.width = `${percent}%`;
        };

        updateBar('paid', dashboardData.stats.paid, 'label-paid', 'bar-paid');
        updateBar('processing', dashboardData.stats.processing, 'label-processing', 'bar-processing');
        updateBar('pending', dashboardData.stats.pending, 'label-pending', 'bar-pending');

        // 3. Update Volume Mingguan
        const maxVal = Math.max(...Object.values(dashboardData.volumeMingguan), 1); // Hindari pembagian dengan 0
        for (const [day, count] of Object.entries(dashboardData.volumeMingguan)) {
            const height = (count / maxVal) * 100;
            const col = document.getElementById(`col-${day}`);
            const val = document.getElementById(`val-${day}`);
            if (col && val) {
                col.style.height = `${Math.max(height, 5)}%`; // Minimal 5% agar terlihat
                val.innerText = count;
            }
        }
    }

    document.addEventListener('DOMContentLoaded', updateDashboard);
</script>
</body>
</html>