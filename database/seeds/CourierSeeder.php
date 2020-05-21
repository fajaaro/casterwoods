<?php

use App\Courier;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    public function run()
    {
    	$this->command->info('Courier seeder is running...');

    	$couriers = array('JNE Express', 'J&T Express', 'POS Indonesia', 'TIKI', 'Sicepat', 'Go-Send');
    	$couriersLength = count($couriers);

    	for ($i = 0; $i < $couriersLength; $i++) {
    		$courier = new Courier;
    		$courier->name = $couriers[$i];
    		$courier->save();
    	}

        $this->command->info('Success!');
    }
}
