<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tbl_comment';
    protected $primaryKey = 'comment_id';

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
