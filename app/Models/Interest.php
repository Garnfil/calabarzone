<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;
    protected $table = 'interests';
    protected $fillable = ['interest_name', 'featured_image', 'icon', 'description', 'background_color'];
}
