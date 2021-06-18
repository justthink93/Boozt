<?php

namespace App\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Faker\Factory;

class CustomerOrderOrderItemSeeder extends Seeder
{
    private $count = 10;

    /**
     * @throws Exception
     */
    public function run()
    {
        $faker = Factory::create();
        for ($k = 0; $k < $this->count; $k++) {
            $customer = new Customer();
            $customer->first_name = $faker->firstName;
            $customer->last_name = $faker->lastName;
            $customer->email = $faker->email;
            $customer->save();
            $orderCount = random_int(0, 10);
            for ($i = 0; $i < $orderCount; $i++) {
                $order = new Order();
                $order->country = $faker->country;
                $order->purchase_date = $faker->date('Y/m/d H:i:s');
                $order->customer_id = $customer->id;
                $order->save();
                $itemsCount = random_int(1, 10);
                for ($j = 0; $j < $itemsCount; $j++) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->EAN = $faker->ean13;
                    $orderItem->quantity = random_int(1, 50);
                    $orderItem->price = $faker->randomFloat(2, 1, 10000);
                    $orderItem->save();
                }
            }
        }
    }
}