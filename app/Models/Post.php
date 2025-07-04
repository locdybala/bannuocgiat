<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tbl_post';
    protected $primaryKey = 'post_id';
    public function category(){
        return $this->belongsTo(CategoryPost::class, 'cate_post_id');
    }
}
