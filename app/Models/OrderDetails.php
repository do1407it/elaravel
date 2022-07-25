<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'tbl_order_details'; //tên table

    protected $timestamp = false; // set time null

    protected $primaryKey = 'order_details_id'; //Khóa chính 

    protected $fillable = [
        'order_code',
        'product_id',
        'product_name',
        'product_price',
        'product_sales_quantity',
        'product_coupon',
        'product_feeship',
    ]; //Cột SQL
}
