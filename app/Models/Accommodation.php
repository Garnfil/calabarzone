<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;
    protected $table = 'accomodations';
    protected $fillable = ['province_id', 'city_id', 'featured_image', 'images', 'merchant_code', 'business_name', 'classification', 'description', 'interest_type', 'contact_number', 'contact_email', 'latitude', 'longitude', 'website', 'is_active'];

    public function province() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function city_municipality() {
        return $this->hasOne(CityMunicipality::class, 'id', 'city_id');
    }
}
