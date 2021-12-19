<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    protected $fillable = [
        'productname',
        'price',
        'stock'
    ];

    public function Users () {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function Reviews () {
        return $this->hasMany(Reviews::class, 'product_id');
    }
}
