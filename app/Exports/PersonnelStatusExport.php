<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PersonnelStatusExport implements FromCollection, WithHeadings, WithMapping
{
  public function collection()
  {
    return User::with(['employmentStatus', 'division', 'section'])->get();
  }

  public function headings(): array
  {
    return ['Employee ID', 'Full Name', 'Employment Status', 'Division', 'Section'];
  }

  public function map($user): array
  {
    return [
      $user->employee_id,
      "{$user->first_name} {$user->middle_name} {$user->last_name} {$user->extension_name}",
      $user->employmentStatus->name ?? '-',
      $user->division->name ?? '-',
      $user->section->name ?? '-',
    ];
  }
}
