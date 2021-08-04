<?php
namespace App\Exports;

use App\Payment;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class PaymentExports implements FromQuery,WithHeadings,ShouldAutoSize,WithStyles,WithTitle
{
    use Exportable;

    public function filter($year,$month,$class,$status)
    {
        $this->year  = $year;
        $this->month = $month;
        $this->class = $class;
        $this->status = $status;

        return $this;
    }

    public function styles(Worksheet $sheet)
    {
        // return [
        //     // Style the first row as bold text.
        //     1    => ['font' => ['bold' => true, 'size' => 13]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
            // $sheet->setBorder('A1:L20', 'thin');
            $sheet->getStyle('A1:L1')->getFont()->setFontSize(13)->setBold(true);
            // $sheet->getStyle('A1:L1')->setFontSize(13);
        // ];
    }

    public function title(): string
    {
        return 'Bulan ke-  ' . $this->month;
    }

    public function headings(): array
    {
        return [
            'ID Pembayaran',
            'Nomor Induk Siswa Nasional',
            'Nama Siswa',
            'Nama Wali Murid',
            'Nomor Wali Murid',
            'Nama Kelas',
            'Status Pembayaran',
            'Periode Pembayaran',
            'Tanggal Pembayaran',
            'Tanggal Terakhir Pembaharuan',
            'Bukti Bayar',
            'Keterangan'
        ];
    }

    public function query()
    {
        $payments =  DB::table('payments')
                    ->leftJoin('student_classes','payments.id_student_classes','=','student_classes.id')
                    ->leftJoin('students','student_classes.nisn_student','=','students.nisn')
                    ->leftJoin('classes','student_classes.id_class','=','classes.id')
                    ->select('payments.id as p_id','students.nisn as nisn','students.name as name','students.wali_name as wali_name','students.wali_number as wali_number','classes.name as c_name','payments.status','payments.year_payment','payments.created_at','payments.updated_at','payments.image_payment','payments.description')
                    ->where('payments.year_payment','=', $this->year)
                    ->where('payments.month_payment','=', $this->month)
                    ->where('classes.id','=', $this->class)
                    ->where('payments.status','=', $this->status)
                    ->orderBy('payments.id', 'asc');
        return  $payments;
    }

}
?>