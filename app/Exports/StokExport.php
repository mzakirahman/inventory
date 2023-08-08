<?php

namespace App\Exports;

use App\Models\Stok;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;

class StokExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        return view('export.stok', [
            'stok' => Stok::orderBy('created_at', 'desc')->get()
        ]);
    }
}
