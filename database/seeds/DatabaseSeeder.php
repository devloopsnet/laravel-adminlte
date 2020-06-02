<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * @date 11/30/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function run(): void {
        $this->call( [
            CountriesTableSeeder::class,
            GenresTableSeeder::class,
            CompaniesTableSeeder::class
        ] );
    }
}
