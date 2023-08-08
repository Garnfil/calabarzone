<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactTrivia extends Model
{
    use HasFactory;
    protected $table = 'facts_and_trivias';
    protected $fillable = ['destination_name', 'fact_trivia', 'description', 'featured_image'];
}
