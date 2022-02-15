<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'tbl_category_product'; //tên table

    protected $timestamp = false; // set time null

    protected $primaryKey = 'category_id'; //Khóa chính 

    protected $fillable = [
        'meta_keywords',
        'category_name',
        'category_desc',
        'category_status'
    ]; //Cột SQL
}
