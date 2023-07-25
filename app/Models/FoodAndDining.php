<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodAndDining extends Model
{
    use HasFactory;
    protected $table = 'food_and_dining';
    protected $fillable = [
        'province_id',
        'city_id',
        'merchant_code',
        'business_name',
        'interest_type',
        'cuisine',
        'price_range',
        'operation_hours',
        'atmosphere',
        'latitude',
        'longitude',
        'trunkline',
        'mobile_number',
        'company_email',
        'service_options',
        'is_open_for_reservation'
    ];
}
