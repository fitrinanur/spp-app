<?php
namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class StudentExports implements FromCollection, WithHeadings, WithCustomStartCell
{
    public function collection()
    {
        return Student::all();
    }

    public function startCell(): string
    {
        return 'B1';
    }

    public function headings(): array
    {
        return [
            'nisn',
            'nama',
            'alamat',
            'nama wali murid',
            'nomor hape',
            'agama',
            'pekerjaan',
        ];
    }

    

}