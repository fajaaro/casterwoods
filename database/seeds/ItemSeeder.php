<?php

use App\Category;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Item seeder is running...');

    	$itemAmount = (int)$this->command->ask('How much item do you want?', 50);

    	$categories = Category::all();

    	factory('App\Item', $itemAmount)->make()->each(
    		function ($item) use ($categories) {
    			$item->category_id = $categories->random()->id;
    			$item->save();
    		}
    	);   

        $this->command->info('Success!');
    }
}