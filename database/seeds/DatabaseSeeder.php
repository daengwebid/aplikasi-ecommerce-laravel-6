<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class DatabaseSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->disableForeignKeys();
        $this->truncateMultiple(['provinces', 'cities', 'districts']);

        //unprepeared statements
        $this->command->comment('Seeding Provinces');
        $province_sql = 'database/seeds/Unprepared/provinces.sql';
        DB::unprepared(file_get_contents($province_sql));
        $this->command->info('Seeded: Provinces');

        $this->command->comment('Seeding Cities');
        $city_sql = 'database/seeds/Unprepared/cities.sql';
        DB::unprepared(file_get_contents($city_sql));
        $this->command->info('Seeded: Cities');

        $this->command->comment('Seeding: Districts');
        if(DB::connection()->getDriverName() == "pgsql") {
            $district_sql = 'database/seeds/Unprepared/districts_pgsql.sql';
        } else {
            $district_sql = 'database/seeds/Unprepared/districts.sql';
        }
        DB::unprepared(file_get_contents($district_sql));
        $this->command->info('Seeded: Districts');

        $this->truncate('users');
        $this->call(UsersTableSeeder::class);

        $this->enableForeignKeys();
    }
}
