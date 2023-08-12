<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'province_id',
        'city_id',
        'featured_image',
        'images',
        'event_name',
        'interest_type',
        'event_date',
        'description',
        'destination',
        'what_to_bring',
        'what_to_wear',
        'travel_tips',
        'department_id',
        'contact_person',
        'contact_number',
        'latitude',
        'longitude',
    ];

    public function province() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function city_municipality() {
        return $this->hasOne(CityMunicipality::class, 'id', 'city_id');
    }
}
