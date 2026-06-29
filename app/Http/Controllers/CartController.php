<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu; 

class CartController extends Controller
{
    // Menampilkan isi keranjang belanja (menggunakan view order.blade.php)
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('pelanggan.order', compact('cart'));
    }

    // Menambah menu ke dalam session keranjang
    public function add(Request $request, $id)
    {
        $menu = Menu::findOrFail($id); 
        $cart = session()->get('cart', []);

        // Jika menu sudah ada di keranjang, tambah jumlahnya (quantity)
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->input('quantity', 1);
        } else {
            // Memakai properti nama & gambar sesuai dengan Model Menu Anda
            $cart[$id] = [
                "name" => $menu->nama, 
                "quantity" => $request->input('quantity', 1),
                "price" => $menu->harga, 
                "image" => $menu->gambar 
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu berhasil dimasukkan ke keranjang!');
    }

    // Menghapus item dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Menu berhasil dihapus dari keranjang.');
    }
}