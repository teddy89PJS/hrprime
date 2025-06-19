<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\PersonnelStatusExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Section;
use App\Models\EmploymentStatus;
use Illuminate\Support\Facades\DB;
use App\Models\Position;
use App\Models\JoRequest;

class ReportController extends Controller
{
  public function index(Request $request)
  {
    $type = $request->query('type');
    $reportView = null;
    $data = [];

    switch ($type) {
      case 'personnel-status':
        $employees = User::with(['employmentStatus', 'division', 'section'])->get();
        $reportView = 'content.planning.reports.personnel-status';
        return view('content.planning.report', compact('reportView', 'employees'));

      case 'complement-status':
        $statuses = EmploymentStatus::all();
        $sections = Section::all();
        $data = [];

        foreach ($sections as $section) {
          foreach ($statuses as $status) {
            $data[$section->id][$status->id] = User::where('section_id', $section->id)
              ->where('employment_status_id', $status->id)
              ->count();
          }
        }


        $reportView = 'content.planning.reports.complement-status';
        return view('content.planning.report', compact('reportView', 'statuses', 'sections', 'data'));

      case 'rsw-breakdown':
        $employees = User::with(['employmentStatus', 'division', 'section'])->get();
        $reportView = 'content.planning.reports.rsw-breakdown';
        return view('content.planning.report', compact('reportView', 'employees'));

      case 'special-groups':
        $employees = User::with(['employmentStatus', 'division', 'section'])->get();
        $reportView = 'content.planning.reports.special-groups';
        return view('content.planning.report', compact('reportView', 'employees'));

      case 'vacant-positions':
        $positions = Position::with(['salaryGrade', 'employmentStatus', 'section'])
          ->where('status', 'inactive')
          ->get();

        $reportView = 'content.planning.reports.vacant-positions';

        return view('content.planning.report', compact('reportView', 'positions'));

      case 'issued-appointments':
        $employees = User::with(['employmentStatus', 'division', 'section'])->get();
        $reportView = 'content.planning.reports.issued-appointments';
        return view('content.planning.report', compact('reportView', 'employees'));

      case 'moa-cos':
        $employees = User::with(['employmentStatus', 'division', 'section'])->get();
        $reportView = 'content.planning.reports.moa-cos';
        return view('content.planning.report', compact('reportView', 'employees'));

      case 'database-creations':
        $employees = JoRequest::with(['section', 'fundSource'])
          ->where('status', 'approved')
          ->latest()
          ->get();
        $reportView = 'content.planning.reports.database-creations';
        return view('content.planning.report', compact('reportView', 'employees'));


        // Add other report types similarly...
    }

    // Default
    return view('content.planning.report', ['reportView' => null]);
  }


  public function export(Request $request)
  {
    $type = $request->query('type');

    switch ($type) {
      case 'personnel-status':
        return Excel::download(new PersonnelStatusExport, 'personnel_status_report.xlsx');
      default:
        abort(404, 'Report type not supported.');
    }
  }
  public function personnelStatus()
  {
    $employmentTypes = [
      'regular' => 'Regular Positions',
      'cti' => 'Coterminous with the Incumbent (CTI)',
      'casual' => 'Casual Positions',
      'contractual' => 'Contractual Positions',
      'cos' => 'Contract of Service',
      'jo' => 'Job Orders',
    ];

    $data = [];

    foreach ($employmentTypes as $key => $label) {
      $data[$key] = User::select(
        'salary_grade',
        DB::raw('COUNT(*) as actual'),
        DB::raw('0 as authorized') // Placeholder for now
      )
        ->where('employment_type', $key) // Adjust based on your schema
        ->groupBy('salary_grade')
        ->orderBy('salary_grade', 'desc')
        ->get()
        ->map(function ($row) {
          $row->variance = $row->authorized - $row->actual;
          return $row;
        });
    }

    return view('content.planning.reports.personnel-status', compact('data', 'employmentTypes'));
  }

  public function complementStatus()
  {
    // Get all sections as "programs"
    $sections = Section::orderBy('name')->get();

    // Get all employment types (for columns)
    $statuses = EmploymentStatus::orderBy('name')->get();

    // Get aggregated data: Count employees per section + employment status
    $employees = User::select('section_id', 'employment_status_id', DB::raw('COUNT(*) as total'))
      ->whereNotNull('section_id')
      ->whereNotNull('employment_status_id')
      ->groupBy('section_id', 'employment_status_id')
      ->get();

    // Format to matrix: [section_id][employment_status_id] = count
    $data = [];
    foreach ($employees as $emp) {
      $data[$emp->section_id][$emp->employment_status_id] = $emp->total;
    }

    return view('content.planning.reports.complement-status', compact('sections', 'statuses', 'data'));
  }
}
