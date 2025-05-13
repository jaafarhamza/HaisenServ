<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = User::whereHas('roles', function ($query) {
            $query->where('name', 'provider');
        })->get();

        $categories = Category::whereNotNull('parent_id')->get();

        $usedSlugs = [];
        foreach ($categories as $category) {
            // Create 3-5 services for each subcategory
            $serviceCount = rand(3, 5);

            for ($i = 0; $i < $serviceCount; $i++) {
                $provider = $providers->random();
                $title = $this->generateServiceTitle($category->name);

                // Générer un slug unique
                $baseSlug = Str::slug($title);
                $slug = $baseSlug;
                $counter = 1;

                while (in_array($slug, $usedSlugs)) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                // Ajouter le slug à la liste des slugs utilisés
                $usedSlugs[] = $slug;
                $price = $this->generatePrice($category->name);

                Service::create([
                    'user_id' => $provider->id,
                    'category_id' => $category->id,
                    'title' => $title,
                    'description' => $this->generateDescription($title, $category->name),
                    'price' => $price,
                    'creation_date' => now()->subDays(rand(1, 90)),
                    'status' => 'published',
                    'meta_title' => $title . ' | HaisenServ',
                    'meta_description' => "Professional {$title} service in {$category->name}. Starting at \${$price}.",
                    'slug' => $slug,
                    'meta_keywords' => strtolower($title) . ', ' . strtolower($category->name) . ', professional services',
                    'canonical_url' => 'https://haisenserv.com/services/' . $slug,
                    'og_title' => $title,
                    'og_description' => "Professional {$title} service with experienced providers. Book now!",
                    'og_image_url' => 'https://haisenserv.com/images/services/' . $slug . '.jpg',
                ]);
            }
        }
    }

    private function generateServiceTitle($categoryName): string
    {
        $serviceTypes = [
            'Cleaning Services' => [
                'Deep Home Cleaning',
                'Office Cleaggning Service',
                'Carpet Cleaning',
                'Move-in/Move-out Cleaning',
                'Weekly Home Cleaning'
            ],
            'Plumbing' => [
                'Emergency Plumbing Service',
                'Bathroom Fixture Installation',
                'Drain Cleaning',
                'Water Heater Repair',
                'Pipe Leak Repair'
            ],
            'Legal Consulting' => [
                'Legal Document Review',
                'Contract Drafting Service',
                'Legal Consultation',
                'Business Legal Advisory',
                'Patent Application Assistance'
            ],
            'Personal Training' => [
                'One-on-One Fitness Training',
                'Customized Workout Program',
                'Weight Loss Coaching',
                'Strength Training Sessions',
                'Athletic Performance Training'
            ],
            'Private Tutoring' => [
                'Math Tutoring',
                'Science Tutoring',
                'Language Arts Tutoring',
                'SAT/ACT Preparation',
                'College Admission Essay Coaching'
            ]
        ];

        // If category has specific service types, use them
        if (array_key_exists($categoryName, $serviceTypes)) {
            return $serviceTypes[$categoryName][array_rand($serviceTypes[$categoryName])];
        }

        $adjectives = ['Professional', 'Expert', 'Premium', 'Reliable', 'Customized', 'Specialized'];
        $suffixes = ['Service', 'Consultation', 'Assistance', 'Support', 'Solutions'];

        return $adjectives[array_rand($adjectives)] . ' ' . $categoryName . ' ' . $suffixes[array_rand($suffixes)];
    }

    private function generatePrice($categoryName): float
    {
        $basePrices = [
            'Cleaning Services' => [25, 50],
            'Plumbing' => [75, 150],
            'Electrical Work' => [80, 150],
            'Legal Consulting' => [100, 300],
            'Financial Services' => [80, 250],
            'Personal Training' => [40, 100],
            'Yoga Instruction' => [30, 80],
            'Private Tutoring' => [25, 60],
            'Language Classes' => [30, 70],
        ];

        if (array_key_exists($categoryName, $basePrices)) {
            $range = $basePrices[$categoryName];
            return round(rand($range[0] * 100, $range[1] * 100) / 100, 2);
        }

        return round(rand(3000, 20000) / 100, 2);
    }

    private function generateDescription($title, $categoryName): string
    {
        return "Professional {$title} service offered by experienced providers in the {$categoryName} field. 
                Our service includes comprehensive consultation, personalized approach, and satisfaction guarantee. 
                With years of experience, our providers deliver high-quality results that meet your specific needs. 
                Whether you're a homeowner, business professional, or individual looking for expert assistance, 
                our {$title} service is designed to exceed your expectations. 
                Contact us today to schedule your appointment or request a quote.";
    }
}