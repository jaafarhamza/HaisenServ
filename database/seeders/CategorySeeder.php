<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainCategories = [
            [
                'name' => 'Home Services',
                'description' => 'Services related to home maintenance and improvement',
                'meta_title' => 'Home Services | HaisenServ',
                'meta_description' => 'Find professional home maintenance and improvement services',
                'meta_keywords' => 'home services, home maintenance, home improvement',
                'og_title' => 'Home Services',
                'og_description' => 'Professional home services for all your needs'
            ],
            [
                'name' => 'Professional Services',
                'description' => 'Professional consulting and specialized services',
                'meta_title' => 'Professional Services | HaisenServ',
                'meta_description' => 'Connect with expert professionals for consulting and specialized services',
                'meta_keywords' => 'professional services, consulting, expert professionals',
                'og_title' => 'Professional Services',
                'og_description' => 'Expert consulting and professional services'
            ],
            [
                'name' => 'Health & Wellness',
                'description' => 'Services for health, fitness, and wellbeing',
                'meta_title' => 'Health & Wellness Services | HaisenServ',
                'meta_description' => 'Find health, fitness, and wellbeing services near you',
                'meta_keywords' => 'health services, wellness, fitness, wellbeing',
                'og_title' => 'Health & Wellness Services',
                'og_description' => 'Take care of your health and wellbeing with our professional services'
            ],
            [
                'name' => 'Education & Training',
                'description' => 'Educational and training services for all ages',
                'meta_title' => 'Education & Training Services | HaisenServ',
                'meta_description' => 'Find quality education and training services',
                'meta_keywords' => 'education, training, tutoring, courses',
                'og_title' => 'Education & Training Services',
                'og_description' => 'Quality education and training services for personal and professional growth'
            ],
        ];
        // Create main categories
        foreach ($mainCategories as $category) {
            $slug = Str::slug($category['name']);
            Category::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'slug' => $slug,
                'meta_title' => $category['meta_title'],
                'meta_description' => $category['meta_description'],
                'meta_keywords' => $category['meta_keywords'],
                'canonical_url' => 'https://haisenserv.com/categories/' . $slug,
                'og_title' => $category['og_title'],
                'og_description' => $category['og_description'],
                'og_image_url' => 'https://haisenserv.com/images/categories/' . $slug . '.jpg',
                'robots' => 'index,follow'
            ]);
        }
         // Subcategories for Home Services
         $homeSubcategories = [
            'Cleaning Services',
            'Plumbing',
            'Electrical Work',
            'Carpentry',
            'HVAC Services',
            'Painting',
            'Landscaping',
            'Home Security'
        ];

        $homeCategory = Category::where('name', 'Home Services')->first();
        foreach ($homeSubcategories as $subcat) {
            $slug = Str::slug($subcat);
            Category::create([
                'name' => $subcat,
                'description' => "Professional {$subcat} for your home",
                'parent_id' => $homeCategory->id,
                'slug' => $slug,
                'meta_title' => "{$subcat} | HaisenServ",
                'meta_description' => "Find expert {$subcat} providers for your home needs",
                'meta_keywords' => strtolower($subcat) . ', home services, professional',
                'canonical_url' => 'https://haisenserv.com/categories/' . $slug,
                'og_title' => $subcat,
                'og_description' => "Professional {$subcat} for all your home needs",
                'og_image_url' => 'https://haisenserv.com/images/categories/' . $slug . '.jpg',
                'robots' => 'index,follow'
            ]);
        }
        // Subcategories for Professional Services
        $proSubcategories = [
            'Legal Consulting',
            'Financial Services',
            'IT Consulting',
            'Marketing Services',
            'Business Consulting',
            'Accounting Services',
            'Human Resources',
            'Virtual Assistance'
        ];
        $proCategory = Category::where('name', 'Professional Services')->first();
        foreach ($proSubcategories as $subcat) {
            $slug = Str::slug($subcat);
            Category::create([
                'name' => $subcat,
                'description' => "Expert {$subcat} for businesses and individuals",
                'parent_id' => $proCategory->id,
                'slug' => $slug,
                'meta_title' => "{$subcat} | HaisenServ",
                'meta_description' => "Connect with expert {$subcat} professionals",
                'meta_keywords' => strtolower($subcat) . ', professional services, consulting',
                'canonical_url' => 'https://haisenserv.com/categories/' . $slug,
                'og_title' => $subcat,
                'og_description' => "Expert {$subcat} for businesses and individuals",
                'og_image_url' => 'https://haisenserv.com/images/categories/' . $slug . '.jpg',
                'robots' => 'index,follow'
            ]);
        }
        // Subcategories for Health & Wellness
        $healthSubcategories = [
            'Personal Training',
            'Yoga Instruction',
            'Nutritional Consulting',
            'Massage Therapy',
            'Mental Health Services',
            'Physical Therapy',
            'Meditation Classes',
            'Health Coaching'
        ];
        $healthCategory = Category::where('name', 'Health & Wellness')->first();
        foreach ($healthSubcategories as $subcat) {
            $slug = Str::slug($subcat);
            Category::create([
                'name' => $subcat,
                'description' => "Professional {$subcat} for your health and wellbeing",
                'parent_id' => $healthCategory->id,
                'slug' => $slug,
                'meta_title' => "{$subcat} | HaisenServ",
                'meta_description' => "Find professional {$subcat} providers near you",
                'meta_keywords' => strtolower($subcat) . ', health, wellness, wellbeing',
                'canonical_url' => 'https://haisenserv.com/categories/' . $slug,
                'og_title' => $subcat,
                'og_description' => "Professional {$subcat} for your health and wellbeing",
                'og_image_url' => 'https://haisenserv.com/images/categories/' . $slug . '.jpg',
                'robots' => 'index,follow'
            ]);
        }
        // Subcategories for Education & Training
        $eduSubcategories = [
            'Private Tutoring',
            'Language Classes',
            'Music Lessons',
            'Art Classes',
            'Professional Certification',
            'Coding Bootcamps',
            'Academic Coaching',
            'Test Preparation'
        ];
        
        $eduCategory = Category::where('name', 'Education & Training')->first();
        foreach ($eduSubcategories as $subcat) {
            $slug = Str::slug($subcat);
            Category::create([
                'name' => $subcat,
                'description' => "Quality {$subcat} for all ages and levels",
                'parent_id' => $eduCategory->id,
                'slug' => $slug,
                'meta_title' => "{$subcat} | HaisenServ",
                'meta_description' => "Find professional {$subcat} providers for all levels",
                'meta_keywords' => strtolower($subcat) . ', education, training, learning',
                'canonical_url' => 'https://haisenserv.com/categories/' . $slug,
                'og_title' => $subcat,
                'og_description' => "Quality {$subcat} for all ages and levels",
                'og_image_url' => 'https://haisenserv.com/images/categories/' . $slug . '.jpg',
                'robots' => 'index,follow'
            ]);
        }
    }
}