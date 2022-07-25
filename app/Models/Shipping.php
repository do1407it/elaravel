<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'tbl_shipping'; //tên table

    protected $timestamp = false; // set time null

    protected $primaryKey = 'shipping_id'; //Khóa chính 

    protected $fillable = [
        'shipping_name',
        'shipping_address',
        'shipping_phone',
        'shipping_email',
        'shipping_notes',
        'shipping_method',
    ]; //Cột SQL
}
