<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';

    protected $fillable = ['name', 'firstname', 'lastname', 'email', 'username', 'password', 'interests', 'is_verify', 'is_active'];

    protected $appends = ['my_interests'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password'];

    public function getMyInterestsAttribute()
    {
        $interests = json_decode($this->interests, true); // Passing true as the second argument to get an associative array

        if (is_array($interests) && !empty($interests)) {
            $data = Interest::select('id', 'interest_name', 'featured_image', 'icon')->whereIn('id', $interests)
                ->get()
                ->toArray();
            if (!empty($data)) {
                return $data;
            }
        }

        // Return an empty array if there are no interests or if an error occurred
        return [];
    }
}
