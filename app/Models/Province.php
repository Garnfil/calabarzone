<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $fillable = ['name', 'order_id', 'featured_image', 'images', 'description', 'transportations', 'tagline', 'languages', 'delicacies', 'latitude', 'longitude', 'youtube_link', 'list_of_dot_accredited_establishments'];
}
