<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        // Main categories
        $mainCategories = ['A', 'B', 'C', 'D', 'E'];

        foreach ($mainCategories as $mainCategory) {
            $mainCategoryModel = Category::create(['name' => 'Category ' . $mainCategory]);

            // Sub categories
            for ($i = 1; $i <= 5; $i++) {
                $subCategoryModel = Category::create([
                    'name' => 'Sub ' . $mainCategory . $i,
                    'parent_id' => $mainCategoryModel->id
                ]);

                // Sub sub categories
                for ($j = 1; $j <= 5; $j++) {
                    $subSubCategoryModel = Category::create([
                        'name' => 'Sub Sub ' . $mainCategory . $i . '-' . $j,
                        'parent_id' => $subCategoryModel->id
                    ]);

                    // Sub sub sub categories
                    $subSubSubCategoryModel = Category::create([
                        'name' => 'Sub Sub Sub ' . $mainCategory . $i . '-' . $j . '-' . $j,
                        'parent_id' => $subSubCategoryModel->id
                    ]);
                }
            }
        }
    }
}

