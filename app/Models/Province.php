<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'tbl_quanhuyen'; //tên table

    protected $timestamp = false; // set time null

    protected $primaryKey = 'maqh'; //Khóa chính 

    protected $fillable = [
        'name_quanhuyen',
        'type',
        'matp'
    ]; //Cột SQL
}
