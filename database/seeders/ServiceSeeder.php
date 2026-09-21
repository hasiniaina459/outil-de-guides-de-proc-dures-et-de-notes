<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        service::firstOrCreate(
            ['service_name'=>'service informatique'],
            ['description'=>'service dedié au logiciel et appareil']
        );
    }
}
