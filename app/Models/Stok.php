<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stok extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stok';
    protected $primaryKey = 'id_stok';
    protected $fillable = [
        'id_stok',
        'stock_code',
        'description',
        'qoh',
        'unit_value',
        'total_value',
        'location',
        'bin_loc'
    ];
}
