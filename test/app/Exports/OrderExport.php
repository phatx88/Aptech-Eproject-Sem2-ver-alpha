<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithMapping;


class OrderExport implements FromCollection, WithHeadings, WithStyles, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::all();
    }

    public function headings(): array{
        return [
            'Id',
            'Created_date',
            'Order_status_id',
            'Customer_id',
            'Shipping_fullname',
            'Shipping_email',
            'Shipping_mobile',
            'Payment_method',
            'Coupon_id',
            'Shipping_housenumber_street',
            'Shipping_ward_id',
            'Shipping_fee',
            'Delivered_date',
            'Staff_id'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [                       
            'font' => [
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF375623',
                ]
            ]
        ];
        $sheet->getStyle('A1:N1')->applyFromArray($styleArray);

    }

}
