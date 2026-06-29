@extends('components.app_admin')

@section('content')
    <main class="ml-64 flex-1 p-lg max-w-[1400px]">
        
        @if(session('success'))
            <div class="mb-md p-sm bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-md p-sm bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm">
                <p class="font-bold mb-xs">Gagal memproses data:</p>
                <ul class="list-disc pl-md text-label-md">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <header class="flex flex-col md:flex-row md:items-center justify-between gap-md mb-xl">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">Manajemen Menu</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Kelola daftar hidangan, kategori, dan harga catering Anda.</p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-sm">
                <form method="GET" action="{{ route('admin.menu') }}" class="relative w-full sm:w-80">
                    <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline">search</span>
                    <input name="search" value="{{ $search ?? '' }}" class="w-full pl-xl pr-md py-sm rounded-lg border border-outline-variant bg-surface-container-lowest focus:ring-2 focus:ring-primary focus:outline-none transition-all font-body-md" placeholder="Cari nama menu atau kategori..." type="text" onchange="this.form.submit()"/>
                </form>
                <button class="w-full sm:w-auto flex items-center justify-center gap-xs bg-primary text-on-primary px-lg py-sm rounded-lg font-label-md text-label-md hover:scale-105 active:scale-95 transition-all shadow-md" onclick="openModal('add')">
                    <span class="material-symbols-outlined">add</span>
                    Tambah Menu Baru
                </button>
            </div>
        </header>

        <section class="bg-surface-container-lowest rounded-xl shadow-[0px_4px_20px_rgba(0,0,0,0.05)] overflow-hidden border border-outline-variant/30">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container text-on-surface-variant">
                        <tr>
                            <th class="px-md py-sm font-label-md text-label-md">Menu</th>
                            <th class="px-md py-sm font-label-md text-label-md">Kategori</th>
                            <th class="px-md py-sm font-label-md text-label-md">Harga</th>
                            <th class="px-md py-sm font-label-md text-label-md">Status</th>
                            <th class="px-md py-sm font-label-md text-label-md text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @forelse($menus as $menu)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-md py-sm">
                                <div class="flex items-center gap-md">
                                    <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-surface-container">
                                        <img alt="{{ $menu->nama }}" class="w-full h-full object-cover" src="{{ $menu->gambar ? asset('storage/' . $menu->gambar) : 'https://placehold.co/100x100?text=No+Image' }}"/>
                                    </div>
                                    <div>
                                        <p class="font-title-lg text-title-lg text-on-surface">{{ $menu->nama }}</p>
                                        <p class="text-label-sm text-on-surface-variant">{{ $menu->label ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-md py-sm">
                                {{-- PERBAIKAN: Penentuan warna lencana otomatis sesuai kategori baru --}}
                                @php
                                    $badgeColor = 'bg-gray-100 text-gray-800';
                                    if ($menu->kategori === 'High Protein') $badgeColor = 'bg-emerald-100 text-emerald-800';
                                    elseif ($menu->kategori === 'Weight Loss') $badgeColor = 'bg-sky-100 text-sky-800';
                                    elseif ($menu->kategori === 'Low Carbo') $badgeColor = 'bg-purple-100 text-purple-800';
                                @endphp
                                <span class="px-sm py-base {{ $badgeColor }} rounded-full text-label-sm font-bold whitespace-nowrap">
                                    {{ $menu->kategori }}
                                </span>
                            </td>
                            <td class="px-md py-sm font-bold text-primary">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                            <td class="px-md py-sm">
                                <label class="relative inline-flex items-center cursor-pointer select-none">
                                    <input {{ $menu->is_available ? 'checked' : '' }} class="sr-only peer" type="checkbox" onchange="toggleMenuStatus(this, '{{ $menu->id }}')"/>
                                    <div class="w-11 h-6 bg-outline-variant rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    <span class="ml-xs text-label-sm font-medium text-on-surface status-text">{{ $menu->is_available ? 'Aktif' : 'Nonaktif' }}</span>
                                </label>
                            </td>
                            <td class="px-md py-sm">
                                <div class="flex justify-center gap-sm">
                                    <button class="p-xs text-primary hover:bg-primary/10 rounded-lg transition-colors" 
                                            onclick="openModal('edit', {{ json_encode($menu) }})">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-xs text-secondary hover:bg-secondary/10 rounded-lg transition-colors">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-md py-md text-center text-on-surface-variant">Menu tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PANEL NAVIGATION PAGINASI --}}
            <div class="px-md py-md bg-surface-container-low flex items-center justify-between">
                <p class="text-label-sm text-on-surface-variant">
                    @if(method_exists($menus, 'firstItem'))
                        Menampilkan {{ $menus->firstItem() ?? 0 }} sampai {{ $menus->lastItem() ?? 0 }} dari {{ $menus->total() }} menu
                    @else
                        Menampilkan total {{ $menus->count() }} menu
                    @endif
                </p>
                
                <div class="flex gap-xs items-center">
                    @if(method_exists($menus, 'links') && $menus->hasPages())
                        @if ($menus->onFirstPage())
                            <button class="p-xs border border-outline-variant rounded-lg opacity-30 cursor-not-allowed" disabled>
                                <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                        @else
                            <a href="{{ $menus->previousPageUrl() }}" class="p-xs border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">
                                <span class="material-symbols-outlined">chevron_left</span>
                            </a>
                        @endif

                        @foreach ($menus->getUrlRange(1, $menus->lastPage()) as $page => $url)
                            @if ($page == $menus->currentPage())
                                <button class="w-10 h-10 bg-primary text-on-primary rounded-lg font-bold">{{ $page }}</button>
                            @else
                                <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg hover:bg-surface-container transition-colors font-medium text-on-surface">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($menus->hasMorePages())
                            <a href="{{ $menus->nextPageUrl() }}" class="p-xs border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </section>
    </main>

    {{-- MODAL TAMBAH & EDIT MENU --}}
    <div id="menuModal" class="fixed inset-0 z-50 hidden bg-black/50 items-center justify-center p-sm backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full max-h-[90vh] flex flex-col overflow-hidden border border-outline-variant transform scale-95 transition-transform duration-300">
            
            <header class="px-lg py-md border-b border-outline-variant flex justify-between items-center bg-surface-container flex-shrink-0">
                <h3 id="modalTitle" class="text-title-lg font-bold text-on-surface">Tambah Menu Baru</h3>
                <button type="button" onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-colors focus:outline-none">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </header>
            
            <form id="modalForm" method="POST" enctype="multipart/form-data" class="flex-1 overflow-y-auto p-lg space-y-md">
                @csrf
                <div id="methodContainer"></div>

                <div>
                    <label class="block text-label-md font-medium mb-xs text-on-surface">Nama Menu</label>
                    <input type="text" id="formNama" name="nama" required class="w-full p-sm border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:outline-none" placeholder="Masukkan nama menu hidangan"/>
                </div>
                
                <div class="grid grid-cols-2 gap-sm">
                    <div>
                        <label class="block text-label-md font-medium mb-xs text-on-surface">Harga (Rp)</label>
                        <input type="number" id="formHarga" name="harga" required class="w-full p-sm border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:outline-none" placeholder="Contoh: 25000"/>
                    </div>
                    <div>
                        <label class="block text-label-md font-medium mb-xs text-on-surface">Kategori</label>
                        {{-- PERBAIKAN: Isi dropdown diganti ke kategori baru --}}
                        <select id="formKategori" name="kategori" required class="w-full p-sm border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:outline-none">
                            <option value="High Protein">High Protein</option>
                            <option value="Weight Loss">Weight Loss</option>
                            <option value="Low Carbo">Low Carbo</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label class="block text-label-md font-medium mb-xs text-on-surface">Tag / Label (Opsional)</label>
                    <input type="text" id="formLabel" name="label" placeholder="Contoh: Terlaris, Pedas, Rekomendasi" class="w-full p-sm border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:outline-none"/>
                </div>
                
                <div>
                    <label class="block text-label-md font-medium mb-xs text-on-surface">Deskripsi Menu</label>
                    <textarea id="formDeskripsi" name="deskripsi" rows="3" required class="w-full p-sm border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:outline-none" placeholder="Tuliskan komponen atau detail porsi hidangan..."></textarea>
                </div>

                <div>
                    <label class="block text-label-md font-medium mb-xs text-on-surface">Bahan & Komposisi</label>
                    <textarea id="formKomposisi" name="komposisi" rows="3" required class="w-full p-sm border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:outline-none" placeholder="Contoh: Beras organik, Daging ayam fillet, Bawang putih, Cabai, Ketumbar..."></textarea>
                </div>
                
                <div>
                    <label class="block text-label-md font-medium mb-xs text-on-surface">Foto Menu</label>
                    <input type="file" id="formGambar" name="gambar" accept="image/*" class="w-full p-xs border border-outline-variant rounded-lg file:mr-sm file:py-xs file:px-sm file:rounded-md file:border-0 file:text-label-sm file:bg-surface-container file:text-on-surface hover:file:bg-surface-container-high cursor-pointer"/>
                </div>
                
                <div class="flex justify-end gap-sm pt-md border-t border-outline-variant mt-lg">
                    <button type="button" onclick="closeModal()" class="px-md py-sm border border-outline bg-surface hover:bg-surface-container-low text-on-surface rounded-lg font-medium text-label-md transition-colors">
                        Kembali
                    </button>
                    <button type="submit" class="px-md py-sm bg-primary text-on-primary hover:bg-primary/90 rounded-lg font-medium text-label-md shadow-sm transition-colors">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

