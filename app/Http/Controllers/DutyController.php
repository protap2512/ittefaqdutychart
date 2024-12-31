<?php

namespace App\Http\Controllers;

use App\Models\DutyRotation;
use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;


class DutyController extends Controller
{
    // Method to fetch employees assigned to duties for a specific date
    public function getEmployeeAssignments(Request $request)
    {
        // Validate the incoming date to ensure it's in the correct format
        $validated = $request->validate([
            'date' => 'required|date|date_format:Y-m-d',
        ]);
        
        // Parse the validated date
        $date = Carbon::parse($validated['date']);

        // Define the duty types for which we want to fetch assignments
        $dutyTypes = ['Late Night', 'Picture Selection'];
        $assignments = [];

        // Loop through each duty type (Late Night and Picture Selection)
        foreach ($dutyTypes as $dutyType) {
            // Fetch duty rotations for the current duty type, ordered by sequence order
            $dutyRotations = DutyRotation::where('type', $dutyType)
                ->whereDate('start_date', '<=', $date) // Ensure the start date is before or on the requested date
                ->get();

            // Check if duty rotations exist
            if ($dutyRotations->isEmpty()) {
                continue; // No duty rotations for this type
            }

            // Iterate through duty rotations to check if the date falls within any duty cycle
            foreach ($dutyRotations as $rotation) {
                // Calculate the end date of the duty cycle (10 days from the start_date)
                $cycleEndDate = Carbon::parse($rotation->start_date)->addDays(9);

                // Check if the requested date falls within the duty cycle
                if ($date->between(Carbon::parse($rotation->start_date), $cycleEndDate)) {
                    // Assign the employee for this duty cycle
                    $assignedEmployee = Employee::find($rotation->employee_id);
                    if ($assignedEmployee) {
                        // Store the assigned employee in the assignments array
                        $assignments[$dutyType] = $assignedEmployee;
                        break; // Exit loop once the assigned employee is found
                    }
                }
            }
        }

        // Fetch employees who are available (not on leave or on their offday)
        $availableEmployees = Employee::whereDoesntHave('leaves', function ($query) use ($date) {
            $query->whereDate('start_date', '<=', $date)
                  ->whereDate('end_date', '>=', $date);
        })
        ->where('weekly_offday', '!=', $date->format('l')) // Exclude employees with off day on the selected date
        ->get();

        // Return the results as a JSON response
        return response()->json([
            'late_night' => $assignments['Late Night'] ?? null,
            'picture_selection' => $assignments['Picture Selection'] ?? null,
            'available_employees' => $availableEmployees
        ]);
    }
}
