<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activities';
    protected $fillable = ['province_id', 'city_id', 'destination', 'featured_image', 'activity_name', 'interest_type', 'description', 'things_todo', 'what_to_wear', 'operational_hours', 'latitude', 'longitude', 'best_time_to_visit'];

    public function province() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function city_municipality() {
        return $this->hasOne(CityMunicipality::class, 'id', 'city_id');
    }
}
