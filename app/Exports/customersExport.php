<?php

namespace App\Exports;

use App\Models\Customers;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class customersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('customers.customers_excel', [
            'customers' => Customers::all()
        ]);
    }
}