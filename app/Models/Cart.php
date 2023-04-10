<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'supplier_id',
        'quantity',
        'price',
        'image',
        'name',
    ];




    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
