<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class ProductsExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $products = collect();

        // Retrieve all products and include the related category name using eager loading
        // Chunk the results to avoid memory issues as the dataset grows
        Product::query()->with('category')->chunk(100, function ($chunk) use ($products) {
            $chunk->each(function ($product) use ($products) {
                $products->push([
                    'ID' => $product->id,
                    'Name' => $product->name,
                    'Description' => $product->description,
                    'Price' => $product->price,
                    'Category' => $product->category->name,
                    'Created At' => $product->created_at->format('Y-m-d H:i:s'),
                    'Updated At' => $product->updated_at->format('Y-m-d H:i:s'),
                ]);
            });
        });

        return $products;
    }

    /**
     * Add custom headers
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Description',
            'Price',
            'Category',
            'Created At',
            'Updated At',
        ];
    }

    /**
     * Apply styles to the headings
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function (\Maatwebsite\Excel\Events\AfterSheet $event) {
                $headingCount = count($this->headings());
                $columnRange = 'A1:' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($headingCount) . '1';
                $event->sheet->getDelegate()->getStyle($columnRange)->getFont()->setBold(true);
            },
        ];
    }
}
