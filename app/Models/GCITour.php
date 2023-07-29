<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GCITour extends Model
{
    use HasFactory;
    protected $table = 'gci_tours';
    protected $fillable = ['tour_name', 'tour_type', 'what_to_wear', 'best_time', 'operation_hours', 'inclusions', 'province', 'inclusion_details', 'cities', 'is_featured'];

    public function province() {
        return $this->hasOne(Province::class, 'id', 'province');
    }
}
