<?php

use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Card seeder is running...');

    	$cardAmount = (int)$this->command->ask('How much card do you want?', 15);

    	factory('App\Card', $cardAmount)->create();

    	$this->command->info('Success!');
    }
}
