<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;
    protected $table = 'attractions';
    protected $fillable = [
        'province_id',
        'city_id',
        'how_to_get_there',
        'interest_type',
        'attraction_name',
        'description',
        'things_todo',
        'operational_hours',
        'best_time_to_visit',
        'contact_number',
        'mobile_number',
        'contact_email',
    ];
}