<script>
    function openModal(mode, data = null) {
        const modal = document.getElementById('menuModal');
        const form = document.getElementById('modalForm');
        const title = document.getElementById('modalTitle');
        const methodContainer = document.getElementById('methodContainer');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        if (mode === 'add') {
            title.innerText = 'Tambah Menu Baru';
            form.action = "{{ route('admin.menu.store') }}";
            methodContainer.innerHTML = '';
            
            document.getElementById('formNama').value = '';
            document.getElementById('formHarga').value = '';
            document.getElementById('formLabel').value = '';
            document.getElementById('formDeskripsi').value = '';
            document.getElementById('formKomposisi').value = '';
            
            const fileInput = document.getElementById('formGambar');
            if (fileInput) { fileInput.value = ""; }
            
            // PERBAIKAN: Default value diganti ke kategori baru
            document.getElementById('formKategori').value = "High Protein";

        } else if (mode === 'edit' && data) {
            title.innerText = 'Edit Data Menu';
            form.action = `/admin/manajemen-menu/${data.id}`;
            methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            
            document.getElementById('formNama').value = data.nama;
            document.getElementById('formHarga').value = data.harga;
            document.getElementById('formKategori').value = data.kategori;
            document.getElementById('formLabel').value = data.label || '';
            document.getElementById('formDeskripsi').value = data.deskripsi;
            document.getElementById('formKomposisi').value = data.komposisi || '';
        }
    }

    function closeModal() {
        const modal = document.getElementById('menuModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    window.onclick = function(event) {
        const modal = document.getElementById('menuModal');
        if (event.target === modal) { closeModal(); }
    }

    function toggleMenuStatus(checkbox, id) {
        const statusLabel = checkbox.closest('label').querySelector('.status-text');
        
        fetch(`/admin/manajemen-menu/${id}/toggle`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                statusLabel.innerText = data.is_available ? 'Aktif' : 'Nonaktif';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            checkbox.checked = !checkbox.checked;
        });
    }
</script>
@endsection