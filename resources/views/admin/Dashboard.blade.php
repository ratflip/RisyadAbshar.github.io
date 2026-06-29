@extends('components.app_admin')

@section('content')
<main class="ml-64 min-h-screen p-md pb-xl">
    <header class="flex justify-between items-center mb-lg sticky top-0 bg-background/80 backdrop-blur-md z-10 py-sm">
        <div>
            <h2 class="font-headline-md text-headline-md text-on-surface">Ringkasan Dashboard</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Selamat datang kembali, Admin CateringYuk!</p>
        </div>
        <div class="flex items-center gap-md">
            <div class="flex items-center gap-sm pl-md border-l border-outline-variant/60">
                <div class="text-left hidden sm:block max-w-[110px]">
                    <p class="font-label-md text-label-md text-on-surface font-bold leading-tight tracking-tight">{{ Auth::user()->username }}</p>
                    <p class="font-label-sm text-label-sm text-on-surface-variant opacity-70 mt-0.5">Pengelola</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold border-2 border-primary-container">
                    {{ strtoupper(substr(Auth::user()->username, 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-md mb-xl">
        <div class="bg-surface-container-lowest p-md rounded-xl shadow-[0px_4px_20px_rgba(0,0,0,0.02)] border border-outline-variant/20">
            <div class="flex justify-between items-start mb-sm">
                <div class="p-xs bg-primary-container/10 rounded-lg"><span class="material-symbols-outlined text-primary">assignment</span></div>
            </div>
            <p class="font-label-md text-label-md text-on-surface-variant">Total Pesanan Hari Ini</p>
            <p id="stat-total-pesanan" class="font-headline-md text-headline-md mt-base text-on-surface font-bold">0</p>
        </div>
        <div class="bg-surface-container-lowest p-md rounded-xl shadow-[0px_4px_20px_rgba(0,0,0,0.02)] border border-outline-variant/20">
            <div class="flex justify-between items-start mb-sm">
                <div class="p-xs bg-secondary-container/10 rounded-lg"><span class="material-symbols-outlined text-secondary">pending_actions</span></div>
            </div>
            <p class="font-label-md text-label-md text-on-surface-variant">Menunggu Konfirmasi</p>
            <p id="stat-pending" class="font-headline-md text-headline-md mt-base text-on-surface font-bold">0</p>
        </div>
        <div class="bg-surface-container-lowest p-md rounded-xl shadow-[0px_4px_20px_rgba(0,0,0,0.02)] border border-outline-variant/20">
            <div class="flex justify-between items-start mb-sm">
                <div class="p-xs bg-surface-tint/10 rounded-lg"><span class="material-symbols-outlined text-surface-tint">local_shipping</span></div>
            </div>
            <p class="font-label-md text-label-md text-on-surface-variant">Pesanan Aktif (Processing)</p>
            <p id="stat-processing" class="font-headline-md text-headline-md mt-base text-on-surface font-bold">0</p>
        </div>
        <div class="bg-surface-container-lowest p-md rounded-xl shadow-[0px_4px_20px_rgba(0,0,0,0.02)] border border-outline-variant/20">
            <div class="flex justify-between items-start mb-sm">
                <div class="p-xs bg-tertiary-container/10 rounded-lg"><span class="material-symbols-outlined text-tertiary">payments</span></div>
            </div>
            <p class="font-label-md text-label-md text-on-surface-variant">Pendapatan Bulan Ini</p>
            <p id="stat-pendapatan" class="font-headline-md text-headline-md mt-base text-on-surface font-bold">Rp 0</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-md">
        <div class="lg:col-span-2 bg-surface-container-lowest p-md rounded-2xl shadow-[0px_4px_20px_rgba(0,0,0,0.02)] border border-outline-variant/20">
            <div class="flex justify-between items-center mb-md">
                <h3 class="text-title-lg font-title-lg text-on-surface font-bold">Grafik Status Pesanan</h3>
                <span class="text-xs text-on-surface-variant bg-surface-container px-xs py-1 rounded-full font-medium">Database Synced</span>
            </div>
            
            <div class="space-y-md">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium text-on-surface flex items-center gap-xs"><span class="w-2 h-2 rounded-full bg-primary"></span> Paid (Lunas)</span>
                        <span id="label-paid" class="font-bold text-on-surface">0 Pesanan (0%)</span>
                    </div>
                    <div class="w-full bg-surface-container rounded-full h-3 overflow-hidden">
                        <div id="bar-paid" class="bg-primary h-full rounded-full transition-all duration-700" style="width: 0%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium text-on-surface flex items-center gap-xs"><span class="w-2 h-2 rounded-full bg-tertiary-container"></span> Processing</span>
                        <span id="label-processing" class="font-bold text-on-surface">0 Pesanan (0%)</span>
                    </div>
                    <div class="w-full bg-surface-container rounded-full h-3 overflow-hidden">
                        <div id="bar-processing" class="bg-tertiary-container h-full rounded-full transition-all duration-700" style="width: 0%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium text-on-surface flex items-center gap-xs"><span class="w-2 h-2 rounded-full bg-secondary"></span> Pending</span>
                        <span id="label-pending" class="font-bold text-on-surface">0 Pesanan (0%)</span>
                    </div>
                    <div class="w-full bg-surface-container rounded-full h-3 overflow-hidden">
                        <div id="bar-pending" class="bg-secondary h-full rounded-full transition-all duration-700" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-md rounded-2xl shadow-[0px_4px_20px_rgba(0,0,0,0.02)] border border-outline-variant/20 flex flex-col justify-between">
            <div class="mb-sm">
                <h3 class="text-title-lg font-title-lg text-on-surface font-bold">Volume Mingguan</h3>
                <p class="text-xs text-on-surface-variant">Jumlah total pesanan masuk minggu ini</p>
            </div>

            <div class="flex items-end justify-between h-36 px-sm gap-xs">
                <div class="flex flex-col items-center flex-1 group cursor-pointer">
                    <div id="col-senin" class="w-full bg-primary/20 group-hover:bg-primary/40 rounded-t-md transition-all relative" style="height: 10px">
                        <span id="val-senin" class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold bg-inverse-surface text-white px-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">0</span>
                    </div>
                    <span class="text-[11px] text-on-surface-variant mt-xs font-medium">Sen</span>
                </div>
                <div class="flex flex-col items-center flex-1 group cursor-pointer">
                    <div id="col-selasa" class="w-full bg-primary/20 group-hover:bg-primary/40 rounded-t-md transition-all relative" style="height: 10px">
                        <span id="val-selasa" class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold bg-inverse-surface text-white px-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">0</span>
                    </div>
                    <span class="text-[11px] text-on-surface-variant mt-xs font-medium">Sel</span>
                </div>
                <div class="flex flex-col items-center flex-1 group cursor-pointer">
                    <div id="col-rabu" class="w-full bg-primary/20 group-hover:bg-primary/40 rounded-t-md transition-all relative" style="height: 10px">
                        <span id="val-rabu" class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold bg-inverse-surface text-white px-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">0</span>
                    </div>
                    <span class="text-[11px] text-on-surface-variant mt-xs font-medium">Rab</span>
                </div>
                <div class="flex flex-col items-center flex-1 group cursor-pointer">
                    <div id="col-kamis" class="w-full bg-primary/20 group-hover:bg-primary/40 rounded-t-md transition-all relative" style="height: 10px">
                        <span id="val-kamis" class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold bg-inverse-surface text-white px-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">0</span>
                    </div>
                    <span class="text-[11px] text-on-surface-variant mt-xs font-medium">Kam</span>
                </div>
                <div class="flex flex-col items-center flex-1 group cursor-pointer">
                    <div id="col-jumat" class="w-full bg-primary/20 group-hover:bg-primary/40 rounded-t-md transition-all relative" style="height: 10px">
                        <span id="val-jumat" class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold bg-inverse-surface text-white px-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">0</span>
                    </div>
                    <span class="text-[11px] text-on-surface-variant mt-xs font-medium">Jum</span>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection