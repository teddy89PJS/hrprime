<?php

namespace App\Http\Controllers\pas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\FundSource;
use App\Models\User;
use App\Models\Position;
use App\Models\SalaryGrade;
use App\Models\Deduction;

class PayrollController extends Controller
{
  public function index()
  {
    $payroll = Payroll::with('fund_sources', 'users', 'positions', 'salary_grades', 'deductions')->get();
    $fundsource = FundSource::all();
    $user = User::all();
    $position = Position::all();
    $salarygrade = SalaryGrade::all();
    $deduction = Deduction::all();

    return view('content.pas.payroll', compact('payroll', 'fundsource', 'user', 'position', 'salarygrade', 'deduction'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'period_from' => 'required|date',
      'period_to' => 'required|date',
      'fund_source_id' => 'required|exists:fund_sources,id',
      'employee_name_id' => 'required|exists:users,id',
      'position_id' => 'required|exists:positions,id',
      'sg_num_id' => 'required|exists:salary_grades,id',
      'employee_id' => 'required|exists:users,id',
      'base_rate_id' => 'required|exists:salary_grades,id',
      'premium_amount_id' => 'required|exists:salary_grades,id',
      'total_amount_id' => 'required|exists:salary_grades,id',
      'late_and_absences' => 'required|numeric',
      'gross_amount_earned' => 'required|numeric',
      'tax_witheld' => 'nullable|numeric',
      'deduction_name_id' => 'required|exists:deductions,id',
      'deduction_amount_id' => 'required|exists:deductions,id',
      'total_deductions' => 'required|numeric',
      'net_amount_due_total' => 'required|numeric',
      'remarks' => 'nullable|string',
      'status' => 'nullable|string',
    ]);

    //Auto insert current date + time (Philippines timezone respected if set in config)
    $validated['request_date'] = now();
    //Auto insert current status
    $validated['status'] = 'Pending';

    Payroll::create($validated);

    return response()->json(['success' => true]);
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'period_from' => 'required|date',
      'period_to' => 'required|date',
      'fund_source_id' => 'required|exists:fund_sources,id',
      'employee_name_id' => 'required|exists:users,id',
      'position_id' => 'required|exists:positions,id',
      'sg_num_id' => 'required|exists:salary_grades,id',
      'employee_id' => 'required|exists:users,id',
      'base_rate_id' => 'required|exists:salary_grades,id',
      'premium_amount_id' => 'required|exists:salary_grades,id',
      'total_amount_id' => 'required|exists:salary_grades,id',
      'late_and_absences' => 'required|numeric',
      'gross_amount_earned' => 'required|numeric',
      'tax_witheld' => 'nullable|numeric',
      'deduction_name_id' => 'required|exists:deductions,id',
      'deduction_amount_id' => 'required|exists:deductions,id',
      'total_deductions' => 'required|numeric',
      'net_amount_due_total' => 'required|numeric',
      'remarks' => 'nullable|string',
    ]);

    $payroll = Payroll::findOrFail($id);
    $payroll->update($validated);

    return response()->json(['success' => true]);
  }

  public function destroy($id)
  {
    $payroll = Payroll::findOrFail($id);
    $payroll->delete();

    return response()->json(['success' => true]);
  }
}
