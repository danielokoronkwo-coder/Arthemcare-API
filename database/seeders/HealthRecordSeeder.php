<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HealthRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\HealthRecord::factory(40)->create();

    }
}
