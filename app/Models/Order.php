<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'tbl_order'; //tên table

    protected $timestamp = false; // set time null

    protected $primaryKey = 'order_id'; //Khóa chính 

    protected $fillable = [
        'customer_id',
        'shipping_id',
        'order_status',
        'order_code'
    ]; //Cột SQL
}
