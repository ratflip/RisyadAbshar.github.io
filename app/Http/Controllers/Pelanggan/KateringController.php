<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class KateringController extends Controller
{
    public function landingPage()
    {
        $menus = Menu::take(4)->get();
        return view('pelanggan.landing_pages', compact('menus'));
    }

    public function katalog(Request $request)
    {
        $query = Menu::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->whereIn('kategori', $request->kategori);
        }

        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'termurah') {
                $query->orderBy('harga', 'asc');
            } elseif ($request->sort == 'termahal') {
                $query->orderBy('harga', 'desc');
            } else {
                $query->orderBy('rating', 'desc');
            }
        } else {
            $query->orderBy('rating', 'desc');
        }

        $menus = $query->paginate(12)->withQueryString();
        $totalMenu = Menu::count();

        return view('pelanggan.menu', compact('menus', 'totalMenu'));
    }

    public function detail($slug)
    {
        $menu = Menu::where('slug', $slug)
                    ->where('is_available', true)
                    ->firstOrFail();

        // Mengarah ke file resources/views/pelanggan/detail_menu.blade.php
        return view('pelanggan.detail_menu', compact('menu'));
    }

    /**
     * Fitur Simpan Rating dengan Rumus Custom Back-End
     */
    public function simpanRating(Request $request, $id)
    {
        // Validasi input rating dari user (wajib angka 1-5)
        $request->validate([
            'user_rating' => 'required|numeric|min:1|max:5',
        ]);

        $menu = Menu::findOrFail($id);

        // Penerapan Rumus Rata-rata Rating
        $RatingLama = $menu->rating ?? 0;
        $ViewerLama = $menu->rating_count ?? 0;
        $UserRating = $request->user_rating;

        $ViewerBaru = $ViewerLama + 1;
        $RatingBaru = (($RatingLama * $ViewerLama) + $UserRating) / $ViewerBaru;

        // Simpan pembaruan ke database
        $menu->update([
            'rating' => $RatingBaru,
            'rating_count' => $ViewerBaru
        ]);

        // Redirect kembali dengan membawa session success
        return redirect()->back()->with('success', 'Terima kasih! Rating berhasil dikirim.');
    }
}