<?php

namespace App\Exports;

use App\Models\invoices;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
class SupplierInvoicesExport implements FromView,WithDrawings
{
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/assets/img/brand/ayamzaman.png'));
        $drawing->setHeight(150);
        $drawing->setWidth(150);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
    public function view(): View
    {
        return view('invoices.allinvoices_excel', [
            'invoices' => invoices::all()
        ]);
    }

}