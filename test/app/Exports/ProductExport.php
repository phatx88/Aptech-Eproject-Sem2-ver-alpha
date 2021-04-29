<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


use App\Models\Products;
class ProductExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Products::all();
    }
    //function of WithHeadings must be same 'name'
    public function headings(): array
    {
        return [
            'id',
            'barcode',
            'sku',
            'name',
            'price',
            'discount_percentage',
            'discount_from_date',
            'featured_image',
            'inventory_qty',
            'category_id',
            'brand_id',
            'created_date',
            'description',
            'star',
            'featured',
            'hidden',
            'view_count'
        ];
    }

    //style Excel - Worksheet 1tab của Excel
    public function styles(Worksheet $sheet){
        $styleArray = [
            'font' => [
                'color' => ['argb' => 'FFFFFFF']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF375623',
                ]
            ]
        ];
        $sheet->getStyle('A1:R1')->applyFromArray($styleArray);
    }
}
