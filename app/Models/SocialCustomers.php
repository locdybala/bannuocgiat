<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialCustomers extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tbl_social_customers';
    protected $primaryKey = 'customer_id';

    public function login(){
        return $this->belongsTo(Customer::class,'customer');
    }
}
