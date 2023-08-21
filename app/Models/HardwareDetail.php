<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HardwareDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'hardware_detail';

    protected $guarded = [];
}
