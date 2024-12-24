<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelangganKosan extends Model
{
    protected $table = 'pelanggan';

    // List the attributes that are mass assignable
    protected $fillable = [
        'nama',
        'email',
        'id_kosan',
        'kamar',
        'category',
        'harga'
    ];
}
