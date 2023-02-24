<?php
namespace App\Package;

use App\Models\Templates;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportFile implements FromCollection,WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings():array{
        return[
            'Id',
            'Name',
            'Email',
            'City',
            'Created_at',
            'Updated_at'
        ];
    }
    public function collection()
    {
        return Student::all();
    }
}
