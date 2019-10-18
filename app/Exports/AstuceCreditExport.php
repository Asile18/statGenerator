<?php

namespace App\Exports;

use App\ModelsAstuceCredit\Prospect as ProspectAstuceCredit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;



class AstuceCreditExport implements FromCollection
{

    use Exportable;
    

    public function collection()
    {
        return ProspectAstuceCredit::all();
    }

}
