<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Softwarescares\Safaricomdaraja\app\Models\BusinessToCustomerTransaction;
use Softwarescares\Safaricomdaraja\app\Models\CustomerToBusinessTransaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MpesaExpressTableSeeder::class,
            CustomerToBusinessTableSeeder::class,
            BusinessToCustomerTableSeeder::class
        ]);
    }
}
