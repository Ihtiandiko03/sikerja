<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KlasifikasiMitra extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'klasifikasi_mitra';
    protected $guarded = ['id'];
}
