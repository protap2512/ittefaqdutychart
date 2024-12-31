<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the employees associated with this designation.
     */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'designation', 'name');
    }
}
