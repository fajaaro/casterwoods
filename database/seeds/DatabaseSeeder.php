<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BoxSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(CardSeeder::class);
        $this->call(CourierSeeder::class);
        $this->call(PremadeBoxCategorySeeder::class);
        $this->call(PremadeBoxSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(ItemTransactionSeeder::class);
    }
}
