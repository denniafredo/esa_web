<?php

namespace App\Exports;

use App\Models\Employment;
use Maatwebsite\Excel\Concerns\FromCollection;

class BenefitExport implements FromCollection
{
    protected $employee;

    public function __construct(Employment $employment)
    {
        $this->employment = $employment;
    }

    public function collection()
    {
        return collect([
            [
                'Name' => $this->employment->name,
                'Email' => $this->employment->email,
                'Address' => $this->employment->address,
                // Add more employee data fields here as needed
            ]
        ]);
    }
}
