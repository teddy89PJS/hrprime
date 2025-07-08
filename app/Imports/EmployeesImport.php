<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeesImport implements ToModel
{
    public function model(array $row)
    {
        // Skip the header
        if ($row[0] === 'id number') return null;

        // Avoid duplicate entries
        if (User::where('employee_id', $row[0])->exists()) return null;

        return new User([
            'employee_id' => $row[0],
            'name'        => $row[1],
            'position'    => $row[2],
            'email'       => $row[3],
        ]);
    }
}
