<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run()
    {
        $plans = [
            [
                'name' => 'Business Plan',
                'slug' => 'business-plan',
                'stripe_plan' => 'price_1PSwwlLyj74BldhktkAypCD2',
                'price' => 70000 ,
                'description' => 'Business Plan'
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
