@extends('components.app')

@section('content')

{{-- Kalkulasi Harga Dinamis Berdasarkan Harga Asli Menu --}}
@php
    $harga5Hari = $menu->harga * 5;
    $harga20Hari = $menu->harga * 20;
    $harga30Hari = $menu->harga * 30;
@endphp

<main class="max-w-container-max mx-auto px-gutter py-lg min-h-screen">
    
    <form action="{{ route('pelanggan.order.proses') }}" method="POST" id="order-form">
        @csrf
        {{-- TAMBAHKAN BLOK ERROR INI --}}
     @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Gagal memproses!</strong>
                <ul class="list-disc pl-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
        <input type="hidden" name="nama_menu" value="{{ $menu->nama }}">
        <input type="hidden" name="durasi" id="input-durasi" value="5 Hari">
        <input type="hidden" name="harga_paket" id="input-harga-paket" value="{{ $harga5Hari }}">
        <input type="hidden" name="kuantitas" id="input-kuantitas" value="1">
        <input type="hidden" name="total_harga" id="input-total-harga" value="{{ $harga5Hari }}">
        <input type="hidden" name="lewati_akhir_pekan" id="input-lewati-akhir-pekan" value="1">

        {{-- Container Grid Utama --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg items-start">
            
            {{-- BAGIAN KIRI (Lebar 8 Kolom) --}}
            <div class="lg:col-span-8 space-y-lg">
                
                <div class="mb-lg text-center md:text-left">
                    <h1 class="font-headline-md text-headline-md text-on-surface">Pesan Langganan</h1>
                    <p class="font-body-md text-body-md text-on-surface-variant">Atur jadwal makan sehat Anda dengan mudah dan praktis.</p>
                </div>

                {{-- Stepper --}}
                <div class="flex justify-between items-center mb-xl border-b border-outline-variant max-w-3xl mx-auto md:mx-0">
                    <div class="step-active pb-xs px-base cursor-pointer transition-all-custom flex items-center gap-xs" id="step-btn-1">
                        <span class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-[12px]">1</span>
                        <span class="font-label-md text-label-md">Pilih Durasi</span>
                    </div>
                    <div class="h-px bg-outline-variant flex-grow mx-sm mb-xs"></div>
                    <div class="step-inactive pb-xs px-base cursor-pointer transition-all-custom flex items-center gap-xs" id="step-btn-2">
                        <span class="w-6 h-6 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center text-[12px]">2</span>
                        <span class="font-label-md text-label-md">Jadwal & Alamat</span>
                    </div>
                    <div class="h-px bg-outline-variant flex-grow mx-sm mb-xs"></div>
                    <div class="step-inactive pb-xs px-base cursor-pointer transition-all-custom flex items-center gap-xs" id="step-btn-3">
                        <span class="w-6 h-6 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center text-[12px]">3</span>
                        <span class="font-label-md text-label-md">Konfirmasi</span>
                    </div>
                </div>

                {{-- STEP 1: Pilih Paket --}}
                <section class="transition-opacity duration-300" id="step-1">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-sm gap-sm">
                        <h2 class="font-title-lg text-title-lg text-on-surface">Pilih Paket Langganan</h2>
                        <div class="flex items-center gap-xs">
                            <span class="font-label-md text-label-md text-on-surface-variant">Lewati Akhir Pekan</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input checked class="sr-only peer" type="checkbox" id="checkbox-akhir-pekan"/>
                                <div class="w-11 h-6 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-sm">
                        <div class="package-card group border-2 border-primary bg-surface-container-lowest p-sm rounded-xl shadow-[0px_4px_20px_rgba(0,0,0,0.05)] cursor-pointer relative overflow-hidden" data-duration="5 Hari" data-price="{{ $harga5Hari }}">
                            <div class="absolute top-0 right-0 bg-primary text-white px-xs py-[2px] rounded-bl-lg font-label-sm text-label-sm">Populer</div>
                            <h3 class="font-headline-md text-headline-md text-primary mb-xs">5 Hari</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant mb-md">Cocok untuk percobaan minggu pertama.</p>
                            <p class="font-title-lg text-title-lg font-bold text-on-surface">Rp {{ number_format($harga5Hari, 0, ',', '.') }}</p>
                            <p class="font-label-sm text-label-sm text-outline">Rp {{ number_format($menu->harga, 0, ',', '.') }} / porsi</p>
                        </div>
                        <div class="package-card group border-2 border-transparent hover:border-primary/30 bg-surface-container-lowest p-sm rounded-xl shadow-[0px_4px_20px_rgba(0,0,0,0.05)] cursor-pointer" data-duration="20 Hari" data-price="{{ $harga20Hari }}">
                            <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">20 Hari</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant mb-md">Pilihan hemat untuk hari kerja rutin.</p>
                            <p class="font-title-lg text-title-lg font-bold text-on-surface">Rp {{ number_format($harga20Hari, 0, ',', '.') }}</p>
                            <p class="font-label-sm text-label-sm text-outline">Rp {{ number_format($menu->harga, 0, ',', '.') }} / porsi</p>
                        </div>
                        <div class="package-card group border-2 border-transparent hover:border-primary/30 bg-surface-container-lowest p-sm rounded-xl shadow-[0px_4px_20px_rgba(0,0,0,0.05)] cursor-pointer" data-duration="30 Hari" data-price="{{ $harga30Hari }}">
                            <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">30 Hari</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant mb-md">Terbaik untuk gaya hidup sehat jangka panjang.</p>
                            <p class="font-title-lg text-title-lg font-bold text-on-surface">Rp {{ number_format($harga30Hari, 0, ',', '.') }}</p>
                            <p class="font-label-sm text-label-sm text-outline">Rp {{ number_format($menu->harga, 0, ',', '.') }} / porsi</p>
                        </div>
                    </div>
                </section>

                {{-- STEP 2: Atur Pengiriman --}}
                <section class="space-y-md hidden opacity-0 transition-opacity duration-300" id="step-2">
                    <h2 class="font-title-lg text-title-lg text-on-surface">Atur Pengiriman</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                        
                        <div class="space-y-xs">
                            <label class="font-label-md text-label-md text-on-surface-variant">Tanggal Mulai</label>
                            <div class="relative">
                                <input name="tanggal_mulai" id="input-tanggal-mulai" class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl p-sm focus:ring-2 focus:ring-primary focus:outline-none font-body-md text-body-md" type="date" required/>
                            </div>
                        </div>

                        <div class="space-y-xs">
                            <label class="font-label-md text-label-md text-on-surface-variant">Alamat Pengiriman</label>
                            <div class="relative">
                                <select name="alamat" id="input-alamat" class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl p-sm focus:ring-2 focus:ring-primary focus:outline-none appearance-none font-body-md text-body-md pr-xl" required>
                                    <option value="" disabled selected>Pilih alamat pengiriman</option>
                                    <option value="Apartemen Thamrin Residence, Unit A/12/03">Apartemen Thamrin Residence, Unit A/12/03</option>
                                    <option value="Kantor - Menara BCA, Lt. 45">Kantor - Menara BCA, Lt. 45</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-sm top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                            </div>
                            
                            <button type="button" id="btn-tambah-alamat" class="flex items-center gap-xs text-primary font-bold font-label-md text-label-md hover:underline mt-2">
                                <span class="material-symbols-outlined text-[18px]">add_location_alt</span>
                                + Tambah Alamat Baru
                            </button>

                            <div id="form-alamat-baru" class="hidden mt-2 flex gap-2">
                                <input type="text" id="input-alamat-baru" class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl p-sm focus:ring-2 focus:ring-primary focus:outline-none font-body-md text-body-md" placeholder="Ketik alamat lengkap...">
                                <button type="button" id="btn-simpan-alamat" class="bg-primary text-white px-4 py-2 rounded-xl font-bold hover:opacity-90 transition-all text-sm whitespace-nowrap">Simpan</button>
                            </div>
                        </div>

                    </div>
                </section>

                <div class="flex justify-between pt-lg">
                    <button type="button" class="hidden outline outline-2 outline-primary text-primary px-lg py-sm rounded-xl font-bold hover:-translate-y-0.5 transition-all-custom font-label-md text-label-md" id="prev-btn">Kembali</button>
                    <button type="button" class="ml-auto bg-primary text-white px-lg py-sm rounded-xl font-bold hover:-translate-y-0.5 transition-all-custom shadow-[0px_4px_20px_rgba(0,108,12,0.2)] font-label-md text-label-md" id="next-btn">Selanjutnya</button>
                </div>
            </div>

            {{-- BAGIAN KANAN (Lebar 4 Kolom) --}}
            <aside class="lg:col-span-4 w-full">
                <div class="bg-surface-container-lowest p-md rounded-2xl shadow-[0px_4px_20px_rgba(0,0,0,0.05)] sticky top-24 space-y-md">
                    <h2 class="font-title-lg text-title-lg text-on-surface">Ringkasan Pesanan</h2>
                    
                    <div class="flex gap-sm">
                        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 bg-surface-container border border-outline-variant">
                            <img alt="{{ $menu->nama }}" class="w-full h-full object-cover" src="{{ filter_var($menu->gambar, FILTER_VALIDATE_URL) ? $menu->gambar : asset('storage/' . $menu->gambar) }}" onerror="this.src='https://placehold.co/400x300?text=No+Image'"/>
                        </div>
                        <div class="flex flex-col justify-center">
                            <h4 class="font-label-md text-label-md text-on-surface font-bold">{{ $menu->nama }}</h4>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-1">{{ $menu->deskripsi }}</p>
                            
                            <div class="flex items-center gap-xs mt-xs">
                                <button type="button" id="btn-min-qty" class="w-8 h-8 rounded-full border border-outline-variant flex items-center justify-center hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">remove</span>
                                </button>
                                <span class="font-label-md text-label-md w-6 text-center" id="display-qty">1</span>
                                <button type="button" id="btn-add-qty" class="w-8 h-8 rounded-full border border-outline-variant flex items-center justify-center hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">add</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-sm pt-sm border-t border-outline-variant">
                        <div class="flex justify-between">
                            <span class="font-body-md text-body-md text-on-surface-variant">Durasi Paket</span>
                            <span class="font-label-md text-label-md text-on-surface" id="summary-duration">5 Hari</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-body-md text-body-md text-on-surface-variant">Subtotal</span>
                            <span class="font-label-md text-label-md text-on-surface" id="summary-price">Rp {{ number_format($harga5Hari, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-body-md text-body-md text-on-surface-variant">Ongkos Kirim</span>
                            <span class="font-label-md text-label-md text-primary">Gratis</span>
                        </div>
                    </div>

                    <div class="pt-sm border-t border-outline-variant">
                        <div class="flex justify-between items-end mb-md">
                            <span class="font-title-lg text-title-lg text-on-surface">Total</span>
                            <span class="font-headline-md text-headline-md text-primary" id="summary-total">Rp {{ number_format($harga5Hari, 0, ',', '.') }}</span>
                        </div>
                        <div class="bg-surface-container-low p-sm rounded-xl mb-md">
                            <div class="flex gap-xs items-start">
                                <span class="material-symbols-outlined text-primary text-[20px]">location_on</span>
                                <p class="font-label-sm text-label-sm text-on-surface-variant leading-tight" id="display-alamat">Pilih alamat pada langkah 2</p>
                            </div>
                        </div>
                        
                        <button type="button" class="w-full bg-primary text-white py-md rounded-xl font-bold hover:bg-surface-tint hover:-translate-y-1 transition-all duration-200 shadow-lg flex items-center justify-center gap-xs font-label-md text-label-md" id="final-cta">
                            Lanjut ke Pembayaran
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </aside>
            
        </div>
    </form>
</main>

<script>
    const step1 = document.getElementById('step-1');
    const step2 = document.getElementById('step-2');
    const stepBtn1 = document.getElementById('step-btn-1');
    const stepBtn2 = document.getElementById('step-btn-2');
    const stepBtn3 = document.getElementById('step-btn-3');
    const nextBtn = document.getElementById('next-btn');
    const prevBtn = document.getElementById('prev-btn');
    const finalCta = document.getElementById('final-cta');
    const orderForm = document.getElementById('order-form');

    let currentStep = 1;
    let basePrice = {{ $harga5Hari }}; 
    let currentQty = 1;
    
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    };

    function updateUI() {
        step1.classList.add('hidden', 'opacity-0');
        step2.classList.add('hidden', 'opacity-0');
        
        [stepBtn1, stepBtn2, stepBtn3].forEach(btn => {
            btn.classList.remove('step-active');
            btn.classList.add('step-inactive');
            const dot = btn.querySelector('span:first-child');
            dot.classList.replace('bg-primary', 'bg-surface-container-highest');
            dot.classList.replace('text-white', 'text-on-surface-variant');
        });

        if(currentStep === 1) {
            step1.classList.remove('hidden');
            setTimeout(() => step1.classList.remove('opacity-0'), 10);
            stepBtn1.classList.add('step-active');
            stepBtn1.querySelector('span:first-child').classList.replace('bg-surface-container-highest', 'bg-primary');
            stepBtn1.querySelector('span:first-child').classList.replace('text-on-surface-variant', 'text-white');
            prevBtn.classList.add('hidden');
            nextBtn.innerText = 'Selanjutnya';
        } else if(currentStep === 2) {
            step2.classList.remove('hidden');
            setTimeout(() => step2.classList.remove('opacity-0'), 10);
            stepBtn2.classList.add('step-active');
            stepBtn2.querySelector('span:first-child').classList.replace('bg-surface-container-highest', 'bg-primary');
            stepBtn2.querySelector('span:first-child').classList.replace('text-on-surface-variant', 'text-white');
            prevBtn.classList.remove('hidden');
            nextBtn.innerText = 'Tinjau Pesanan';
        } else {
            stepBtn3.classList.add('step-active');
            stepBtn3.querySelector('span:first-child').classList.replace('bg-surface-container-highest', 'bg-primary');
            stepBtn3.querySelector('span:first-child').classList.replace('text-on-surface-variant', 'text-white');
            step2.classList.remove('hidden', 'opacity-0'); 
        }
    }

    function calculateTotal() {
        const total = basePrice * currentQty;
        document.getElementById('summary-total').innerText = formatRupiah(total);
        document.getElementById('input-total-harga').value = total;
    }

    nextBtn.addEventListener('click', () => {
        if(currentStep === 2) {
            if(!document.getElementById('input-tanggal-mulai').value || !document.getElementById('input-alamat').value) {
                alert('Mohon lengkapi Tanggal Mulai dan Alamat Pengiriman.');
                return;
            }
        }
        
        if(currentStep < 3) {
            currentStep++;
            updateUI();
        }
        
        if(currentStep === 3) {
            nextBtn.classList.add('hidden');
        }
    });

    prevBtn.addEventListener('click', () => {
        if(currentStep > 1) {
            currentStep--;
            nextBtn.classList.remove('hidden');
            updateUI();
        }
    });

    const cards = document.querySelectorAll('.package-card');
    cards.forEach(card => {
        card.addEventListener('click', () => {
            cards.forEach(c => c.classList.replace('border-primary', 'border-transparent'));
            card.classList.replace('border-transparent', 'border-primary');
            
            const durasiText = card.dataset.duration;
            basePrice = parseInt(card.dataset.price);

            document.getElementById('summary-duration').innerText = durasiText;
            document.getElementById('summary-price').innerText = formatRupiah(basePrice);
            document.getElementById('input-durasi').value = durasiText;
            document.getElementById('input-harga-paket').value = basePrice;
            
            calculateTotal();
        });
    });

    document.getElementById('btn-add-qty').addEventListener('click', () => {
        currentQty++;
        document.getElementById('display-qty').innerText = currentQty;
        document.getElementById('input-kuantitas').value = currentQty;
        calculateTotal();
    });

    document.getElementById('btn-min-qty').addEventListener('click', () => {
        if(currentQty > 1) {
            currentQty--;
            document.getElementById('display-qty').innerText = currentQty;
            document.getElementById('input-kuantitas').value = currentQty;
            calculateTotal();
        }
    });

    document.getElementById('checkbox-akhir-pekan').addEventListener('change', (e) => {
        document.getElementById('input-lewati-akhir-pekan').value = e.target.checked ? '1' : '0';
    });

    document.getElementById('input-alamat').addEventListener('change', (e) => {
        document.getElementById('display-alamat').innerText = 'Dikirim ke: ' + e.target.value;
    });

    finalCta.addEventListener('click', () => {
        // Cek apakah user mencoba bayar tapi belum isi alamat
        if (currentStep < 2) {
            alert('Mohon tekan tombol "Selanjutnya" dan lengkapi Jadwal & Alamat terlebih dahulu!');
            // Pindahkan tampilan ke step 2 secara otomatis
            currentStep = 2;
            updateUI();
            return;
        }
        
        // Pengecekan apakah input tanggal dan alamat kosong (Validasi HTML)
        if(!orderForm.checkValidity()) {
            orderForm.reportValidity(); // Memunculkan peringatan merah bawaan browser
            return;
        }

        // Ubah tampilan tombol jadi loading agar user tidak klik 2 kali
        finalCta.innerHTML = '<span class="material-symbols-outlined animate-spin" style="animation: spin 1s linear infinite;">refresh</span> Memproses...';
        finalCta.disabled = true; // Matikan tombol sementara
        finalCta.classList.add('opacity-75', 'cursor-not-allowed');

        // Submit form ke OrderController -> prosesOrder
        orderForm.submit();
    });

    // 1. Set Tanggal Minimal ke Hari Ini
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('input-tanggal-mulai').setAttribute('min', today);

    // 2. Logika Tambah Alamat Baru
    const btnTambahAlamat = document.getElementById('btn-tambah-alamat');
    const formAlamatBaru = document.getElementById('form-alamat-baru');
    const inputAlamatBaru = document.getElementById('input-alamat-baru');
    const btnSimpanAlamat = document.getElementById('btn-simpan-alamat');
    const selectAlamat = document.getElementById('input-alamat');

    btnTambahAlamat.addEventListener('click', () => {
        formAlamatBaru.classList.toggle('hidden');
        if(!formAlamatBaru.classList.contains('hidden')) {
            inputAlamatBaru.focus();
        }
    });

    btnSimpanAlamat.addEventListener('click', () => {
        const newAddress = inputAlamatBaru.value.trim();
        
        if(newAddress !== "") {
            const newOption = document.createElement('option');
            newOption.value = newAddress;
            newOption.text = newAddress;
            
            selectAlamat.appendChild(newOption);
            selectAlamat.value = newAddress;
            
            document.getElementById('display-alamat').innerText = 'Dikirim ke: ' + newAddress;

            formAlamatBaru.classList.add('hidden');
            inputAlamatBaru.value = "";
        } else {
            alert('Alamat tidak boleh kosong!');
        }
    });
</script>
@endsection