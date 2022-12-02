<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(categorie::class);
    }
    protected $fillable = [
        'name',
        'image',
        'price'
    ];
}
