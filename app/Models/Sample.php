<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sample extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nomor_sample',
        'nama_sample',
        'lab_tujuan',
        'tanggal_masuk',
        'stok',
        'status'
    ];
}
