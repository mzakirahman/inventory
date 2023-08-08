<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemMasuk extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id_item';
    protected $table = 'item_masuk';
    protected $fillable = [
        'id_item',
        'id_transaksi',
        'po_number',
        'id_stok',
        'uoi',
        'on_hand',
        'received',
        'balance',
        'min_max',
        'bin_loc',
        'doc_loc',
        'remarks'
    ];
}
