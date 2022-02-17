<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'tbl_coupon'; //tên table

    //to turn of just one field
    const UPDATED_AT = false;
    //to turn off timestamp completely
    public $timestamps = false;

    protected $primaryKey = 'coupon_id'; //Khóa chính 

    protected $fillable = [
        'coupon_name',
        'coupon_code',
        'coupon_time',
        'coupon_condition',
        'coupon_number'
    ]; //Cột SQL
}
