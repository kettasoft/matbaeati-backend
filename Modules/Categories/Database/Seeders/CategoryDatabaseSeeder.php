<?php

namespace Modules\Categories\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Modules\Categories\Entities\Category;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed($this->categories());
    }

    /**
     * Run the database seeds.
     *
     * @param array $categories
     * @return void
     */
    public function seed(array $categories = []): void
    {
        foreach ($categories as $categoryData) {
            $subcategoriesData = Arr::pull($categoryData, 'subcategories', []);

            // Create parent category
            $parentCategory = Category::create($categoryData);

            // Create subcategories and associate them with the parent category
            foreach ($subcategoriesData as $subcategoryData) {
                $parentCategory->subcategories()->create($subcategoryData);
            }
        }
    }

    protected function categories(): array
    {
        return [
            [
                'name:ar' => 'ورق',
                'name:en' => 'papers',
                'description:ar' => 'وصف الورق',
                'description:en' => 'Papers description',

                'subcategories' => [
                    [
                        'name:ar' => 'ورق طباعة',
                        'name:en' => 'Printing Paper',
                        'description:ar' => 'ورق مخصص للاستخدام في الطابعات العادية والطابعات الليزرية والنافثة للحبر.',
                        'description:en' => 'Paper designed for use in standard printers, laser printers, and inkjet printers.',
                    ]
                ]
            ],
        ];
    }
}
