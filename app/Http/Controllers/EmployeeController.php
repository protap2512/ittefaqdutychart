<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave; // Import the Leave model
use Illuminate\Http\Request;
use Carbon\Carbon; // For date manipulation

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index(Request $request)
    {
        // Default to today's date if no date is provided in the request
        $date = Carbon::parse($request->date ?? now());

        // Fetch employees who are available for duty
        $employees = Employee::whereDoesntHave('leaves', function ($query) use ($date) {
            $query->whereDate('start_date', '<=', $date)
                  ->whereDate('end_date', '>=', $date);
        })
        ->where('weekly_off_day', '!=', $date->format('l')) // Exclude employees with offday on the selected date
        ->get();

        // Optionally, you can include any other filtering or duty rotations here
        $dutyRotations = DutyRotation::with('employee')->get(); // Assuming the DutyRotation model exists

        return view('employees.index', compact('employees', 'dutyRotations', 'date'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created employee in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'weekly_offday' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the profile image upload if exists
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('images/employees', 'public');
            $validated['profile_image'] = $imagePath;
        }

        // Create the employee record
        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
    }

    /**
     * Show the details of a specific employee.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in the database.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'weekly_offday' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the employee
        $employee = Employee::findOrFail($id);

        // Handle the profile image upload if exists
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($employee->profile_image && file_exists(storage_path('app/public/' . $employee->profile_image))) {
                unlink(storage_path('app/public/' . $employee->profile_image));
            }

            $imagePath = $request->file('profile_image')->store('images/employees', 'public');
            $validated['profile_image'] = $imagePath;
        }

        // Update the employee record
        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified employee from the database.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        // Delete the employee's profile image if exists
        if ($employee->profile_image && file_exists(storage_path('app/public/' . $employee->profile_image))) {
            unlink(storage_path('app/public/' . $employee->profile_image));
        }

        // Delete the employee
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}
