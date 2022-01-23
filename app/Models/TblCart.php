<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblCart extends Model
{
    use HasFactory;

    protected $table = 'tbl_product';

    public function scopeById($query, $productId) {
        return $query->where('product_id',$productId);
    }

}
