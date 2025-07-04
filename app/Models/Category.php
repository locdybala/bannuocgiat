<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tbl_category';
    protected $primaryKey = 'category_id';
    public function product()
    {
        return $this->hasMany(Product::class, 'category_id'); // Đảm bảo cột 'category_id' là đúng
    }
}
