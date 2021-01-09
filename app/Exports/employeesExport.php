<?php

namespace App\Exports;

use App\Models\employees;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class employeesExport implements FromView
{
    public function view(): View
    {
        return view('employees.employees_excel', [
            'employees' => employees::all()
        ]);
    }
}
