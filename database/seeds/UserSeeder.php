<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('User seeder is running...');

    	$userAmount = (int)$this->command->ask('How much user do you want?', 25);

    	$this->command->info('Creating user-fajar factory states...');
    	factory('App\User')->states('user-fajar')->create();

    	$this->command->info("Creating another {$userAmount} users...");
    	factory('App\User', $userAmount)->create();

    	$this->command->info('Success!');
    }
}
