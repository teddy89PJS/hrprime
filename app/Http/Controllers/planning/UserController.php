<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\EmploymentStatus;
use App\Models\Division;
use App\Models\Section;
use App\Models\SalaryGrade;
use App\Models\Position;

class UserController extends Controller
{
    public function index()
    {
        $employees = User::with(['division', 'section', 'employmentStatus'])->get();
        return view('content.planning.list-of-employee', compact('employees'));
    }

    public function create()
    {
        // Auto-generate unique employee ID like 11-0001
        $latestUser = User::where('employee_id', 'like', '11-%')->orderByDesc('id')->first();
        $number = 1;

        if ($latestUser && preg_match('/11-(\d+)/', $latestUser->employee_id, $matches)) {
            $number = intval($matches[1]) + 1;
        }

        $generatedEmployeeId = '11-' . str_pad($number, 4, '0', STR_PAD_LEFT);

        $employmentStatuses = EmploymentStatus::all();
        $divisions = Division::all();
        $salaryGrades = SalaryGrade::all();
        $positions = Position::all();

        return view('content.planning.registration-form', compact(
            'generatedEmployeeId',
            'employmentStatuses',
            'divisions',
            'salaryGrades',
            'positions'
        ));
    }

    public function getSections(Request $request)
    {
        $sections = Section::where('division_id', $request->division_id)->get();
        return response()->json($sections);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|unique:users,employee_id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $firstName = strtoupper(trim($validatedData['first_name']));
        $middleName = strtoupper(trim($request->input('middle_name')));
        $lastName = strtoupper(trim($validatedData['last_name']));
        $extensionName = strtoupper(trim($request->input('extension_name')));
        $employeeId = $validatedData['employee_id'];

        // Generate username using initials + last 4 digits of employee ID
        $middleInitial = $middleName ? substr($middleName, 0, 1) : '';
        $empIdLast4 = substr($employeeId, -4);
        $username = strtolower(substr($firstName, 0, 1) . $middleInitial . $lastName . $empIdLast4);

        // Ensure username is unique
        $originalUsername = $username;
        $counter = 1;
        while (User::where('username', $username)->exists()) {
            $username = $originalUsername . $counter;
            $counter++;
        }

        $user = new User();
        $user->employee_id = $employeeId;
        $user->first_name = $firstName;
        $user->middle_name = $middleName;
        $user->last_name = $lastName;
        $user->extension_name = $extensionName;
        $user->email = strtolower($validatedData['email']);
        $user->username = $username;
        $user->password = Hash::make($validatedData['password']);
        $user->division_id = $request->input('division');
        $user->section_id = $request->input('section');
        $user->employment_status_id = $request->input('employment_status');
        $user->save();

        return redirect()->route('employee.view-blade')->with('success', 'Employee registered successfully!');
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

        $request->validate([
            'employee_id' => 'required|unique:users,employee_id,' . $employee->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'employment_status' => 'required',
            'division' => 'required',
            'section' => 'required',
            'password' => 'nullable|min:6',
        ]);

        $firstName = ucwords(strtolower(trim($request->first_name)));
        $middleName = ucwords(strtolower(trim($request->middle_name)));
        $lastName = ucwords(strtolower(trim($request->last_name)));
        $extensionName = ucwords(strtolower(trim($request->extension_name)));

        if ($employee->employee_id !== $request->employee_id) {
            $middleInitial = $middleName ? substr($middleName, 0, 1) : '';
            $empIdLast4 = substr($request->employee_id, -4);
            $newUsername = strtolower(substr($firstName, 0, 1) . $middleInitial . $lastName . $empIdLast4);

            $originalUsername = $newUsername;
            $counter = 1;
            while (User::where('username', $newUsername)->where('id', '!=', $employee->id)->exists()) {
                $newUsername = $originalUsername . $counter;
                $counter++;
            }

            $employee->username = $newUsername;
        }

        $employee->update([
            'employee_id' => $request->employee_id,
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'extension_name' => $extensionName,
            'employment_status_id' => $request->employment_status,
            'division_id' => $request->division,
            'section_id' => $request->section,
            'email' => strtolower($request->email),
        ]);

        if (!empty($request->password)) {
            $employee->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('employee.list-of-employee')->with('success', 'Employee updated successfully!');
    }
}
