<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityMunicipality extends Model
{
    use HasFactory;
    protected $table = 'cities_municipalities';
    protected $fillable = ['name', 'featured_image', 'images', 'type', 'description', 'province_id'];
}
