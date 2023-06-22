<?php

use App\Models\Masterdata\District;
use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        District::firstOrCreate(['name' => 'Arusha', 'region_id' => 1]);
        District::firstOrCreate(['name' => 'Arumeru', 'region_id' => 1]);
        District::firstOrCreate(['name' => 'Babati', 'region_id' => 2]);
        District::firstOrCreate(['name' => 'Kinondoni', 'region_id' => 4]);
        District::firstOrCreate(['name' => 'Ilala', 'region_id' => 4]);
        District::firstOrCreate(['name' => 'Temeke', 'region_id' => 4]);
        District::firstOrCreate(['name' => 'Kibaha', 'region_id' => 5]);
        District::firstOrCreate(['name' => 'Bagamoyo', 'region_id' => 5]);
        District::firstOrCreate(['name' => 'Kilosa', 'region_id' => 6]);
        District::firstOrCreate(['name' => 'Gairo', 'region_id' => 6]);
        District::firstOrCreate(['name' => 'Dodoma', 'region_id' => 7]);
        District::firstOrCreate(['name' => 'Chamwino', 'region_id' => 7]);
        District::firstOrCreate(['name' => 'Singida', 'region_id' => 8]);
        District::firstOrCreate(['name' => 'Manyoni', 'region_id' => 8]);
        District::firstOrCreate(['name' => 'Mbeya', 'region_id' => 9]);
        District::firstOrCreate(['name' => 'Kyela', 'region_id' => 9]);
        District::firstOrCreate(['name' => 'Nyamagana', 'region_id' => 11]);
        District::firstOrCreate(['name' => 'Ilemelea', 'region_id' => 11]);
        District::firstOrCreate(['name' => 'Lushoto', 'region_id' => 13]);
        District::firstOrCreate(['name' => 'Handeni', 'region_id' => 13]);
    }
}
