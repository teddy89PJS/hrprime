<?php

namespace App\Http\Controllers\pas;

use App\Http\Controllers\Controller;
use App\Models\SalaryGrade;
use Illuminate\Http\Request;

class SalaryGradeController extends Controller
{

  public function index()
  {
    $salarygrades = SalaryGrade::all();
    return view('content.pas.salarygrade', compact('salarygrades'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'sg_num'         => 'required|integer',
      'base_rate'      => 'required|numeric',
      'premium_rate'   => 'required|numeric',
  ]);

    // Compute premium amount (base_rate * premium_rate / 100)
    $premium_amount = ($request->base_rate * $request->premium_rate) / 100;

    // Auto calculate total amount (base rate + premium amount)
    $total_amount = $request->base_rate + $premium_amount;

    // Create record
    $salarygrades = SalaryGrade::create([
        'sg_num'         => $request->sg_num,
        'base_rate'      => $request->base_rate,
        'premium_rate'   => $request->premium_rate,
        'premium_amount' => $premium_amount,
        'total_amount'   => $total_amount
    ]);


    return response()->json([
      'success' => true,
      // 'message' => 'Salary Grade created successfully!', (Optional Message)
      'salarygrades' => $salarygrades
    ]);
  }

  public function update(Request $request, $id)
  {
    $salarygrades = SalaryGrade::findOrFail($id);

    $validated = $request->validate([
      'sg_num'         => 'required|integer',
      'base_rate'      => 'required|numeric',
      'premium_rate'   => 'required|numeric',
    ]);

    // Compute premium amount
    $premium_amount = ($request->base_rate * $request->premium_rate) / 100;

    // Compute total amount (base_rate + premium_amount)
    $total_amount = $request->base_rate + $premium_amount;

    //Update record
    $salarygrades->update([
        'sg_num'         => $request->sg_num,
        'base_rate'      => $request->base_rate,
        'premium_rate'   => $request->premium_rate,
        'premium_amount' => $premium_amount,
        'total_amount'   => $total_amount,
    ]);

    return response()->json([
      'success' => true,
      // 'message' => 'Salary Grade Updated successfully!', (Optional Message)
      'salarygrades' => $salarygrades
    ]);
  }

  public function destroy($id)
  {
    $salarygrades = SalaryGrade::findOrFail($id);
    $salarygrades->delete();

    return response()->json(['success' => true]);
  }


}
