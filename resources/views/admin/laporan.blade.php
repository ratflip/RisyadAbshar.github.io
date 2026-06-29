@extends('components.app_admin')

@section('content')

    <main class="flex-1 ml-64 p-md space-y-md overflow-y-auto">
        
        @if(session('success'))
            <div class="bg-primary/10 text-primary p-sm rounded-xl font-body-md text-body-md border border-primary/20 flex items-center gap-sm">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <header class="flex justify-between items-center sticky top-0 bg-background/80 backdrop-blur-md z-10 py-sm">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">Laporan Transaksi</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Pantau, validasi, dan kelola histori rekapitulasi penjualan katering Anda.</p>
            </div>
            
            <div class="flex items-center gap-md">
                <form action="{{ route('admin.laporan') }}" method="GET" class="relative hidden lg:block">
                    @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                    @if(request('date')) <input type="hidden" name="date" value="{{ request('date') }}"> @endif
                    
                    <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline">search</span>
                    <input name="search" value="{{ request('search') }}" class="pl-xl pr-md py-xs rounded-full bg-surface-container border-none focus:ring-2 focus:ring-primary w-64 font-body-md text-body-md" placeholder="Cari invoice atau pelanggan..." type="text"/>
                </form>

                <div class="flex items-center gap-sm pl-md border-l border-outline-variant/60">
                    <div class="text-left hidden sm:block max-w-[100px]">
                        <p class="font-headline-md text-base font-bold text-on-surface leading-tight tracking-tight">
                            Admin Utama
                        </p>
                        <p class="font-label-sm text-xs text-on-surface-variant/70 mt-1">
                            Pengelola
                        </p>
                    </div>
                    <img alt="Admin Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-primary" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAocqf5J-n-mNc_nQzKQJE7j19nZdImBeB-SpEelbSDBPEu-fxPLVhAJWjau43zQIzwkh6kHkftb4dMUdqA5TVxNVbxnwwKjkJwUsHogz4DAy93F0aiWUYD0-MIAJV7nFd_-XjHEcODJI8MMtJNGcQKw53f8hZRfPVExdtkXZ0YCxiZjfEdhmIbsBo1Th-1d0PlSpJQG9lu4x0p0fUa9DbXBmo2Ip1zqN2PncLdH7QiaSAq2cOoBuXA_OoocHJm0KDSKyKznr0w0E3L"/>
                </div>
            </div>
        </header>

        <section class="bg-surface-container-lowest rounded-xl shadow-[0px_4px_20px_rgba(0,0,0,0.02)] border border-outline-variant/30 overflow-hidden">
            
            <div class="p-sm border-b border-outline-variant/30 flex flex-col md:flex-row gap-sm justify-between items-start md:items-center">
                
                <div class="flex flex-col gap-base w-full md:w-auto">
                    <h3 class="font-title-lg text-title-lg text-on-surface">Pesanan Terbaru</h3>
                    <div class="flex flex-wrap gap-xs mt-base">
                        @php 
                            $currentStatus = request('status', 'all'); 
                            $baseQueries = request()->except(['status', 'page']);
                        @endphp
                        
                        <a href="{{ route('admin.laporan', array_merge($baseQueries, ['status' => 'all'])) }}" 
                           class="px-sm py-xs rounded-full font-label-md text-label-sm {{ $currentStatus === 'all' ? 'bg-primary text-white' : 'bg-surface-container hover:bg-surface-container-highest text-on-surface-variant transition-colors' }}">Semua</a>
                        
                        <a href="{{ route('admin.laporan', array_merge($baseQueries, ['status' => 'pending'])) }}" 
                           class="px-sm py-xs rounded-full font-label-md text-label-sm {{ $currentStatus === 'pending' ? 'bg-primary text-white' : 'bg-surface-container hover:bg-surface-container-highest text-on-surface-variant transition-colors' }}">Pending</a>
                        
                        <a href="{{ route('admin.laporan', array_merge($baseQueries, ['status' => 'paid'])) }}" 
                           class="px-sm py-xs rounded-full font-label-md text-label-sm {{ $currentStatus === 'paid' ? 'bg-primary text-white' : 'bg-surface-container hover:bg-surface-container-highest text-on-surface-variant transition-colors' }}">Paid</a>
                        
                    </div>
                </div>
                
                <div class="flex gap-xs w-full md:w-auto justify-end items-center">
                    <form action="{{ route('admin.laporan') }}" method="GET" class="relative">
                        @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        
                        <input 
                            type="date" 
                            name="date"
                            value="{{ request('date') }}"
                            onchange="this.form.submit()"
                            class="appearance-none pl-md pr-sm py-xs font-label-md text-label-md text-on-surface bg-surface-container-lowest border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary focus:border-primary cursor-pointer"
                        />
                        <span class="material-symbols-outlined text-body-md absolute left-xs top-1/2 -translate-y-1/2 text-primary pointer-events-none">calendar_today</span>
                    </form>

                    <a href="{{ route('admin.laporan.ekspor', request()->query()) }}" class="flex items-center gap-base font-label-md text-label-md text-on-surface-variant hover:bg-surface-container border border-outline-variant px-sm py-xs rounded-xl transition-colors">
                        <span class="material-symbols-outlined text-body-md">download</span>
                        Ekspor CSV
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                        <tr>
                            <th class="px-sm py-sm">Invoice</th>
                            <th class="px-sm py-sm">Pelanggan</th>
                            <th class="px-sm py-sm">Menu</th>
                            <th class="px-sm py-sm">Mulai Paket</th>
                            <th class="px-sm py-sm">Total</th>
                            <th class="px-sm py-sm">Status</th>
                            <th class="px-sm py-sm text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="font-body-md text-body-md text-on-surface divide-y divide-outline-variant/20">
                        @forelse ($orders as $order)
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-sm py-md font-bold">#INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-sm py-md">
                                <div class="flex items-center gap-xs">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-label-sm">
                                        {{-- PERBAIKAN: Ubah name menjadi username --}}
                                        {{ strtoupper(substr($order->user?->username ?? 'P', 0, 1)) }}
                                    </div>
                                    {{-- PERBAIKAN: Ubah name menjadi username --}}
                                    <span class="font-medium">{{ $order->user?->username ?? 'User Terhapus' }}</span>
                                </div>
                            </td>
                            <td class="px-sm py-md text-on-surface-variant">
                                {{ $order->menu_names }}
                            </td>
                            <td class="px-sm py-md">
                                {{ $order->tanggal_mulai ? \Carbon\Carbon::parse($order->tanggal_mulai)->format('d M Y') : '-' }}
                                <span class="text-xs text-on-surface-variant/70 block">({{ $order->durasi_paket }})</span>
                            </td>
                            <td class="px-sm py-md font-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-sm py-md">
                                @if($order->status === 'pending')
                                    <span class="bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm px-sm py-base rounded-full">Pending</span>
                                @elseif($order->status === 'paid')
                                    <span class="bg-primary-fixed-dim text-on-primary-fixed-variant font-label-sm text-label-sm px-sm py-base rounded-full">Paid</span>
                                @else
                                    <span class="bg-error/10 text-error font-label-sm text-label-sm px-sm py-base rounded-full">Failed</span>
                                @endif
                            </td>
                            <td class="px-sm py-md">
                                <div class="flex justify-center gap-xs {{ $order->status === 'pending' ? 'opacity-0 group-hover:opacity-100' : '' }} transition-opacity duration-150">
                                    @if($order->status === 'pending')
                                        <form action="{{ route('admin.laporan.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="paid">
                                            <button type="submit" class="bg-primary text-on-primary p-base rounded-lg hover:scale-105 transition-transform flex items-center" title="Validasi">
                                                <span class="material-symbols-outlined text-body-md">check</span>
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.laporan.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="failed">
                                            <button type="submit" class="bg-error text-on-error p-base rounded-lg hover:scale-105 transition-transform flex items-center" title="Tolak">
                                                <span class="material-symbols-outlined text-body-md">close</span>
                                            </button>
                                        </form>
                                    @else
                                        <span class="material-symbols-outlined text-outline-variant/80">monetization_on</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-xl text-on-surface-variant font-body-md">
                                Tidak ada data transaksi yang cocok dengan kriteria filter.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-sm bg-surface-container-low/40 flex flex-col sm:flex-row justify-between items-center border-t border-outline-variant/30 gap-sm">
                <p class="font-label-sm text-label-sm text-on-surface-variant">
                    Menampilkan {{ $orders->firstItem() ?? 0 }} sampai {{ $orders->lastItem() ?? 0 }} dari {{ $orders->total() }} pesanan
                </p>
                <div class="font-label-md text-label-sm">
                    {{ $orders->links() }}
                </div>
            </div>

        </section>
    </main>
@endsection