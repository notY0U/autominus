<?php

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
        $thisYear = (int) date('Y');
        $faker = Faker\Factory::create('lt_LT');
        $make = ['Volvo', 'UAZ', 'Mercedes', 'GAZ', 'MAN', 'Renault'];
        sort($make);
        foreach ($make as $val) {
            DB::table('makes')->insert([
                'make' => $val,
            ]);
        }
        foreach(range(1,40) as $val) {
            DB::table('vehicles')->insert([
                'make_id' => rand(1,6),
                'year' => rand(1900, $thisYear),
                'owner' => $faker->name,
                'prevOwners' => rand(0,20),
                'comments' => $faker->sentence(10, true),
            ]);
        }
    }
}
