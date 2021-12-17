<?php

namespace App\Exports;

use App\TblAccount;
use Maatwebsite\Excel\Concerns\FromCollection;

class AccountsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TblAccount::all();
    }
}
