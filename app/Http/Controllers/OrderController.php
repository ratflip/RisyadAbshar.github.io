<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * 1. Menampilkan halaman formulir order
     */
    public function showPage($id = null)
    {
        if (!$id) {
            return redirect()->route('pelanggan.katalog')
                             ->with('error', 'Silakan pilih menu terlebih dahulu sebelum memesan.');
        }

        $menu = Menu::findOrFail($id);

        return view('pelanggan.order', compact('menu'));
    }

    /**
     * 2. Memproses data form dan menyimpan ke database
     */
    public function prosesOrder(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'menu_id'      => 'required',
            'durasi'       => 'required|string',
            'tanggal_mulai'=> 'required|date',
            'alamat'       => 'required',
            'kuantitas'    => 'required|integer|min:1',
            'total_harga'  => 'required|numeric',
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        $itemsData = json_encode([
            [
                'menu_id'     => $request->menu_id,
                'nama_produk' => $menu->nama,
                'durasi'      => $request->durasi,
                'kuantitas'   => (int) $request->kuantitas,
            ]
        ]);

        $order = Order::create([
            'user_id'           => Auth::id(),
            'durasi_paket'      => $request->durasi,
            'tanggal_mulai'     => $request->tanggal_mulai,
            'alamat_pengiriman' => $request->alamat,
            'total_price'       => $request->total_harga,
            'items'             => $itemsData,
            'status'            => 'pending',
        ]);

        return redirect()->route('pelanggan.pembayaran', ['id' => $order->id])
                         ->with('success', 'Pesanan berhasil dibuat! Silakan selesaikan pembayaran.');
    }

    /**
     * 3. Menampilkan halaman pembayaran manual
     */
    public function pembayaran($id)
    {
        $order = Order::findOrFail($id);

        // Pastikan hanya pemilik order yang bisa akses
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pelanggan.pembayaran', compact('order'));
    }

    /**
     * 4. Menerima upload bukti transfer
     */
    public function uploadBukti(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bank_tujuan'    => 'required|string',
        ]);

        // Simpan file bukti transfer
        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        $order->update([
            'bukti_transfer'    => $path,
            'bank_tujuan'       => $request->bank_tujuan,
            'catatan_transfer'  => $request->catatan_transfer,
            'status'            => 'menunggu_konfirmasi',
        ]);

        return redirect()->route('pelanggan.pembayaran', $order->id)
                         ->with('success', 'Bukti transfer berhasil dikirim! Admin akan mengkonfirmasi dalam 1x24 jam.');
    }

    /**
     * 5. Detail pesanan (opsional, untuk halaman riwayat)
     */
    public function detailPesanan($id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pelanggan.detail-pesanan', compact('order'));
    }
}