<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $table = 'place';
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'image_path',
        'description'
    ];
}
