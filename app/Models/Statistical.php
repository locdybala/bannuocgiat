<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tbl_statistical';
    protected $primaryKey = 'id_statistical';
}
