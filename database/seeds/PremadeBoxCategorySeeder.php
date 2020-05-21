<?php

use Illuminate\Database\Seeder;

class PremadeBoxCategorySeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Premade box category seeder is running...');

    	$categoryAmount = (int)$this->command->ask('How much category do you want?', 4);

    	factory('App\PremadeBoxCategory', $categoryAmount)->create();

    	$this->command->info('Success!');
    }
}
