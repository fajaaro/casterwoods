<?php

use App\Category;
use App\Image;
use Illuminate\Database\Seeder;

class BoxSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Box seeder is running...');

    	$boxAmount = (int)$this->command->ask('How much box do you want?', 10);

    	factory('App\Box', $boxAmount)->create();   

        $this->command->info('Success!');
    }
}
