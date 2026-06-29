<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Pembayaran - CateringYuk!</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Public+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet"/>
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
                        "surface-dim": "#dcd9dc",
                        "surface-container-high": "#eae7ea",
                        "on-surface": "#1b1b1d",
                        "secondary-fixed": "#ffdbc9",
                        "error": "#ba1a1a",
                        "secondary": "#934b19",
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
                        "primary-container": "#1c871e",
                        "on-error": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "outline": "#6f7a6a",
                        "on-background": "#1b1b1d",
                        "on-primary": "#ffffff",
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .step-done { background: #006c0c; color: white; }
        .step-active { background: #ffa26a; color: white; }
        .step-inactive { background: #e4e2e4; color: #3f4a3b; }
        .bank-card { cursor: pointer; transition: all 0.2s; }
        .bank-card:hover { transform: translateY(-2px); }
        .bank-card.selected { border-color: #006c0c; background: #f8fff0; }
        .copy-btn:active { transform: scale(0.95); }
    </style>
</head>
<body class="bg-surface font-body-md text-on-surface min-h-screen flex flex-col">

@php
    $items = is_string($order->items) ? json_decode($order->items, true) : $order->items;
    $item  = $items[0] ?? null;
    $menu  = \App\Models\Menu::find($item['menu_id'] ?? null);
    $gambarMenu = ($menu && $menu->gambar)
        ? asset('storage/' . $menu->gambar)
        : 'https://ui-avatars.com/api/?name='.urlencode($item['nama_produk'] ?? 'Menu').'&color=006c0c&background=f0edef';
@endphp

{{-- HEADER --}}
<header class="bg-surface shadow-sm sticky top-0 z-50">
    <div class="flex justify-between items-center px-gutter py-sm max-w-container-max mx-auto w-full">
        <h1 class="font-display-lg-mobile text-display-lg-mobile font-bold text-primary">CateringYuk!</h1>
        <a href="{{ route('pelanggan.order') }}" class="flex items-center gap-xs text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali
        </a>
    </div>
</header>

<main class="flex-grow flex flex-col items-center py-lg px-margin-mobile md:px-gutter">
    <div class="w-full max-w-[640px] space-y-md">

        {{-- ALERT SUCCESS/ERROR --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-xl p-sm flex items-center gap-xs">
                <span class="material-symbols-outlined text-primary">check_circle</span>
                <p class="font-label-md text-label-md text-primary">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 rounded-xl p-sm flex items-center gap-xs">
                <span class="material-symbols-outlined text-error">error</span>
                <p class="font-label-md text-label-md text-error">{{ session('error') }}</p>
            </div>
        @endif

        {{-- JUDUL --}}
        <div class="text-center">
            <h2 class="font-headline-md-mobile text-headline-md-mobile text-on-surface">Selesaikan Pembayaran</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-xs">Transfer ke salah satu rekening di bawah, lalu unggah bukti bayar.</p>
        </div>

        {{-- RINGKASAN PESANAN --}}
        <div class="bg-surface-container-lowest rounded-xl p-md shadow-sm border border-outline-variant">
            <div class="flex justify-between items-start border-b border-outline-variant pb-sm mb-sm">
                <div>
                    <p class="font-label-sm text-label-sm text-on-surface-variant">Nomor Invoice</p>
                    <h3 class="font-title-lg text-title-lg text-on-surface">#INV-2026{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</h3>
                </div>
                <div class="text-right">
                    <p class="font-label-sm text-label-sm text-on-surface-variant">Total Tagihan</p>
                    <p class="font-headline-md-mobile text-headline-md-mobile text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-md">
                <div class="w-14 h-14 rounded-lg overflow-hidden bg-surface-container flex-shrink-0">
                    <img class="w-full h-full object-cover" src="{{ $gambarMenu }}" alt="Menu"/>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-title-lg text-title-lg text-on-surface truncate">{{ $item['nama_produk'] ?? 'Menu Catering' }}</h4>
                    <p class="font-body-md text-body-md text-on-surface-variant">{{ $item['kuantitas'] ?? 1 }}x &bull; Paket {{ $item['durasi'] ?? '' }}</p>
                    <p class="font-label-sm text-label-sm text-on-surface-variant">Mulai: {{ \Carbon\Carbon::parse($order->tanggal_mulai)->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </div>

        {{-- STATUS PESANAN --}}
        @if($order->status === 'menunggu_konfirmasi')
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-sm flex items-start gap-xs">
            <span class="material-symbols-outlined text-amber-600 mt-0.5">schedule</span>
            <div>
                <p class="font-label-md text-label-md text-amber-800">Bukti transfer sudah dikirim</p>
                <p class="font-label-sm text-label-sm text-amber-700">Sedang menunggu konfirmasi admin. Kami akan memproses dalam 1x24 jam.</p>
            </div>
        </div>
        @endif

        {{-- LANGKAH 1: PILIH REKENING --}}
        <div class="bg-surface-container-lowest rounded-xl p-md shadow-sm border border-outline-variant">
            <div class="flex items-center gap-xs mb-md">
                <span class="w-7 h-7 rounded-full step-done flex items-center justify-center font-label-md text-label-md flex-shrink-0">1</span>
                <h3 class="font-title-lg text-title-lg text-on-surface">Pilih Rekening Tujuan</h3>
            </div>

            <div class="space-y-sm">
                {{-- BCA --}}
                <div class="bank-card border-2 border-outline-variant rounded-xl p-sm selected" data-bank="BCA" data-norek="1234567890" data-nama="CateringYuk Indonesia">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-sm">
                            <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-xs">BCA</span>
                            </div>
                            <div>
                                <p class="font-label-md text-label-md text-on-surface">Bank BCA</p>
                                <p class="font-body-md text-body-md text-on-surface font-semibold" id="norek-bca">1234 5678 90</p>
                                <p class="font-label-sm text-label-sm text-on-surface-variant">a.n. CateringYuk Indonesia</p>
                            </div>
                        </div>
                        <button type="button" class="copy-btn flex items-center gap-xs bg-surface-container px-xs py-base rounded-lg font-label-sm text-label-sm text-primary hover:bg-primary hover:text-white transition-all" onclick="copyText('1234567890', this)">
                            <span class="material-symbols-outlined text-[16px]">content_copy</span>
                            Salin
                        </button>
                    </div>
                </div>

                {{-- Mandiri --}}
                <div class="bank-card border-2 border-outline-variant rounded-xl p-sm" data-bank="Mandiri" data-norek="0987654321" data-nama="CateringYuk Indonesia">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-sm">
                            <div class="w-10 h-10 rounded-lg bg-yellow-500 flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-[10px] text-center leading-tight">MAN<br>DIRI</span>
                            </div>
                            <div>
                                <p class="font-label-md text-label-md text-on-surface">Bank Mandiri</p>
                                <p class="font-body-md text-body-md text-on-surface font-semibold">0987 6543 21</p>
                                <p class="font-label-sm text-label-sm text-on-surface-variant">a.n. CateringYuk Indonesia</p>
                            </div>
                        </div>
                        <button type="button" class="copy-btn flex items-center gap-xs bg-surface-container px-xs py-base rounded-lg font-label-sm text-label-sm text-primary hover:bg-primary hover:text-white transition-all" onclick="copyText('0987654321', this)">
                            <span class="material-symbols-outlined text-[16px]">content_copy</span>
                            Salin
                        </button>
                    </div>
                </div>

                {{-- BRI --}}
                <div class="bank-card border-2 border-outline-variant rounded-xl p-sm" data-bank="BRI" data-norek="1122334455" data-nama="CateringYuk Indonesia">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-sm">
                            <div class="w-10 h-10 rounded-lg bg-blue-800 flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-xs">BRI</span>
                            </div>
                            <div>
                                <p class="font-label-md text-label-md text-on-surface">Bank BRI</p>
                                <p class="font-body-md text-body-md text-on-surface font-semibold">1122 3344 55</p>
                                <p class="font-label-sm text-label-sm text-on-surface-variant">a.n. CateringYuk Indonesia</p>
                            </div>
                        </div>
                        <button type="button" class="copy-btn flex items-center gap-xs bg-surface-container px-xs py-base rounded-lg font-label-sm text-label-sm text-primary hover:bg-primary hover:text-white transition-all" onclick="copyText('1122334455', this)">
                            <span class="material-symbols-outlined text-[16px]">content_copy</span>
                            Salin
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-sm bg-surface-container rounded-xl p-sm flex items-start gap-xs">
                <span class="material-symbols-outlined text-primary text-[18px] mt-0.5">info</span>
                <p class="font-label-sm text-label-sm text-on-surface-variant">Transfer tepat <strong class="text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong> sesuai total tagihan agar mudah diverifikasi.</p>
            </div>
        </div>

        {{-- LANGKAH 2: UPLOAD BUKTI --}}
        @if($order->status === 'pending')
        <div class="bg-surface-container-lowest rounded-xl p-md shadow-sm border border-outline-variant">
            <div class="flex items-center gap-xs mb-md">
                <span class="w-7 h-7 rounded-full step-active flex items-center justify-center font-label-md text-label-md flex-shrink-0">2</span>
                <h3 class="font-title-lg text-title-lg text-on-surface">Upload Bukti Transfer</h3>
            </div>

            <form action="{{ route('pelanggan.pembayaran.upload', $order->id) }}" method="POST" enctype="multipart/form-data" id="upload-form">
                @csrf
                <input type="hidden" name="bank_tujuan" id="input-bank-tujuan" value="BCA">

                {{-- Drop Zone --}}
                <div id="drop-zone" class="border-2 border-dashed border-outline-variant rounded-xl p-lg text-center cursor-pointer hover:border-primary hover:bg-surface-container-low transition-all" onclick="document.getElementById('bukti-file').click()">
                    <div id="preview-container" class="hidden">
                        <img id="preview-img" class="max-h-48 mx-auto rounded-lg object-contain mb-sm" src="" alt="Preview"/>
                        <p id="preview-name" class="font-label-md text-label-md text-primary"></p>
                    </div>
                    <div id="placeholder-container">
                        <span class="material-symbols-outlined text-[48px] text-outline mb-xs block">upload_file</span>
                        <p class="font-label-md text-label-md text-on-surface">Klik atau seret foto bukti transfer</p>
                        <p class="font-label-sm text-label-sm text-on-surface-variant mt-xs">JPG, PNG, atau PDF &bull; Maks. 2MB</p>
                    </div>
                    <input type="file" id="bukti-file" name="bukti_transfer" accept="image/*,.pdf" class="hidden" required>
                </div>
                @error('bukti_transfer')
                    <p class="font-label-sm text-label-sm text-error mt-xs">{{ $message }}</p>
                @enderror

                {{-- Catatan opsional --}}
                <div class="mt-sm">
                    <label class="font-label-md text-label-md text-on-surface block mb-xs">Catatan (opsional)</label>
                    <textarea name="catatan_transfer" rows="2" placeholder="Contoh: Transfer via m-BCA pukul 14.30" class="w-full border border-outline-variant rounded-xl px-sm py-xs font-body-md text-body-md text-on-surface bg-surface focus:outline-none focus:border-primary resize-none"></textarea>
                </div>

                <button type="submit" id="submit-btn" class="w-full mt-md bg-primary text-on-primary font-title-lg text-title-lg py-md rounded-xl shadow-lg hover:bg-primary-container hover:-translate-y-0.5 active:scale-95 transition-all flex items-center justify-center gap-xs">
                    <span class="material-symbols-outlined">send</span>
                    Kirim Bukti Transfer
                </button>
            </form>
        </div>
        @endif

        {{-- SUDAH UPLOAD --}}
        @if($order->status === 'menunggu_konfirmasi' && $order->bukti_transfer)
        <div class="bg-surface-container-lowest rounded-xl p-md shadow-sm border border-outline-variant">
            <div class="flex items-center gap-xs mb-sm">
                <span class="w-7 h-7 rounded-full step-done flex items-center justify-center font-label-md text-label-md flex-shrink-0">
                    <span class="material-symbols-outlined text-[16px]">check</span>
                </span>
                <h3 class="font-title-lg text-title-lg text-on-surface">Bukti Transfer Terkirim</h3>
            </div>
            <div class="rounded-xl overflow-hidden border border-outline-variant">
                <img src="{{ asset('storage/' . $order->bukti_transfer) }}" alt="Bukti Transfer" class="w-full max-h-64 object-contain bg-surface-container"/>
            </div>
            <p class="font-label-sm text-label-sm text-on-surface-variant mt-xs text-center">Dikirim via {{ $order->bank_tujuan ?? 'Transfer Bank' }}</p>
        </div>
        @endif

        {{-- LANGKAH 3: INFO --}}
        <div class="bg-surface-container rounded-xl p-sm flex items-start gap-xs">
            <span class="w-7 h-7 rounded-full step-inactive flex items-center justify-center font-label-md text-label-md flex-shrink-0">3</span>
            <div>
                <p class="font-label-md text-label-md text-on-surface">Tunggu Konfirmasi Admin</p>
                <p class="font-label-sm text-label-sm text-on-surface-variant">Konfirmasi dikirim via WhatsApp ke nomor terdaftar dalam 1x24 jam pada hari kerja.</p>
            </div>
        </div>

        {{-- BANTUAN --}}
        <p class="text-center font-label-sm text-label-sm text-outline">
            Butuh bantuan? <a href="https://wa.me/089652693211" target="_blank" rel="noopener noreferrer" class="text-primary font-bold hover:underline">Hubungi Layanan Pelanggan</a>
        </p>

    </div>
</main>

<footer class="bg-[#111111] text-white border-t border-white/10 mt-xl">
    <div class="max-w-container-max mx-auto px-gutter py-xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg">
            <div class="space-y-sm">
                <span class="font-display-lg text-headline-md font-bold text-primary-fixed">CateringYuk!</span>
                <p class="font-body-md text-zinc-400">Menyajikan hidangan sehat, lezat, dan higienis langsung ke tempat Anda.</p>
            </div>
        </div>
        <div class="border-t border-white/10 mt-lg pt-md flex flex-col sm:flex-row justify-between items-center gap-xs text-label-md text-zinc-500">
            <p>© 2026 CateringYuk!. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script>
    // Pilih bank
    const bankCards = document.querySelectorAll('.bank-card');
    bankCards.forEach(card => {
        card.addEventListener('click', () => {
            bankCards.forEach(c => {
                c.classList.remove('selected');
                c.style.borderColor = '';
            });
            card.classList.add('selected');
            const inputBank = document.getElementById('input-bank-tujuan');
            if (inputBank) inputBank.value = card.dataset.bank;
        });
    });

    // Preview gambar
    const fileInput = document.getElementById('bukti-file');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB!');
                this.value = '';
                return;
            }

            document.getElementById('placeholder-container').classList.add('hidden');
            document.getElementById('preview-container').classList.remove('hidden');
            document.getElementById('preview-name').textContent = file.name;

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => document.getElementById('preview-img').src = e.target.result;
                reader.readAsDataURL(file);
            } else {
                document.getElementById('preview-img').src = 'https://ui-avatars.com/api/?name=PDF&background=f0edef&color=006c0c';
            }
        });

        // Drag & drop
        const dropZone = document.getElementById('drop-zone');
        dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-primary', 'bg-surface-container-low'); });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-primary', 'bg-surface-container-low'));
        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.classList.remove('border-primary', 'bg-surface-container-low');
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    }

    // Loading state saat submit
    const form = document.getElementById('upload-form');
    const submitBtn = document.getElementById('submit-btn');
    if (form) {
        form.addEventListener('submit', () => {
            submitBtn.innerHTML = '<span class="material-symbols-outlined" style="animation:spin 1s linear infinite">refresh</span> Mengirim...';
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        });
    }

    // Salin nomor rekening
    function copyText(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const original = btn.innerHTML;
            btn.innerHTML = '<span class="material-symbols-outlined text-[16px]">check</span> Tersalin';
            btn.classList.add('bg-primary', 'text-white');
            setTimeout(() => {
                btn.innerHTML = original;
                btn.classList.remove('bg-primary', 'text-white');
            }, 2000);
        });
    }



    
    @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</script>
</body>
</html>