<?php

use App\Models\Masterdata\Region;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::firstOrCreate(['name' => 'Arusha']);
        Region::firstOrCreate(['name' => 'Manyara']);
        Region::firstOrCreate(['name' => 'Kagera']);
        Region::firstOrCreate(['name' => 'Dar es Salaam']);
        Region::firstOrCreate(['name' => 'Pwani',]);
        Region::firstOrCreate(['name' => 'Morogoro']);
        Region::firstOrCreate(['name' => 'Dodoma']);
        Region::firstOrCreate(['name' => 'Singida']);
        Region::firstOrCreate(['name' => 'Mbeya']);
        Region::firstOrCreate(['name' => 'Songwe']);
        Region::firstOrCreate(['name' => 'Mwanza']);
        Region::firstOrCreate(['name' => 'Geita']);
        Region::firstOrCreate(['name' => 'Tanga']);
    }
}
