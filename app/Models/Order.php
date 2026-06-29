<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'durasi_paket',       
        'tanggal_mulai',      
        'alamat_pengiriman',  
        'items',
        'status',
        'bukti_transfer',
        'bank_tujuan',
        'catatan_transfer',
    ];
    
    protected $casts = [
        'items' => 'array',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function getMenuNamesAttribute()
    {
        // PERBAIKAN UTAMA: Paksa ubah (decode) menjadi array jika Laravel masih membacanya sebagai string
        $items = is_string($this->items) ? json_decode($this->items, true) : $this->items;

        if (!empty($items) && is_array($items)) {
            $menuIds = [];

            // Looping untuk mengambil semua "menu_id" dari dalam array
            foreach ($items as $item) {
                if (isset($item['menu_id'])) {
                    $menuIds[] = $item['menu_id'];
                }
            }

            // Jika ada ID yang ditemukan, cari namanya di tabel Menu
            if (!empty($menuIds)) {
                $menuNames = \App\Models\Menu::whereIn('id', array_unique($menuIds))->pluck('nama')->toArray();
                return !empty($menuNames) ? implode(', ', $menuNames) : 'Menu Terhapus';
            }
        }

        // Fallback jika array kosong
        return $this->menu->nama ?? 'Custom Paket';
    }
}