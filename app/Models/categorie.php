<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorie extends Model
{
    use HasFactory;
    public function categorie()
    {
        return $this->hasMany(article::class);
    }
    protected $fillable = [
        'name',
        'image',
        'is_active'
    ];
}
