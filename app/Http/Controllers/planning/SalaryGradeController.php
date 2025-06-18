<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalaryGrade;

class SalaryGradeController extends Controller
{
  public function index()
  {
    $salaryGrades = SalaryGrade::orderBy('sg_num')->get();
    return view('content.planning.salary-grade', compact('salaryGrades'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'sg_num' => 'required|numeric|unique:salary_grades,sg_num',
      'step_increment' => 'required|numeric',
      'sg_amount' => 'required|numeric',
    ]);

    SalaryGrade::create($validated);

    return response()->json(['success' => true]);
  }

  public function update(Request $request, $id)
  {
    $salaryGrade = SalaryGrade::findOrFail($id);

    $validated = $request->validate([
      'sg_num' => 'required|numeric|unique:salary_grades,sg_num,' . $salaryGrade->id,
      'step_increment' => 'required|numeric',
      'sg_amount' => 'required|numeric',
    ]);

    $salaryGrade->update($validated);

    return response()->json(['success' => true]);
  }

  public function destroy($id)
  {
    $salaryGrade = SalaryGrade::findOrFail($id);
    $salaryGrade->delete();

    return response()->json(['success' => true]);
  }
}
