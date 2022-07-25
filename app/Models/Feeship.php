<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    use HasFactory;

    protected $table = 'tbl_feeship'; //tên table

    //to turn of just one field
    const UPDATED_AT = false;
    //to turn off timestamp completely
    public $timestamps = false;

    protected $primaryKey = 'fee_id'; //Khóa chính 

    protected $fillable = [
        'fee_matp',
        'fee_maqh',
        'fee_xaid',
        'fee_ship',
    ]; //Cột SQL

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'fee_matp'); //Lấy khoá chính admin_id gán vào user (tbl_social)
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'fee_maqh'); //Lấy khoá chính admin_id gán vào user (tbl_social)
    }

    public function wards()
    {
        return $this->belongsTo('App\Models\Wards', 'fee_xaid'); //Lấy khoá chính admin_id gán vào user (tbl_social)
    }
}
