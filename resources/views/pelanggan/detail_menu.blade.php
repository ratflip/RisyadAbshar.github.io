@extends('components.app')

@section('content')
<main class="max-w-container-max mx-auto px-sm md:px-gutter py-lg">
    {{-- Tombol Kembali --}}
    <a href="{{ route('pelanggan.katalog') }}" class="inline-flex items-center gap-xs text-primary font-semibold mb-md hover:underline">
        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        Kembali ke Katalog
    </a>

    {{-- Notifikasi Sukses Memberi Rating --}}
    @if(session('success'))
        <div class="mb-md p-sm bg-green-100 text-green-800 rounded-xl border border-green-200 font-medium text-[14px]">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-lg bg-white p-md md:p-lg rounded-2xl card-shadow">
        
        {{-- Sisi Kiri: Media (Foto & Video) --}}
        <div class="space-y-md">
            {{-- Foto Utama --}}
            <div class="w-full h-72 md:h-96 rounded-xl overflow-hidden bg-surface-container">
                <img alt="{{ $menu->nama }}" class="w-full h-full object-cover" src="{{ filter_var($menu->gambar, FILTER_VALIDATE_URL) ? $menu->gambar : asset('storage/' . $menu->gambar) }}" onerror="this.src='https://placehold.co/600x400?text=No+Image'"/>
            </div>

            {{-- Video Sajian Makanan --}}
            @if($menu->video)
            <div class="space-y-xs">
                <h3 class="font-bold text-on-surface flex items-center gap-xs">
                    <span class="material-symbols-outlined text-primary">play_circle</span>
                    Video Sajian Makanan
                </h3>
                <div class="w-full aspect-video rounded-xl overflow-hidden bg-black">
                    @if(filter_var($menu->video, FILTER_VALIDATE_URL))
                        <iframe class="w-full h-full" src="{{ $menu->video }}" frameborder="0" allowfullscreen></iframe>
                    @else
                        <video class="w-full h-full" controls>
                            <source src="{{ asset('storage/' . $menu->video) }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutar video.
                        </video>
                    @endif
                </div>
            </div>
            @endif
        </div>

        {{-- Sisi Kanan: Informasi Detail Menu --}}
        <div class="flex flex-col justify-between space-y-md">
            <div>
                {{-- Kategori & Label --}}
                <div class="flex flex-wrap gap-xs mb-sm">
                    <span class="bg-surface-container-high text-on-surface-variant px-sm py-1 rounded-full text-[12px] font-bold uppercase tracking-wider">
                        {{ $menu->kategori }}
                    </span>
                    @if($menu->label)
                        <span class="bg-primary text-on-primary px-sm py-1 rounded-full text-[12px] font-bold uppercase tracking-wider">
                            {{ $menu->label }}
                        </span>
                    @endif
                </div>

                {{-- Nama Menu & Rating --}}
                <div class="flex justify-between items-start gap-md mb-xs">
                    <h1 class="text-[28px] md:text-[34px] font-bold text-on-surface leading-tight">{{ $menu->nama }}</h1>
                    <div class="flex items-center gap-0.5 text-secondary bg-secondary-container/30 px-sm py-1 rounded-lg flex-shrink-0">
                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="text-[15px] font-bold">{{ number_format($menu->rating, 1) }}</span>
                    </div>
                </div>

                {{-- Informasi Nutrisi (Makro) --}}
                <div class="grid grid-cols-4 gap-xs border-y border-outline-variant py-sm my-md text-center bg-surface-container-lowest rounded-xl p-xs">
                    <div>
                        <p class="text-primary font-bold text-[16px]">{{ $menu->calories ?? '-' }}</p>
                        <p class="text-[11px] text-on-surface-variant font-medium">Kalori (kcal)</p>
                    </div>
                    <div>
                        <p class="text-on-surface font-bold text-[16px]">{{ $menu->protein ?? '-' }}g</p>
                        <p class="text-[11px] text-on-surface-variant font-medium">Protein</p>
                    </div>
                    <div>
                        <p class="text-on-surface font-bold text-[16px]">{{ $menu->carbs ?? '-' }}g</p>
                        <p class="text-[11px] text-on-surface-variant font-medium">Karbo</p>
                    </div>
                    <div>
                        <p class="text-on-surface font-bold text-[16px]">{{ $menu->fat ?? '-' }}g</p>
                        <p class="text-[11px] text-on-surface-variant font-medium">Lemak</p>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-md">
                    <h3 class="font-bold text-on-surface mb-xs text-[16px]">Deskripsi Menu</h3>
                    <p class="text-on-surface-variant text-[14px] leading-relaxed">{{ $menu->deskripsi }}</p>
                </div>

                {{-- Ingredients --}}
                <div class="mb-md">
                    <h3 class="font-bold text-on-surface mb-xs text-[16px]">Bahan-Bahan / Komposisi</h3>
                    <p class="text-on-surface-variant text-[14px] whitespace-pre-line leading-relaxed">{{ $menu->ingredients ?? 'Informasi bahan belum ditambahkan.' }}</p>
                </div>

                {{-- Fitur Form Rating Customer --}}
                @auth
                <div class="mt-lg p-md bg-surface-container-lowest rounded-xl border border-outline-variant">
                    <h3 class="font-bold text-on-surface mb-xs text-[15px] flex items-center gap-xs">
                        <span class="material-symbols-outlined text-secondary">rate_review</span>
                        Berikan Penilaian Anda
                    </h3>
                    <form action="{{ route('pelanggan.katalog.rate', $menu->id) }}" method="POST" class="flex items-center gap-sm mt-sm">
                        @csrf
                        <select name="user_rating" class="bg-white border border-outline-variant rounded-xl px-sm py-xs text-[14px] text-on-surface focus:outline-none focus:border-primary" required>
                            <option value="" disabled selected>Pilih Bintang</option>
                            <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                            <option value="4">⭐⭐⭐⭐ (4)</option>
                            <option value="3">⭐⭐⭐ (3)</option>
                            <option value="2">⭐⭐ (2)</option>
                            <option value="1">⭐ (1)</option>
                        </select>
                        <button type="submit" class="bg-secondary text-on-secondary font-bold text-[14px] py-xs px-md rounded-xl hover:bg-opacity-90 transition-all shadow-sm">
                            Kirim Rating
                        </button>
                    </form>
                </div>
                @endauth
            </div>

            {{-- Harga & CTA Button --}}
            <div class="bg-surface-container p-sm rounded-xl flex flex-col sm:flex-row items-center justify-between gap-sm border border-outline-variant">
                <div>
                    <p class="text-[12px] text-on-surface-variant font-medium">Harga Berlangganan</p>
                    <p class="text-[22px] md:text-[26px] font-bold text-primary">Rp {{ number_format($menu->harga, 0, ',', '.') }}<span class="text-[14px] font-normal text-on-surface-variant">/porsi</span></p>
                </div>
                
                <a href="{{ route('pelanggan.order', ['id' => $menu->id]) }}" class="w-full sm:w-auto bg-primary text-on-primary font-bold text-[15px] py-xs px-xl rounded-xl hover:bg-primary-container hover:text-primary transition-all flex items-center justify-center gap-sm shadow-md">
                    <span class="material-symbols-outlined text-[22px]">shopping_bag</span>
                    Mulai Berlangganan
                </a>
            </div>

        </div>
    </div>
</main>
@endsection