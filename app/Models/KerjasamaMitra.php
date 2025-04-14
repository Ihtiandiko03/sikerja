<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KerjasamaMitra extends Model
{
  use SoftDeletes;
  protected $table = 'kerjasama_mitra';
  protected $guarded = ['id'];
}
