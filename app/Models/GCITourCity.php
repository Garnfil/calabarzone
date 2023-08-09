<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GCITourCity extends Model
{
    use HasFactory;
    protected $table = 'gci_tours_cities';
    protected $fillable = ['main_id', 'city', 'tour_details', 'background_image'];
}
