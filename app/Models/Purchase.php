<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function  User()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function  Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
