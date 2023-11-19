<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('product.json');

        if (File::exists($path)) {
            $json = File::get($path);
            $data = json_decode($json, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                foreach ($data as $item) {
                    Product::create([
                        'id' => $item['id'] ?? null,
                        'name' => $item['name'] ?? null,
                        'description' => $item['description'] ?? null,
                        'features' => $item['features'] ?? null,
                        'price' => $item['price'] ?? null,
                        'keywords' => $item['keywords'] ?? null,
                        'url' => $item['url'] ?? null,
                        'category' => $item['category'] ?? null,
                        'subcategory' => $item['subcategory'] ?? null,
                        'images' => $item['images'] ?? null,
                    ]);
                }
            } else {
                \Illuminate\Support\Facades\Log::error("Error decoding JSON: " . json_last_error_msg());
            }
        } else {
            \Illuminate\Support\Facades\Log::error("File does not exist at path {$path}.");
        }
    }
}