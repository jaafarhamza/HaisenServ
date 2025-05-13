<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all provider users
        $providers = User::whereHas('roles', function ($query) {
            $query->where('name', 'provider');
        })->get();

        // If no providers, create some
        if ($providers->count() === 0) {
            $this->command->info('No providers found. Creating some...');
            
            // Create 10 provider users
            for ($i = 0; $i < 10; $i++) {
                $user = User::factory()->create();
                $user->assignRole('provider');
                $providers->push($user);
            }
        }

        // Get all categories
        $categories = Category::all();

        // If no categories, create some
        if ($categories->count() === 0) {
            $this->command->info('No categories found. Creating some...');
            
            $categoryNames = [
                'Cleaning' => 'Home cleaning and maintenance services',
                'Plumbing' => 'Plumbing repair and installation services',
                'Electrical' => 'Electrical services and repairs',
                'Gardening' => 'Garden maintenance and landscaping',
                'Tutoring' => 'Academic and skills tutoring',
                'Beauty' => 'Beauty and wellness services',
                'IT Support' => 'Computer and technology assistance',
                'Home Repairs' => 'General home repairs and maintenance',
                'Moving' => 'Moving and relocation assistance',
                'Pet Care' => 'Pet sitting and animal care services',
            ];
            
            foreach ($categoryNames as $name => $description) {
                $category = Category::create([
                    'name' => $name,
                    'description' => $description,
                    'icon_url' => '/icons/categories/' . Str::slug($name) . '.png',
                ]);
                $categories->push($category);
            }
        }

        // Cities in Morocco
        $moroccanCities = [
            'Casablanca', 'Rabat', 'Marrakech', 'Fes', 'Tangier', 
            'Agadir', 'Meknes', 'Oujda', 'Kenitra', 'Tetouan',
            'El Jadida', 'Safi', 'Mohammedia', 'Khouribga', 'Beni Mellal'
        ];

        // Service status options
        $statusOptions = ['draft', 'pending', 'active', 'inactive'];

        // Create 100 services
        $this->command->info('Creating 100 services...');

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $provider = $providers->random();
            $category = $categories->random();
            
            $title = $faker->sentence(4);
            $slug = Str::slug($title);
            
            // Randomly select a status with weighted probabilities
            // Most services should be active or pending
            $statusRandom = rand(1, 100);
            if ($statusRandom <= 60) {
                $status = 'active';
            } elseif ($statusRandom <= 85) {
                $status = 'pending';
            } elseif ($statusRandom <= 95) {
                $status = 'draft';
            } else {
                $status = 'inactive';
            }
            
            $city = $faker->randomElement($moroccanCities);
            
            Service::create([
                'user_id' => $provider->id,
                'category_id' => $category->id,
                'title' => $title,
                'description' => $faker->paragraphs(rand(2, 5), true),
                'price' => $faker->randomFloat(2, 50, 1000),
                'creation_date' => $faker->dateTimeBetween('-6 months', 'now'),
                'status' => $status,
                'meta_title' => $title,
                'meta_description' => $faker->sentence(10),
                'slug' => $slug,
                'meta_keywords' => implode(', ', $faker->words(5)),
                'canonical_url' => 'https://haisenserv.com/services/' . $slug,
                'og_title' => $title,
                'og_description' => $faker->sentence(8),
                'og_image_url' => '/images/services/' . rand(1, 10) . '.jpg',
                'city' => $city,
            ]);
            
            if (($i + 1) % 20 === 0) {
                $this->command->info(($i + 1) . ' services created');
            }
        }

        $this->command->info('All services have been created successfully!');
    }
}