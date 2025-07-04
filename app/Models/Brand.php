<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'tbl_brand';
    protected $primaryKey = 'brand_id';

    public function product()
    {
        return $this->hasMany(Product::class, 'brand_id'); // Đảm bảo cột 'brand_id' là đúng
    }
}
