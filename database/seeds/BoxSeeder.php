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

    	$categories = Category::all();

    	factory('App\Box', $boxAmount)->make()->each(
    		function ($box) use ($categories) {
    			$box->category_id = $categories->random()->id;
    			$box->save();
    		}
    	);   

        $this->command->info('Success!');
    }
}
