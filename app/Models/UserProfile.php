<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;
    protected $table = 'user_profiles';
    protected $fillable = [
        'user_id',
        'profile_picture',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'qualification',
        'certificates',
        'resume',
        'experience',
        'summary',
        'github',
        'linkedin',
        'skills',
    ];
    public function user(){
       return $this->belongsTo(User::class);
    }
}
