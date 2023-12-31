<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GCITour extends Model
{
    use HasFactory;
    protected $table = 'gci_tours';
    protected $fillable = ['tour_name', 'tour_details', 'tour_type', 'tour_cover', 'what_to_wear', 'flyers', 'best_time', 'tour_duration', 'inclusions', 'province', 'inclusion_details', 'youtube', 'cities', 'is_featured'];

    public function tour_province() {
        return $this->hasOne(Province::class, 'id', 'province');
    }

    public function tour_cities() {
        return $this->hasMany(GCITourCity::class, 'main_id');
    }
}
