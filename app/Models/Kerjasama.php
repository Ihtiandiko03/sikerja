<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kerjasama extends Model
{
  use SoftDeletes;
  protected $table = 'kerjasama';
  protected $guarded = ['id'];
}
