<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'nota';

    // List the attributes that are mass assignable
    protected $fillable = [
        'nama',
        "id_kosan",
        'email',
        'bank',
        'total',
        'tanggal',
        'code'
    ];
}
