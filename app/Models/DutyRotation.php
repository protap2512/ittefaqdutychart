<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DutyRotation extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'employee_id', 'start_date', 'sequence_order'];

    // Relationship to Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Scope to filter by duty type (Late Night, Picture Selection, etc.)
    public function scopeByDutyType($query, $type)
    {
        return $query->where('type', $type);
    }
}
