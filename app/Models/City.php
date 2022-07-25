<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'tbl_tinhthanhpho'; //tên table

    protected $timestamp = false; // set time null

    protected $primaryKey = 'matp'; //Khóa chính 

    protected $fillable = [
        'name_city',
        'type',
    ]; //Cột SQL
}
