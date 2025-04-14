<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelaahUnitKerja extends Model
{
  use SoftDeletes;
  protected $table = 'telaah_unit_kerja';
  protected $guarded = ['id'];
}
