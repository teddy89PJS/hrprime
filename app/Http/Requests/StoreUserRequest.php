<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'employee_id' => 'required|unique:users,employee_id',
      'first_name' => 'required|string',
      'middle_name' => 'nullable|string',
      'last_name' => 'required|string',
      'extension_name' => 'nullable|string',
      'employment_status' => 'required|exists:employment_statuses,id',
      'division' => 'required|exists:divisions,id',
      'section' => 'required|exists:sections,id',
      'email' => 'required|unique:users,email',
      'password' => 'required|string|min:6|confirmed',
    ];
  }
}
