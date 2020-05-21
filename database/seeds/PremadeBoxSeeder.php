<?php

use App\PremadeBoxCategory;
use Illuminate\Database\Seeder;

class PremadeBoxSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Premade box seeder is running...');

    	$premadeBoxAmount = (int)$this->command->ask('How much premade box do you want?', 10);

    	$categories = PremadeBoxCategory::all();

    	factory('App\PremadeBox', $premadeBoxAmount)->make()->each(
    		function ($premadeBox) use ($categories) {
    			$premadeBox->premade_box_category_id = $categories->random()->id;
    			$premadeBox->save();
    		}
    	);   

        $this->command->info('Success!');
    }
}
