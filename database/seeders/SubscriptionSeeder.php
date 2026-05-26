<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $subscriptions = [
            ['name' => 'Starter', 'plan' => 'starter', 'price' => 19.99, 'status' => 'active'],
            ['name' => 'Growth', 'plan' => 'growth', 'price' => 49.99, 'status' => 'active'],
            ['name' => 'Enterprise', 'plan' => 'enterprise', 'price' => 99.99, 'status' => 'active'],
        ];

        foreach ($subscriptions as $subscription) {
            Subscription::updateOrCreate([
                'name' => $subscription['name'],
            ], $subscription);
        }
    }
}
