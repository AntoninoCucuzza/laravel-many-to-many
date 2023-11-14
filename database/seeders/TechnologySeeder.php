<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['HTML', 'CSS', 'BOOTSTRAP 5', 'JS', 'VUE 3', 'VITE', 'PHP', 'LARAVEL 10', 'MYSQL', 'GIT'];

        foreach ($technologies as $tech) {
            $new_tech = new Technology();
            $new_tech->name = $tech;
            $new_tech->slug = Str::slug($new_tech->name, '-');
            $new_tech->save();
        }
    }
}
