<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(function ($request, $next) {
                if (auth()->user()->role !== 'admin') {
                    abort(403, 'Akses ditolak! Halaman ini hanya untuk Admin CateringYuk!.');
                }
                return $next($request);
            }),
        ];
    }

    public function dashboard()
    {
        $totalPesananHariIni = Order::whereDate('created_at', Carbon::today())->count();
        $pending = Order::where('status', 'pending')->count();
        $processing = Order::where('status', 'processing')->count();
        $paid = Order::where('status', 'paid')->count();

        $pendapatanBulanIni = Order::where('status', 'paid')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');

        $pendapatanFormatted = 'Rp ' . number_format($pendapatanBulanIni, 0, ',', '.');

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weeklyOrders = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->select(DB::raw('EXTRACT(ISODOW FROM created_at) as day'), DB::raw('count(*) as count'))
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();

        $volumeMingguan = [
            'senin'  => $weeklyOrders[1] ?? 0,
            'selasa' => $weeklyOrders[2] ?? 0,
            'rabu'   => $weeklyOrders[3] ?? 0,
            'kamis'  => $weeklyOrders[4] ?? 0,
            'jumat'  => $weeklyOrders[5] ?? 0,
        ];

        $statsData = [
            'stats' => [
                'totalPesananHariIni' => $totalPesananHariIni,
                'pending' => $pending,
                'processing' => $processing,
                'paid' => $paid,
                'pendapatan' => $pendapatanFormatted
            ],
            'volumeMingguan' => $volumeMingguan
        ];

        return view('admin.Dashboard', compact('statsData'));
    }

    public function menu(Request $request)
    {
        $search = $request->input('search');
        $query = Menu::query();

        if ($search) {
            $query->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('kategori', 'LIKE', "%{$search}%");
        }

        $menus = $query->paginate(10)->withQueryString();
        return view('admin.menejemen_menu', compact('menus', 'search'));
    }

    public function storeMenu(Request $request)
    {
        if (!$request->hasFile('gambar') || !$request->file('gambar')->isValid()) {
            $request->request->remove('gambar');
            $rulesGambar = 'nullable';
        } else {
            $rulesGambar = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
        }

        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'kategori'  => 'required|in:High Protein,Weight Loss,Low Carbo',
            'label'     => 'nullable|string|max:100',
            'deskripsi' => 'required|string',
            'komposisi' => 'required|string',
            'gambar'    => $rulesGambar,
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('menu', 'public');
        } else {
            $validated['gambar'] = null;
        }

        $validated['is_available'] = true;
        Menu::create($validated);

        return redirect()->route('admin.menu')->with('success', 'Menu baru berhasil ditambahkan!');
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'kategori'  => 'required|in:High Protein,Weight Loss,Low Carbo',
            'label'     => 'nullable|string|max:100',
            'deskripsi' => 'required|string',
            'komposisi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        $menu->update($validated);
        return redirect()->route('admin.menu')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroyMenu($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
            Storage::disk('public')->delete($menu->gambar);
        }
        $menu->delete();
        return redirect()->route('admin.menu')->with('success', 'Menu berhasil dihapus!');
    }

    public function laporan(Request $request)
    {
        $query = Order::with(['user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $cleanSearch = str_replace('#INV-', '', $search);
                $q->where('id', 'LIKE', "%{$cleanSearch}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      // PERBAIKAN: Ubah pencarian dari name menjadi username
                      $userQuery->where('username', 'LIKE', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('tanggal_mulai', $request->date);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.laporan', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:paid,processing,pending,failed'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan #' . str_pad($order->id, 4, '0', STR_PAD_LEFT) . ' berhasil diperbarui!');
    }

    public function eksporCsv(Request $request)
    {
        $query = Order::with(['user']);

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        if ($request->filled('date')) {
            $query->whereDate('tanggal_mulai', $request->date);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $cleanSearch = str_replace('#INV-', '', $search);
                $q->where('id', 'LIKE', "%{$cleanSearch}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      // PERBAIKAN: Ubah pencarian dari name menjadi username
                      $userQuery->where('username', 'LIKE', "%{$search}%");
                  });
            });
        }

        $orders = $query->get();
        $filename = "laporan_transaksi_" . now()->format('Ymd_His') . ".csv";

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($orders) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Invoice ID', 'Pelanggan', 'Menu / Items', 'Tanggal Mulai', 'Durasi Paket', 'Total Harga', 'Status']);

            foreach ($orders as $order) {
                fputcsv($file, [
                    '#INV-' . str_pad($order->id, 4, '0', STR_PAD_LEFT),
                    // PERBAIKAN: Ekspor username, bukan name
                    $order->user->username ?? 'User Terhapus',
                    $order->menu_names,
                    $order->tanggal_mulai,
                    $order->durasi_paket . ' Hari',
                    $order->total_price,
                    strtoupper($order->status)
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}