<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'suplier';
    protected $primaryKey = 'id_suplier';
    protected $fillable = [
        'id_suplier',
        'nama_suplier',
        'alamat',
        'telepon'
    ];
}
