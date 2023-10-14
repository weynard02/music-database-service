<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan = array("free", "student", "premium", "admin");
        $price = array(0, 27500, 50000, 0);
        $len = count($plan);
        for($i=0;$i<$len;$i++) {
            Plan::create([
                'name' => $plan[$i],
                'price' => $price[$i]
            ]);
        }
    }
}
