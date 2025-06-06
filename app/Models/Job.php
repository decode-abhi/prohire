<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
   use HasFactory;
   protected $table = 'jobs';
   protected $fillable = [
    'title',
    'description',
    'salary',
    'location',
    'type',
    'user_id',
   ];

    public function user()
    {
        return $this->belongsTo(User::class);  // Client (Job Poster)
    }

    public function applications()
    {
        return $this->hasMany(Application::class);  // Freelancers applying to this job
    }
    protected function getTitleAttribute($value){
        return ucwords($value);
    }
}
