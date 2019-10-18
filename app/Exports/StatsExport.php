<?php

namespace App\Exports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StatsExport implements FromView, ShouldQueue, ShouldAutoSize
{

    use Exportable;
    public $stats;

    public function __construct($stats) {
        $this->stats = $stats;
     }

    public function view(): View
    {
        return view('partials.data',[
            'statsView' => $this->stats,
        ]);

    }


}
