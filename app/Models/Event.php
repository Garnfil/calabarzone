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
        'event_name',
        'interest_type',
        'event_date',
        'description',
        'what_to_wear',
        'travel_tips',
        'department_id',
        'contact_person',
        'contact_number'
    ];
}
