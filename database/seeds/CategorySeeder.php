<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Category seeder is running...');

    	$categoryAmount = (int)$this->command->ask('How much category do you want?', 7);

    	factory('App\Category', $categoryAmount)->create();

    	$this->command->info('Success!');
    }
}
