<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Development' => [
                'Web Development',
                'Mobile Apps',
                'Game Development',
                'Software Engineering',
            ],
            'Business' => [
                'Entrepreneurship',
                'Management',
                'Sales',
                'Business Strategy',
            ],
            'Finance & Accounting' => [
                'Accounting',
                'Investing',
                'Stock Trading',
                'Cryptocurrency',
            ],
            'IT & Software' => [
                'IT Certifications',
                'Network & Security',
                'Hardware',
                'Operating Systems',
            ],
            'Design' => [
                'Graphic Design',
                'Web Design',
                'UX/UI Design',
                'Motion Graphics',
            ],
            'Marketing' => [
                'Digital Marketing',
                'SEO',
                'Social Media Marketing',
                'Content Marketing',
            ],
        ];

        foreach ($categories as $parent => $children) {
            $parentCategory = Category::create([
                'name' => $parent,
                'slug' => Str::slug($parent),
                'is_active' => true,
            ]);

            foreach ($children as $child) {
                Category::create([
                    'name' => $child,
                    'slug' => Str::slug($child),
                    'parent_id' => $parentCategory->id,
                    'is_active' => true,
                ]);
            }
        }
    }
}
