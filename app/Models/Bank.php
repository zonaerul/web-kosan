<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    //bank
    protected $table = 'bank';
    protected $fillable = ['id', 'name', 'transfer'];
}
