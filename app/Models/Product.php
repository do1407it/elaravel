<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'tbl_product'; //tên table

    protected $timestamp = false; // set time null

    protected $primaryKey = 'product_id'; //Khóa chính 

    protected $fillable = [
        'product_name',
        'product_desc',
        'product_content',
        'product_price',
        'product_image',
        'product_status',
    ]; //Cột SQL
}
