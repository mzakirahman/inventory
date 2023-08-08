<?php

namespace App\Exports;

use App\Models\Suplier;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SuplierExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        return view('export.suplier', [
            'suplier' => Suplier::orderBy('created_at', 'desc')->get()
        ]);
    }
}
