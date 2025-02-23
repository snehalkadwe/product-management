<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Product|null
     */
    public function model(array $row)
    {
        // Find category by id
        $category = \App\Models\Category::where('id', $row['category_id'])->first();

        if (!$category) {
            throw new \Exception('Invalid category: ' . $row['category_id']);
        }

        return new Product([
            'name'  => $row['name'],
            'description' => $row['description'],
            'price' => is_numeric($row['price']) ? floatval($row['price']) : 0,
            'category_id' => $category->id,
        ]);
    }
}
