<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DutyShift extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'shift_type',  // (e.g., 'Late Night', 'Picture Selection', etc.)
        'start_date',
        'end_date',
        'shift_day',   // Specific date or day of the week for shift assignment
    ];

    /**
     * Get the employee associated with this duty shift.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
