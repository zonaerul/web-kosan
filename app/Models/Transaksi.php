<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "transaksi";

    protected $fillable = [
        'id','id_kosan', 'code', 'email', 'nama', 'bank', 'total', 'tanggal', 'user_id', 'status', 'create_at', 'update_at'
    ];
}
