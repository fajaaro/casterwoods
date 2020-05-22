<?php

use App\Item;
use App\Transaction;
use Illuminate\Database\Seeder;

class ItemTransactionSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Item transaction seeder is running...');

    	$ItemTransactionAmount = (int)$this->command->ask('How much transaction\'s item do you want?', 3);

    	$transactions = Transaction::all();
    	$items = Item::all();

    	foreach ($transactions as $transaction) {
	    	factory('App\ItemTransaction', $ItemTransactionAmount)->make()->each(
	    		function ($ItemTransaction) use ($transaction, $items) {
	    			$item = $items->random();

	    			$ItemTransaction->transaction_id = $transaction->id;
	    			$ItemTransaction->item_id = $item->id;
	    			$ItemTransaction->save();

	    			$transaction->total_price += $item->price * $ItemTransaction->quantity;
	    			$transaction->save();
	    		}
	    	);       		
    	}

        $this->command->info('Success!');
    }
}
