<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;
    protected $table = 'accomodations';
    protected $fillable = ['province_id', 'city_id', 'merchant_code', 'business_name', 'classification', 'description', 'interest_type', 'contact_number', 'contact_email'];
}
