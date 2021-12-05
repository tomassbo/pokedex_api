<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'hp',
        'first_edition',
        'expansion_id',
        'type_id',
        'rarity_id',
        'price',
        'image'
    ];
}
