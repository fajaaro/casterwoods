<?php

use App\Box;
use App\Card;
use App\Courier;
use App\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Transaction seeder is running...');

    	$transactionAmount = (int)$this->command->ask('How much transaction do you want?', 5);

    	$users = User::all();
    	$boxes = Box::all();
    	$cards = Card::all();
    	$couriers = Courier::all();

    	factory('App\Transaction', $transactionAmount)->make()->each(
    		function ($transaction) use ($users, $boxes, $cards, $couriers) {
    			$box = $boxes->random();
    			$card = $cards->random();

    			$transaction->user_id = $users->random()->id;
    			$transaction->box_id = $box->id;
    			$transaction->card_id = $card->id;
    			$transaction->courier_id = $couriers->random()->id;
    			
    			$transaction->total_price = $box->price + $card->price;

    			$transaction->save();
    		}
    	);   

        $this->command->info('Success!');

        // test
    }
}
