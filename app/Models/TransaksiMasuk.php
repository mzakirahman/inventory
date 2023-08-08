<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiMasuk extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id_transaksi';
    protected $table = 'transaksi_masuk';
    protected $fillable = [
        'id_transaksi',
        'no',
        'date_transaksi',
        'receiving_from',
        'carried_by',
        'checked_by',
        'position',
        'date',
        'receiving_name',
        'receiving_position',
        'receiving_empl',
        'receiving_date',
        'inventory_name',
        'inventory_position',
        'inventory_empl',
        'inventory_date',
        'record_name',
        'record_position',
        'record_empl',
        'record_date',
        'receiving_signature',
        'inventory_signature',
        'record_signature'
    ];
}
