<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activitiest';
    protected $fillable = ['province_id', 'city_id', 'activity_name', 'interest_type', 'description', 'things_todo', 'what_to_wear', 'operational_hours', 'best_time_to_visit'];
}
