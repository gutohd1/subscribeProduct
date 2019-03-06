<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new Service;
        $service->insert([
            'name' => Str::random(10)
        ]);
        $service->insert([
            'name' => Str::random(10)
        ]);
        $service->insert([
            'name' => Str::random(10)
        ]);
    }
}
