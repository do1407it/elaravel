<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;

    protected $table = 'tbl_xaphuongthitran'; //tên table

    protected $timestamp = false; // set time null

    protected $primaryKey = 'xaid'; //Khóa chính 

    protected $fillable = [
        'name_xaphuong	',
        'type',
        'maqh'
    ]; //Cột SQL
}

