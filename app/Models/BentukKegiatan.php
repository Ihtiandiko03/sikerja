<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BentukKegiatan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'bentuk_kegiatan';
    protected $guarded = ['id'];
}
