<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\EmploymentStatus;
use App\Models\Division;
use App\Models\Section;

class UserController extends Controller
{
  public function index()
  {
    $employees = User::with(['division', 'section', 'employmentStatus'])->get();

    return view('content.planning.list-of-employee', compact('employees'));
  }
  public function create()
  {
    $employmentStatuses = EmploymentStatus::all();
    $divisions = Division::all();

    return view('content.planning.registration-form', compact('employmentStatuses', 'divisions'));
  }

  public function getSections(Request $request)
  {
    $divisionId = $request->division_id;
    $sections = Section::where('division_id', $divisionId)->get();

    return response()->json($sections);
  }

  public function store(Request $request)
  {
    $request->validate([
      'employee_id' => 'required|unique:users,employee_id',
      'first_name' => 'required',
      'last_name' => 'required',
      'employment_status' => 'required|exists:employment_statuses,id',
      'division' => 'required|exists:divisions,id',
      'section' => 'required|exists:sections,id',
      'password' => 'required|confirmed|min:6',
    ]);

    $middleInitial = substr($request->middle_name, 0, 1);
    $empIdLast4 = substr($request->employee_id, -4);
    $username = strtolower(substr($request->first_name, 0, 1) . $middleInitial . $request->last_name . $empIdLast4);

    User::create([
      'employee_id' => $request->employee_id,
      'first_name' => $request->first_name,
      'middle_name' => $request->middle_name,
      'last_name' => $request->last_name,
      'extension_name' => $request->extension_name,
      'employment_status_id' => $request->employment_status,
      'division_id' => $request->division,
      'section_id' => $request->section,
      'username' => $username,
      'password' => Hash::make($request->password),
    ]);

    return redirect()->route('employee.registration-form')->with('success', 'Employee registered successfully!');
  }
  public function show($id)
  {
    $employee = User::with(['division', 'section', 'employmentStatus'])->findOrFail($id);
    return view('content.planning.employee-view', compact('employee'));
  }
  public function edit($id)
  {
    $employee = User::findOrFail($id);
    $divisions = Division::all();
    $sections = Section::where('division_id', $employee->division_id)->get();
    $employmentStatuses = EmploymentStatus::all();

    return view('content.planning.employee-edit', compact('employee', 'divisions', 'sections', 'employmentStatuses'));
  }
  public function update(Request $request, $id)
  {
    $employee = User::findOrFail($id);

    // Validate input
    $request->validate([
      'employee_id' => 'required|unique:users,employee_id,' . $employee->id,
      'first_name' => 'required',
      'last_name' => 'required',
      'employment_status' => 'required',
      'division' => 'required',
      'section' => 'required',
      'password' => 'nullable|min:6',
    ]);

    // Generate username (only if employee_id changed)
    if ($employee->employee_id != $request->employee_id) {
      $middleInitial = substr($request->middle_name, 0, 1);
      $empIdLast4 = substr($request->employee_id, -4);
      $username = strtolower(substr($request->first_name, 0, 1) . $middleInitial . $request->last_name . $empIdLast4);
    } else {
      $username = $employee->username; // preserve existing username
    }

    // Update fields
    $employee->update([
      'employee_id' => $request->employee_id,
      'first_name' => $request->first_name,
      'middle_name' => $request->middle_name,
      'last_name' => $request->last_name,
      'extension_name' => $request->extension_name,
      'employment_status_id' => $request->employment_status,
      'division_id' => $request->division,
      'section_id' => $request->section,
      'username' => $username,
    ]);

    // Update password only if provided
    if (!empty($request->password)) {
      $employee->update([
        'password' => Hash::make($request->password)
      ]);
    }

    return redirect()->route('employee.list-of-employee')->with('success', 'Employee updated successfully!');
  }
}
