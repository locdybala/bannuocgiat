<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'tbl_order_details';
    protected $primaryKey = 'order_details_id';

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
