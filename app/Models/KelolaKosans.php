<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaKosans extends Model
{
    use HasFactory;

    // Define the table name (optional if it's the default table name based on the model)
    protected $table = 'kosans';

    // Define the primary key (optional if it's the default 'id')
    protected $primaryKey = 'id';

    // Define the fields that are mass assignable
    protected $fillable = [
        'email',
        'nama_kosan',
        'upload_file',
        'lokasi',
        'nomer_whatsapp',
        'harga',
        'pembayaran',
        'tanggal_pembayaran',
        'kamar',
        'fasilitas',
        'deskripsi',
        'map',
    ];

    // If you want to automatically manage timestamps:
    public $timestamps = true;  // Laravel will automatically handle `created_at` and `updated_at`
}
