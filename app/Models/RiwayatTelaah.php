<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTelaah extends Model
{
    use HasFactory;
    protected $table = 'riwayat_telaah';
    protected $guarded = ['id'];
}
