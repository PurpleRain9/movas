<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(LabourCardTypeSeeder::class);
        $this->call(PersonTypeSeeder::class);
        $this->call(RankSeeder::class);
        $this->call(StayTypeSeeder::class);
        $this->call(VisaTypeSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PermitTypeSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(RelationShipSeeder::class);
        
    }
}
