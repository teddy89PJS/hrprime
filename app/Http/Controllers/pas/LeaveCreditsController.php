<?php

namespace App\Http\Controllers\pas;


use App\Http\Controllers\Controller;
use App\Models\LeaveCredits;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class LeaveCreditsController extends Controller
{

  public function index()
    {
      $leavecredits = LeaveCredits::with('user')->get();

      return view('content.pas.leavecredits', compact( 'leavecredits' ));
    }

    public function autoGenerate()
    {
        $now = Carbon::now();

        if (Carbon::now()->day != 1) {
            return redirect()->back()->with('error', 'Leave Credits can only be Generated on the 1st of the Month.');
        }

        $users = User::all();
        {
            foreach ($users as $user) {
            $exists = LeaveCredits::where('employee_id', $user->employee_id)
            ->where('employee_name_id', $user->employee_name_id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->exists();

            if (!$exists) {
            $vacation = 1.50;
            $sick = 1.50;
            $total = $vacation + $sick;
            }
            //Kani AKong Error
            LeaveCredits::create([
              'employee_id' => $user->employee_id,
              'employee_name_id' => $user->id,
              'vacation_leave' => $vacation,
              'sick_leave' => $sick,
              'total_leave' => $total,
            ]);


          }
        }

        return redirect()->route('leavecredits.index')->with('success', 'Leave Credits Have Been Successfully Generated.');
}


}
