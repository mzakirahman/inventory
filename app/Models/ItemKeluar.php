<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemKeluar extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'item_keluar';
    protected $primaryKey = 'id_item';
    protected $fillable = [
        'id_item',
        'id_transaksi',
        'vocab_number',
        'uom',
        'qty',
        'order_no',
        'remaks'
    ];
}
