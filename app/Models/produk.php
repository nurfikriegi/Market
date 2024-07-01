<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'harga', 'deskripsi', 'img_path'];
    protected $table = 'produk';
    public $timestamps = false;
}
