<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Define the columns that can be mass assigned
    protected $fillable = [
        'name', 
        'designation', 
        'weekly_offday', 
        'is_bideshi', 
        'is_bideshi_substitute', 
        'profile_image'
    ];

    /**
     * Relationship with DutyRotation
     */
    public function dutyRotations()
    {
        return $this->hasMany(DutyRotation::class);
    }

    /**
     * Relationship with Leave
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
