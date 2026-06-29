<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'nama',
        'harga',
        'kategori',
        'label',
        'deskripsi',
        'gambar',
        'is_available',
        'ingredients', 
        'video',       
        'rating',       // Ditambahkan
        'rating_count'  // Ditambahkan
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'harga' => 'integer',
        'rating' => 'float',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($menu) {
            $menu->slug = Str::slug($menu->nama) . '-' . time();
        });
    }
}