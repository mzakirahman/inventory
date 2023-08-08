<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiKeluar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi_keluar';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_transaksi',
        'from',
        'to',
        'company',
        'serial',
        'vessel',
        'etd',
        'eta',
        'vogate',
        '',
        'consignor_name',
        'consignor_date',
        'consignee_empl',
        'consignee_name',
        'consignee_date',
        'stock_card_empl',
        'stock_card_name',
        'stock_card_date',
        'mmis_empl',
        'mmis_name',
        'mmis_date',
        'consignor_signature',
        'consignee_signature',
        'stock_card_signature',
        'mmis_signature'

    ];
}
