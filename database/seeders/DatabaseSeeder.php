<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@prestige.test',
            'password' => 'admin12345',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Customer Demo',
            'email' => 'customer@prestige.test',
            'password' => 'customer12345',
            'role' => 'customer',
        ]);

        $cars = [
            ['Revuelto V12 Hybrid', 'Lamborghini', 'Supercar', 45000000, 1015, 350],
            ['750S Spider', 'McLaren', 'Supercar', 36000000, 740, 332],
            ['Ghost Black Badge', 'Rolls-Royce', 'Luxury Sedan', 38000000, 592, 250],
            ['DBS', 'Aston Martin', 'Luxury Sedan', 32000000, 715, 340],
            ['296 GTB', 'Ferrari', 'Motorsport', 42000000, 830, 330],
            ['Urus Performante', 'Lamborghini', 'SUV', 28000000, 657, 306],
        ];

        foreach ($cars as [$name, $brand, $category, $price, $hp, $speed]) {
            Car::create([
                'name' => $name,
                'brand' => $brand,
                'category' => $category,
                'price_per_day' => $price,
                'hp' => $hp,
                'top_speed' => $speed,
                'status' => 'available',
                'image' => null,
            ]);
        }

        Testimonial::create([
            'user_name' => 'H. Hartono W.',
            'comment' => 'Pelayanan eksklusif, mobil prima dan pengantaran tepat waktu.',
            'rating' => 5,
        ]);
    }
}
