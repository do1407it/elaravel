<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'tbl_customers'; //tên table

    //to turn of just one field
    const UPDATED_AT = false;
    //to turn off timestamp completely
    public $timestamps = false;

    protected $primaryKey = 'customer_id'; //Khóa chính 

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_password',
        'customer_phone',
    ]; //Cột SQL
}
