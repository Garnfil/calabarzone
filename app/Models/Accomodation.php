<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;
    protected $table = 'accomodations';
    protected $fillable = ['province_id', 'city_id', 'featured_image', 'merchant_code', 'business_name', 'classification', 'description', 'interest_type', 'contact_number', 'contact_email'];

    public function province() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function city_municipality() {
        return $this->hasOne(CityMunicipality::class, 'id', 'city_id');
    }
}
