@extends('components.app')

@section('content')
<main class="max-w-container-max mx-auto px-sm md:px-gutter py-lg">
    {{-- Bungkus semuanya dalam form GET agar filter saling tersinkronisasi --}}
    <form method="GET" action="{{ route('pelanggan.katalog') }}">
        <div class="flex flex-col md:flex-row gap-md lg:gap-lg">
            
            {{-- SIDEBAR FILTER --}}
            <aside class="w-full md:w-64 lg:w-72 flex-shrink-0 space-y-md lg:space-y-lg">
                <div class="bg-white p-md rounded-xl card-shadow">
                    <h3 class="font-title-lg text-title-lg mb-sm flex items-center gap-xs">
                        <span class="material-symbols-outlined text-primary">filter_list</span>
                        Filter Menu
                    </h3>
                    
                    <div class="md:hidden mb-md relative">
                        <input name="search" value="{{ request('search') }}" onchange="this.form.submit()" class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl py-xs px-lg pl-xl focus:ring-2 focus:ring-primary outline-none" placeholder="Cari menu..." type="text"/>
                        <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    </div>

                    {{-- PERBAIKAN: Checkbox Kategori Baru --}}
                    <div class="mb-md">
                        <p class="font-label-md text-label-md font-bold mb-xs text-on-surface-variant uppercase tracking-wider">Kategori Diet</p>
                        <div class="space-y-xs">
                            <label class="flex items-center gap-sm group cursor-pointer">
                                <input type="checkbox" name="kategori[]" value="High Protein" onchange="this.form.submit()" {{ in_array('High Protein', request('kategori', [])) ? 'checked' : '' }} class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary"/>
                                <span class="font-body-md text-body-md text-on-surface-variant group-hover:text-primary transition-colors">High Protein</span>
                            </label>
                            <label class="flex items-center gap-sm group cursor-pointer">
                                <input type="checkbox" name="kategori[]" value="Weight Loss" onchange="this.form.submit()" {{ in_array('Weight Loss', request('kategori', [])) ? 'checked' : '' }} class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary"/>
                                <span class="font-body-md text-body-md text-on-surface-variant group-hover:text-primary transition-colors">Weight Loss</span>
                            </label>
                            <label class="flex items-center gap-sm group cursor-pointer">
                                <input type="checkbox" name="kategori[]" value="Low Carbo" onchange="this.form.submit()" {{ in_array('Low Carbo', request('kategori', [])) ? 'checked' : '' }} class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary"/>
                                <span class="font-body-md text-body-md text-on-surface-variant group-hover:text-primary transition-colors">Low Carbo</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-xs">
                            <p class="font-label-md text-label-md font-bold text-on-surface-variant uppercase tracking-wider">Maks Harga</p>
                            <span id="priceDisplay" class="font-label-md text-label-md text-primary">
                                Rp {{ number_format(request('harga_max', 250000)/1000, 0) }}k
                            </span>
                        </div>
                        <input name="harga_max" value="{{ request('harga_max', 250000) }}" max="250000" min="20000" step="5000" type="range" class="w-full h-2 bg-surface-container rounded-lg appearance-none cursor-pointer accent-primary" 
                               oninput="document.getElementById('priceDisplay').innerText = 'Rp ' + (this.value/1000) + 'k'"
                               onchange="this.form.submit()"/>
                        <div class="flex justify-between mt-xs font-label-sm text-label-sm text-on-surface-variant">
                            <span>Rp 20rb</span>
                            <span>Rp 250rb</span>
                        </div>
                    </div>

                    <a href="{{ route('pelanggan.katalog') }}" class="block text-center w-full mt-md bg-surface-container-high text-on-surface-variant font-label-md text-label-md py-xs rounded-lg hover:bg-primary hover:text-on-primary transition-all">
                        Reset Filter
                    </a>
                </div>
            </aside>

            {{-- KONTEN UTAMA PRODUK --}}
            <div class="flex-1">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-md gap-sm">
                    <div>
                        <h1 class="text-[24px] md:text-[28px] font-bold text-on-surface mb-xs">Katalog Menu Kami</h1>
                        <p class="font-body-md text-body-md text-on-surface-variant">Menyajikan {{ $totalMenu }} pilihan menu segar dari dapur kami.</p>
                    </div>
                    
                    <div class="flex items-center gap-xs w-full sm:w-auto">
                        <div class="hidden sm:block relative flex-1 mr-4">
                            <input name="search_desktop" value="{{ request('search') }}" onchange="this.form.search.value = this.value; this.form.submit()" class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl py-xs px-lg pl-xl focus:ring-2 focus:ring-primary outline-none" placeholder="Cari menu..." type="text"/>
                            <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                        </div>
                        <span class="font-label-md text-label-md text-on-surface-variant flex-shrink-0">Urutkan:</span>
                        <select name="sort" onchange="this.form.submit()" class="bg-transparent border-none font-label-md text-label-md text-primary font-bold focus:ring-0 cursor-pointer">
                            <option value="terpopuler" {{ request('sort') == 'terpopuler' ? 'selected' : '' }}>Terpopuler</option>
                            <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Harga Tertinggi</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-sm md:gap-md">
                    
                    @forelse ($menus as $menu)
                    <div class="bg-white rounded-xl overflow-hidden card-shadow card-hover transition-all duration-300 flex flex-col group">
                        
                        {{-- Image & Badge Section --}}
                        <div class="h-44 overflow-hidden relative">
                            <a href="{{ route('pelanggan.katalog.detail', $menu->slug) }}" class="block w-full h-full">
                                <img alt="{{ $menu->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ filter_var($menu->gambar, FILTER_VALIDATE_URL) ? $menu->gambar : asset('storage/' . $menu->gambar) }}" onerror="this.src='https://placehold.co/400x300?text=No+Image'"/>
                            </a>
                            
                            {{-- PERBAIKAN: Lencana Dinamis Menyesuaikan Kategori Baru --}}
                            @php
                                $badgeBg = 'bg-primary text-on-primary';
                                if ($menu->kategori === 'High Protein') $badgeBg = 'bg-emerald-600 text-white';
                                elseif ($menu->kategori === 'Weight Loss') $badgeBg = 'bg-sky-600 text-white';
                                elseif ($menu->kategori === 'Low Carbo') $badgeBg = 'bg-purple-600 text-white';
                            @endphp
                            <div class="absolute top-xs left-xs {{ $badgeBg }} font-label-sm text-[11px] font-bold px-sm py-1 rounded-full shadow-sm pointer-events-none">
                                {{ $menu->kategori }}
                            </div>

                            {{-- Label Tambahan Opsional (Misal: Terlaris / Promo) --}}
                            @if($menu->label)
                                <div class="absolute top-xs right-xs bg-amber-500 text-white font-label-sm text-[10px] font-bold px-2 py-0.5 rounded-md shadow-sm pointer-events-none uppercase">
                                    {{ $menu->label }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-sm flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-[18px] text-on-surface mb-xs group-hover:text-primary transition-colors line-clamp-1">
                                    <a href="{{ route('pelanggan.katalog.detail', $menu->slug) }}">
                                        {{ $menu->nama }}
                                    </a>
                                </h3>
                                <p class="text-[13px] text-on-surface-variant mb-sm line-clamp-2">{{ $menu->deskripsi }}</p>
                            </div>
                            <div class="w-full">
                                <div class="flex justify-between items-center mb-xs gap-xs">
                                    <span class="text-[16px] xl:text-[18px] font-bold text-primary whitespace-nowrap">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                    <div class="flex items-center gap-0.5 text-secondary flex-shrink-0">
                                        <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                        <span class="text-[13px] font-bold">{{ number_format($menu->rating, 1) }}</span>
                                    </div>
                                </div>
                                
                                <a href="{{ route('pelanggan.order', ['id' => $menu->id]) }}" class="w-full bg-primary text-on-primary font-semibold text-[13px] py-2 px-1 rounded-lg hover:bg-primary-container hover:text-primary transition-all flex items-center justify-center gap-1 text-center min-h-[38px]">
                                    <span class="material-symbols-outlined text-[18px] flex-shrink-0">shopping_bag</span>
                                    <span class="whitespace-nowrap tracking-tight">Pesan Langganan</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-xl text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-[48px] mb-2 opacity-50">search_off</span>
                        <p>Menu tidak ditemukan untuk filter ini.</p>
                    </div>
                    @endforelse

                </div>

                <div class="mt-lg">
                    {{ $menus->links() }}
                </div>

            </div>
        </div>
    </form>
</main>
@endsection