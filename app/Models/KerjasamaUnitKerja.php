<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KerjasamaUnitKerja extends Model
{
  use SoftDeletes;
  protected $table = 'kerjasama_unit_kerja';
  protected $guarded = ['id'];
}
